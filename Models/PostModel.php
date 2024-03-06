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
    public function getAllPosts($limit, $offset, $condition)
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
            $posts = $this->db->find(self::POST_TABLE, $postColumns)
                ->join("p_img_lookup", "post_id", "posts.id")
                ->join("images", "id", "p_img_lookup.img_id")
                ->join("users", "id", "posts.author")
                ->join("p_cat_lookup", "post_id", "posts.id")
                ->join("categories", "id", "p_cat_lookup.category_id")
                ->where("posts.active", [1])
                ->order("posts.created_at", "DESC")
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
                ->join("categories", "id", "p_cat_lookup.category_id");
            if (count($condition) > 0) {
                foreach ($condition as $key => $value) {
                    if ($key === "search") {
                        $query = $query->search("post.name", $value);
                    } else {
                        $query = $query->where($key, [$value]);
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
}