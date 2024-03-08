<?php
class SidebarModel extends BaseModel
{
    const SOCIALS_TABLE = "social";
    const ADS_TABLE = "ads";
    const SHORT_DESC_TABLE = "short_desc";
    const POST_TABLE = "posts";
    const CATEGORY_TABLE = "categories";
    private $db;
    public function __construct()
    {
        $this->db = new BaseModel;
    }
    public function getAllData($limit, $categoryId)
    {
        $postsColumns = [
            "posts.id AS p_id",
            "posts.name AS p_name",
            "posts.url AS p_url",
            "posts.created_at AS p_created",
            "images.url AS img_url",
            "p_img_lookup.img_alt AS img_alt",
            "p_img_lookup.img_title AS img_title"
        ];
        $categoryColumns = [
            "categories.id AS cat_id",
            "categories.name AS cat_name",
            "categories.url AS cat_url",
            "count(p_cat_lookup.post_id) AS post_count"
        ];
        $shortDescTable = [
            "name",
            "description",
            "img"
        ];
        try {
            $this->_connect();
            $newestPostQuery = $this->find(self::POST_TABLE, $postsColumns)
                ->join("p_img_lookup", "post_id", "posts.id")
                ->join("images", "id", "p_img_lookup.img_id");
            if ($categoryId) $newestPostQuery->join("p_cat_lookup", "post_id", "posts.id")->where("p_cat_lookup.category_id", [$categoryId])->group("posts.id");
            $newestPostsResult = $newestPostQuery->order("posts.created_at", "DESC")->limit($limit)->_execute();
            //
            $categoriesQuery = $this->find(self::CATEGORY_TABLE, $categoryColumns)
                ->join("p_cat_lookup", "category_id", "categories.id");
            $categoriesResult = $categoriesQuery->group("categories.id")->_execute();
            //
            $shortDescResult = $this->find(self::SHORT_DESC_TABLE, $shortDescTable)->where("user_id", [0])->order("created_at", "DESC")->limit(1)->_execute();
        } catch (Exception $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
}
