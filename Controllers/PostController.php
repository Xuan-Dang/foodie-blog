<?php
class PostController extends BaseController
{
    private $postModel;
    private $categoryModel;
    public function __construct()
    {
        $this->loadModel("PostModel");
        $this->loadModel("CategoryModel");
        $this->postModel = new PostModel;
        $this->categoryModel = new CategoryModel;
    }
    public function index()
    {
        $condition = [];
        $page = $_GET["page"] ?? 1;
        $limit = $_GET["limit"] ?? 8;
        $offset = ($page - 1) * $limit;
        $categoryId = null;
        if (isset($_GET["category"]) && $_GET["category"]) {
            $condition["p_cat_lookup.category_id"] = $_GET["category"];
            $categoryId = $_GET["category"];
        };
        if (isset($_GET["search"]) && $_GET["search"]) $condition["search"] = $_GET["search"];
        $pageTitle = "Post";
        $posts = $this->postModel->getAllPosts($limit, $offset, $condition);
        if ($posts["error"]) die($posts["error"]);
        $pagination = $this->postModel->pagination($limit, $page, $condition);
        if ($pagination["error"]) die($pagination["error"]);
        $categories = $this->categoryModel->getAllCategory();
        if ($categories["error"]) die($categories["error"]);
        $newestPosts = $this->postModel->getNewestPost(5, $categoryId);
        if($newestPosts["error"]) die($newestPosts["error"]);
        $data =  [
            "posts" => $posts["data"], 
            "pagination" => $pagination["data"], 
            "categories" => $categories["data"], 
            "pageTitle" => $pageTitle,
            "newestPosts" => $newestPosts["data"]
        ];
        return $this->view("posts", $data);
    }
}
