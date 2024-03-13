<?php
class PostModel extends BaseModel
{
    const POST_TABLE = "posts";
    private $db;
    private $helper;
    public function __construct()
    {
        $this->db = new BaseModel;
        $this->helper = new Helper;
    }
    public function getAllPosts($limit, $offset, $conditions, $unequal = [])
    {
        $postColumns = [
            "posts.id AS post_id",
            "posts.name AS post_name",
            "posts.url AS post_url",
            "posts.description AS post_description",
            "images.id AS img_id",
            "images.url AS img_url",
            "users.username AS username",
            "users.id AS user_id",
            "p_img_lookup.img_alt AS img_alt",
            "p_img_lookup.img_title AS img_title",
            "categories.name AS cat_name"
        ];
        try {
            $this->db->_connect();
            $query = $this->db->find(self::POST_TABLE, $postColumns)
                ->join("p_img_lookup", "post_id", "posts.id")
                ->join("images", "id", "p_img_lookup.img_id")
                ->join("users", "id", "posts.author")
                ->join("p_cat_lookup", "post_id", "posts.id")
                ->join("categories", "id", "p_cat_lookup.category_id");
            if (count($conditions) > 0) {
                foreach ($conditions as $key => $value) {
                    if ($key === "search") {
                        $query-> and() -> search("posts.name", $value);
                    } else {
                        $query-> and() -> where($key, [$value]);
                    }
                }
            }
            if (count($unequal) > 0) {
                foreach ($unequal as $key => $value) {
                    $query -> and() -> unequal($key, [$value]);
                }
            }
            $posts = $query->order("posts.name", "ASC")
                ->limit($limit)
                ->offset($offset)
                ->_execute();
            return ["data" => $posts, "error" => null];
        } catch (Exception $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
    public function pagination($limit, $page, $condition)
    {
        try {
            $this->db->_connect();
            $query = $this->db->_count(self::POST_TABLE, "DISTINCT posts.id")
                ->join("p_cat_lookup", "post_id", "posts.id")
                ->join("categories", "id", "p_cat_lookup.category_id")
                ->where("posts.active", [1]);
            if (count($condition) > 0) {
                foreach ($condition as $key => $value) {
                    if ($key === "search") {
                        $query = $query-> and() -> search("post.name", $value);
                    } else {
                        $query = $query-> and() -> where($key, [$value]);
                    }
                }
            }
            $numberOfPost = $query->_execute();
            $numberOfPost = $numberOfPost[0]["result"];
            $pagination = $this->helper->generatePagination($limit, $page, $numberOfPost);
            return ["data" => $pagination, "error" => null];
        } catch (Exception $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            die($e);
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
    public function getNewestPost($limit, $categoryId = null)
    {
        $columns = [
            "posts.id AS p_id",
            "posts.name AS p_name",
            "posts.url AS p_url",
            "posts.created_at AS p_created",
            "images.url AS img_url",
            "p_img_lookup.img_alt AS img_alt",
            "p_img_lookup.img_title AS img_title"
        ];
        try {
            $this->db->_connect();
            $query = $this->db->find(self::POST_TABLE, $columns)
                ->join("p_img_lookup", "post_id", "posts.id")
                ->join("images", "id", "p_img_lookup.img_id");
            if ($categoryId) $query->join("p_cat_lookup", "post_id", "posts.id")->where("p_cat_lookup.category_id", [$categoryId])->group("posts.id");
            $result = $query->order("posts.created_at", "DESC")->limit($limit)->_execute();
            return ["data" => $result, "error" => null];
        } catch (Exception $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
    public function getOnePost($id)
    {
        $columns = [
            "posts.id AS p_id",
            "posts.name AS p_name",
            "posts.url AS p_url",
            "posts.description AS p_desc",
            "posts.content AS p_content",
            "images.url AS img_url",
            "p_img_lookup.img_alt AS img_alt",
            "p_img_lookup.img_title AS img_title",
            "users.username AS username",
            "users.avatar AS user_avatar",
            "abouts.description AS about_user",
            "p_cat_lookup.category_id AS p_cat_id"
        ];
        try {
            $this->db->_connect();
            $post = $this->db->find(self::POST_TABLE, $columns)
                ->join("p_img_lookup", "post_id", "posts.id")
                ->join("images", "id", "p_img_lookup.img_id")
                ->join("users", "id", "posts.author")
                ->join("abouts", "user_id", "users.id")
                ->join("p_cat_lookup", "post_id", "posts.id")
                ->where("posts.id", [$id])
                ->order("posts.created_at", "DESC")
                ->limit(1)
                ->_execute();
            return ["data" => $post[0], "error" => null];
        } catch (Exception $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
}
