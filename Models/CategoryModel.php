<?php
class CategoryModel extends BaseModel
{
    const TABLE = "categories";
    private $db;
    private $helper;
    public function __construct()
    {
        $this->db = new BaseModel;
        $this->helper = new Helper;
    }
    public function getAllCategory($limit = null, $offset = null)
    {
        $columns = [
            "categories.id AS cat_id",
            "categories.name AS cat_name",
            "categories.url AS cat_url",
            "categories.description AS cat_desc",
            "count(p_cat_lookup.post_id) AS post_count"
        ];
        try {
            $this->db->_connect();
            $query = $this->db
                ->find(self::TABLE, $columns)
                ->join("p_cat_lookup", "category_id", "categories.id")
                ->group("categories.id");
            if ($limit) $query->limit($limit);
            if ($offset) $query->offset($offset);
            $categories = $query->_execute();
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
    public function getListCategory($limit, $offset)
    {
        $columns = [
            "id",
            "name",
            "url",
            "description",
        ];
        try {
            $this->db->_connect();
            $categoires = $this->db->find(self::TABLE, $columns)->limit($limit)->offset($offset)->_execute();
            return ["data" => $categoires, "error" => null];
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
            return ["data" => $category[0], "error" => null];
        } catch (Exception $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            die($e);
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
    public function storeNewCategory($data)
    {
        try {
            $this->db->_connect();
            $createdId = $this->db->store("categories", $data)->_execute();
            return ["data" => $createdId, "error" => null];
        } catch (Exception $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            die($e);
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
    public function pagiantion($limit, $page) {
        try {
            $this->db->_connect();
            $count = $this->db->_count(self::TABLE, "id")->_execute();
            $pagination = $this->helper->generateAdminPagination($limit, $page, $count[0]["result"]);
            return ["data"=>$pagination, "error"=>null];
        }catch (Exception $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
    public function deleteCategory($id) {
        try {
            $this->db->_connect();
            $this->db->beginTransaction();
            $this->db->deleteOne(self::TABLE, "id", $id)->_execute();
            $this->db->deleteOne("p_cat_lookup", "category_id", $id)->_execute();
            $this->db->commit();
            return ["data"=>"success", "error"=>null];
        }catch (Exception $e) {
            $this->db->rollBack();
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            $this->db->rollBack();
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
}
