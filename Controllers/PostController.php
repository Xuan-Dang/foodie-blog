<?php
class PostController extends BaseController
{
    private $postModel;
    public function __construct()
    {
        $this->loadModel("PostModel");
        $this->postModel = new PostModel;
    }
    public function index()
    {
        $condition = [];
        $page = $_GET["page"] ?? 1;
        $limit = $_GET["limit"] ?? 8;
        $offset = ($page - 1) * $limit;
        if (isset($_GET["category"]) && $_GET["category"]) $condition["category"] = $_GET["category"];
        if (isset($_GET["search"]) && $_GET["search"]) $condition["search"] = $_GET["search"];
        $pageTitle = "Post";
        $posts = $this->postModel->getAllPosts($limit, $offset, $condition);
        if ($posts["error"]) die($posts["error"]);
        $pagination = $this->postModel->pagination($limit, $page, $condition);
        if ($pagination["error"]) die($pagination["error"]);
        return $this->view("posts", ["posts" => $posts["data"], "pagination" => $pagination["data"], "pageTitle" => $pageTitle]);
    }
}
