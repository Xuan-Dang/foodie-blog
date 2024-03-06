<?php
class HomeController extends BaseController
{
    private $homeModel;
    public function __construct()
    {
        $this->loadModel("HomeModel");
        $this->homeModel = new HomeModel;
    }
    public function index()
    {
        $pageTitle = "Trang chủ";
        $hotPosts = $this->homeModel->getHotPosts();
        if ($hotPosts["error"]) die($hotPosts["error"]);
        $newPosts = $this->homeModel->getNewPosts();
        if($newPosts["error"]) die($newPosts["error"]);
        return $this->view("home", ["hotPosts" => $hotPosts["data"], "newPosts" => $newPosts["data"], "pageTitle" => $pageTitle]);
    }
}
