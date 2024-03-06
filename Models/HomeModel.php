<?php
class HomeModel extends BaseModel
{
    const POST_TABLE = "posts";
    private $db;
    public function __construct()
    {
        $this->db = new BaseModel;
    }
    public function getHotPosts()
    {
        $columns = [
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
        ];
        try {
            $this->db->_connect();
            $result = $this->db->find(self::POST_TABLE, $columns)
                ->join("p_img_lookup", "post_id", "posts.id")
                ->join("images", "id", "p_img_lookup.img_id")
                ->join("users", "id", "posts.author")
                ->where("posts.active", [1])
                ->where("posts.hot", [1])
                ->order("posts.created_at", "DESC")
                ->limit(8)
                ->_execute();
            return ["data" => $result, "error" => null];
        } catch (Exception $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
    public function getNewPosts()
    {
        $columns = [
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
            $result = $this->db->find(self::POST_TABLE, $columns)
                ->join("p_img_lookup", "post_id", "posts.id")
                ->join("images", "id", "p_img_lookup.img_id")
                ->join("users", "id", "posts.author")
                ->join("p_cat_lookup", "post_id", "posts.id")
                ->join("categories", "id", "p_cat_lookup.category_id")
                ->where("posts.active", [1])
                ->order("posts.created_at", "DESC")
                ->limit(9)
                ->_execute();
            return ["data" => $result, "error" => null];
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
