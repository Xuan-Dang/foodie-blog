<?php
class UserModel extends BaseModel
{
    const TABLE = "users";
    private $db;
    private $helper;
    public function __construct()
    {
        $this->db = new BaseModel;
        $this->helper = new Helper;
    }
    public function adminLogin($email, $password)
    {
        $columns = [
            "id",
            "username",
            "email",
            "role",
            "avatar"
        ];
        try {
            $this->helper->handleError();
            $this->db->_connect();
            $user = $this->db->find(self::TABLE, $columns)
                            ->where("email", [$email])
                            ->and()
                            ->where("password", [md5($password)])
                            ->order("created_at", "DESC")
                            ->limit(1)
                            ->_execute();
            if(isset($user[0])) {
                $data = $user[0];
            }else {
                $data = [];
            }
            return ["data"=>$data, "error"=>null];
        } catch (Exception $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } catch (Error $e) {
            return ["data" => null, "error" => $e->getMessage()];
        } finally {
            $this->db->_close();
        }
    }
}
