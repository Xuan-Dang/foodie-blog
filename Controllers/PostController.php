<?php
class PostController extends BaseController
{
    private $postModel;
    private $categoryModel;
    private $sidebarModel;
    private $helper;
    public function __construct()
    {
        $this->loadModel("PostModel");
        $this->loadModel("CategoryModel");
        $this->loadModel("SidebarModel");
        $this->postModel = new PostModel;
        $this->categoryModel = new CategoryModel;
        $this->sidebarModel = new SidebarModel;
        $this->helper = new Helper;
    }
    public function index()
    {
        $condition = ["posts.active" => 1];
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

        if ($categoryId) {
            //Get category by id
            $categoryById = $this->categoryModel->getCategoryById($categoryId);
        }
        if ($categoryById && $categoryById["error"]) {
            die($categoryById["error"]);
        }
        if ($categoryById) {
            $pageTitle = $categoryById["data"]["name"];
            $metaDescription = $categoryById["data"]["description"];
        }

        //Get sidebar data
        $sidebarData = $this->sidebarModel->getAllData($categoryId);
        if ($sidebarData["error"]) die($sidebarData["error"]);

        //Define data
        $data =  [
            "posts" => $posts["data"],
            "pagination" => $pagination["data"],
            "pageTitle" => $pageTitle,
            "category" => $categoryById ? $categoryById["data"] : null,
            "metaDescription" => isset($metaDescription) ? $metaDescription : "",
            "sidebarData" => $sidebarData["data"]
        ];
        return $this->view("posts", $data);
    }
    public function show()
    {
        if (!isset($_GET["id"])) die("Đầu vào không hợp lệ");
        $post = $this->postModel->getOnePost((int)$_GET["id"]);
        if ($post["error"]) die($post["error"]);
        $sidebarData = $this->sidebarModel->getAllData(null, $post["data"]["p_id"]);
        if (isset($post["data"]["p_cat_id"])) {
            $categoryId = $post["data"]["p_cat_id"];
        }
        if (isset($categoryId)) {
            $relatePosts = $this->postModel->getAllPosts(2, 0, ["p_cat_lookup.category_id" => $categoryId], ["posts.id" => $post["data"]["p_id"]]);
        } else {
            $relatePosts = [];
        }
        if ($relatePosts["error"]) die($relatePosts["error"]);
        $data = [
            "post" => $post["data"],
            "sidebarData" => $sidebarData["data"],
            "relatePosts" => $relatePosts["data"],
        ];
        return $this->view("singlePost", $data);
    }
    public function list() {
        $user = $this->helper->getSession("user");
        if (!$user || (int)$user["role"] !== 1) {
            return $this->helper->push("?controller=home");
        }
        return $this->view("admin.post.list", ["user" => $user]);
    }
    public function store()
    {
        $user = $this->helper->getSession("user");
        if (!$user || (int)$user["role"] !== 1) {
            return $this->helper->push("?controller=home");
        }
        return $this->view("admin.post.add", ["user" => $user]);
    }
}
