<?php
class SinglePostController extends BaseController
{  
    private $postModel;
    public function __construct()
    {
        $this->loadModel("PostModel");
        $this->postModel = new PostModel;
    }
    public function index()
    {
        
        return $this->view("singlePost");
    }
}
