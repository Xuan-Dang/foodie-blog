<?php
class PostController extends BaseController
{
    private $postModel;
    private $categoryModel;
    private $sidebarModel;
    public function __construct()
    {
        $this->loadModel("PostModel");
        $this->loadModel("CategoryModel");
        $this->loadModel("SidebarModel");
        $this->postModel = new PostModel;
        $this->categoryModel = new CategoryModel;
        $this->sidebarModel = new SidebarModel;
    }
    public function index()
    {
        $condition = [];
        $page = $_GET["page"] ?? 1;
        $limit = $_GET["limit"] ?? 8;
        $offset = ($page - 1) * $limit;
        $categoryId = null;

        //Get categoryId
        if (isset($_GET["category"]) && $_GET["category"]) {
            $condition["p_cat_lookup.category_id"] = $_GET["category"];
            $categoryId = $_GET["category"];
        };

        //Get search
        if (isset($_GET["search"]) && $_GET["search"]) $condition["search"] = $_GET["search"];

        //Define page title
        $pageTitle = "Post";

        //Get posts
        $posts = $this->postModel->getAllPosts($limit, $offset, $condition);
        if ($posts["error"]) die($posts["error"]);

        //Get pagiantion
        $pagination = $this->postModel->pagination($limit, $page, $condition);
        if ($pagination["error"]) die($pagination["error"]);

        //Define CategoryById
        $categoryById = null;

        if($categoryId) {
            //Get category by id
            $categoryById = $this->categoryModel->getCategoryById($categoryId);
        }
        if($categoryById && $categoryById["error"]) {
            die($categoryById["error"]);
        }
        if($categoryById) {
            $pageTitle = $categoryById["data"]["name"];
            $metaDescription = $categoryById["data"]["description"];
        }

        //Get sidebar data
        $sidebarData = $this->sidebarModel->getAllData($categoryId);
        if($sidebarData["error"]) die($sidebarData["error"]);

        //Define data
        $data =  [
            "posts" => $posts["data"],
            "pagination" => $pagination["data"],
            "pageTitle" => $pageTitle,
            "category"=> $categoryById ? $categoryById["data"] : null,
            "metaDescription"=> isset($metaDescription) ? $metaDescription : "",
            "sidebarData"=>$sidebarData["data"]
        ];
        return $this->view("posts", $data);
    }
}
