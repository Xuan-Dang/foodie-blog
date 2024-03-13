<?php
class AdminController extends BaseController
{
    private $userModel;
    private $helper;
    public function __construct()
    {
        $this->loadModel("UserModel");
        $this->userModel = new UserModel;
        $this->helper = new Helper;
    }
    public function index()
    {
        $user = $this->helper->getSession("user");
        if (!$user || (int)$user["role"] !== 1) {
            return $this->helper->push("?controller=home");
        }
        return $this->view("admin.index", ["user" => $user]);
    }
    public function login()
    {
        if (isset($_POST["login"])) {
            $email = $_POST["username"] ?? null;
            $password = $_POST["password"] ?? null;
            if (!$email) {
                return $this->view("admin.login", ["error" => "Username cannot be empty"]);
            }
            if (!$password) {
                return $this->view("admin.login", ["error" => "Password cannot be empty"]);
            }
            $user = $this->userModel->adminLogin($email, $password);
            if (count($user["data"]) === 0) {
                return $this->view("admin.login", ["error" => "Email or password is incorrect"]);
            }
            $this->helper->setSession("user", $user["data"]);
            return $this->helper->push("?controller=admin");
        } else {
            $user = $this->helper->getSession("user");
            if ($user && (int)$user["role"] === 1) {
                $this->helper->push("?controller=admin");
            }
            return $this->view("admin.login");
        }
    }
}
