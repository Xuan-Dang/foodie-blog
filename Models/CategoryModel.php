<?php
class CategoryModel extends BaseModel
{
    const TABLE = "categories";
    private $db;
    public function __construct()
    {
        $this->db = new BaseModel;
    }
    public function getAllCategory($limit = null, $offset = null)
    {
        $columns = [
            "categories.id AS cat_id",
            "categories.name AS cat_name",
            "categories.url AS cat_url",
            "count(p_cat_lookup.post_id) AS post_count"
        ];
        try {
            $this->db->_connect();
            $query = $this->db
                ->find(self::TABLE, $columns)
                ->join("p_cat_lookup", "category_id", "categories.id");
            if ($limit) $query->limit($limit);
            if ($offset) $query->offset($offset);
            $categories = $query->group("categories.id")->_execute();
            return ["data" => $categories, "error" => null];
        } catch (Exception $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            die($e);
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
    public function getCategoryById($id)
    {
        $columns = [
            "id",
            "name",
            "url",
            "description"
        ];
        try {
            $this->db->_connect();
            $category = $this->db->find(self::TABLE, $columns)->where("id", [$id])->limit(1)->_execute();
            return ["data"=>$category[0], "error"=>null];
        }catch (Exception $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            die($e);
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
}
