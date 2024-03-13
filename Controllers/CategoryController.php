<?php
class CategoryController extends BaseController
{
    private $categoryModel;
    private $helper;
    public function __construct()
    {
        $this->loadModel("CategoryModel");
        $this->categoryModel = new CategoryModel;
        $this->helper = new Helper;
    }
    public function list()
    {
        $limit = $_GET["limit"] ?? 10;
        $page = $_GET["page"] ?? 1;
        $offset = ($page - 1) * $limit;
        $user = $this->helper->getSession("user");
        if (!$user || (int)$user["role"] !== 1) {
            return $this->helper->push("?controller=home");
        }
        $categories = $this->categoryModel->getListCategory($limit, $offset);
        if($categories["error"]) {
            $this->helper->setSession("errorMessage", $categories["error"]);
        }
        $errorMessage = $this->helper->getSession("errorMessage") ?? "";
        $this->helper->detroySesssionByName("errorMessage");
        $categoriesText = "";
        foreach($categories["data"] as $index => $category) {
            $order = $index + 1 + (($page * $limit) - $limit);
            $categoriesText .= "
                <tr>
                    <td>{$order}</td>
                    <td>".htmlspecialchars($category['name'])."</td>
                    <td>".htmlspecialchars($category['url'])."</td>
                    <td>".htmlspecialchars($category['description'])."</td>
                    <td>Hành động</td>
                </tr>
            ";
        }
        return $this->view("admin.category.list", ["user" => $user, "errorMessage" => $errorMessage, "categories" => $categoriesText]);
    }
    public function store()
    {
        $user = $this->helper->getSession("user");
        if (!$user || (int)$user["role"] !== 1) {
            return $this->helper->push("?controller=home");
        }
        if (isset($_POST["store_category"])) {
            $name = $_POST["name"] ?? "";
            $url = $_POST["url"] ?? "";
            $description = $_POST["description"] ?? "";
            if (!isset($name) || !$name) {
                $this->helper->setSession("errorMessage", "Vui lòng nhập tên danh mục bài viết");
                return $this->helper->push("?controller=category&action=store");
            }
            if (!isset($url) || !$url) {
                $this->helper->setSession("errorMessage", "Vui lòng nhập url danh mục bài viết");
                return $this->helper->push("?controller=category&action=store");
            }
            $data = ["name" => $name, "url" => $url, "description" => $description];
            $result = $this->categoryModel->storeNewCategory($data);
            if ($result["error"]) {
                $this->helper->setSession("errorMessage", $result["error"]);
                return $this->helper->push("?controller=category&action=store");
            }
            $this->helper->setSession("message", "Tạo danh mục bài viết thành công");
            return $this->helper->push("?controller=category&action=store");
        }
        $errorMessage = $this->helper->getSession("errorMessage") ?? "";
        $this->helper->detroySesssionByName("errorMessage");
        $message = $this->helper->getSession("message") ?? "";
        $this->helper->detroySesssionByName("message");

        return $this->view("admin.category.add", ["user" => $user, "errorMessage" => $errorMessage, "message" => $message]);
    }
}
