<?php
class SidebarModel extends BaseModel
{
    const SOCIALS_TABLE = "socials";
    const ADS_TABLE = "ads";
    const SHORT_DESC_TABLE = "abouts";
    const POST_TABLE = "posts";
    const CATEGORY_TABLE = "categories";
    private $db;
    public function __construct()
    {
        $this->db = new BaseModel;
    }
    public function getAllData($categoryId = null, $postId = null)
    {
        $postColumns = [
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
        $shortDescColumns = [
            "name",
            "description",
            "img"
        ];
        $adColumns = [
            "name",
            "position",
            "img",
            "img_alt",
            "url"
        ];
        $socialColumns = [
            "name",
            "url",
            "icon",
        ];
        try {
            $this->_connect();
            $newestPostQuery = $this->find(self::POST_TABLE, $postColumns)
                ->join("p_img_lookup", "post_id", "posts.id")
                ->join("images", "id", "p_img_lookup.img_id");
            if ($categoryId && !$postId) $newestPostQuery->join("p_cat_lookup", "post_id", "posts.id")->where("p_cat_lookup.category_id", [$categoryId]);
            if ($postId && !$categoryId) $newestPostQuery->unequal("posts.id", [$postId]);
            if ($categoryId && $postId) $newestPostQuery->join("p_cat_lookup", "post_id", "posts.id")->where("p_cat_lookup.category_id", [$categoryId])->and()->unequal("posts.id", [$postId]);
            $newestPostsResult = $newestPostQuery->group("posts.id")->order("posts.created_at", "DESC")->limit(5)->_execute();
            //
            $categoriesResult = $this->find(self::CATEGORY_TABLE, $categoryColumns)
                ->join("p_cat_lookup", "category_id", "categories.id")
                ->group("categories.id")
                ->_execute();
            //
            $about = $this->find(self::SHORT_DESC_TABLE, $shortDescColumns)->where("user_id", [0])->order("created_at", "DESC")->limit(1)->_execute();
            //
            $adResult = $this->find(self::ADS_TABLE, $adColumns)->where("position", [1])->order("created_at", "DESC")->limit(1)->_execute();
            //
            $socialResult = $this->find(self::SOCIALS_TABLE, $socialColumns)->where("user_id", [0])->_execute();
            //
            $data = [
                "posts" => $newestPostsResult,
                "categories" => $categoriesResult,
                "about" => $about,
                "ad" => $adResult,
                "socials" => $socialResult,
            ];
            return ["data" => $data, "error" => null];
        } catch (Exception $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
}
