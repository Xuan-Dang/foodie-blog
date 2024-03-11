<?php
class BaseModel extends Database
{
    protected $conn = null;
    protected $stmt = null;
    protected $sql = "";
    protected $params = [];
    protected $count = 0;
    public function _connect()
    {
        try {
            $this->conn = $this->connect();
            return $this;
        } catch (PDOException $e) {
            throw new Error($e->getMessage());
        }
    }

    //Tìm kiếm tất cả các bản ghi trong cơ sở dữ liệu
    public function find($table, $columns)
    {
        $this->sql .= "SELECT " . implode(", ", $columns) . " FROM {$table}";
        return $this;
    }

    //Tạo một bản ghi mới vào cơ sở dữ liệu
    public function store($table, $data)
    {
        $columns = implode(",", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $this->sql .= "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $this->params = array_merge($this->params, $data);
        return $this;
    }

    //Cập nhật bản ghi bằng id trong cơ sở dữ liệu
    public function _update($table, $data, $id)
    {
        $set = "";
        foreach ($data as $column => $value) {
            $set .= "{$column} = :{$column}, ";
        }
        $set = rtrim($set, ", ");
        $this->sql .= "UPDATE {$table} SET {$set} WHERE id = :id";
        $this->params = array_merge($this->params, $data, [":id" => $id]);
        return $this;
    }

    //Xóa bản ghi bằng id trong cơ sở dữ liệu
    public function deleteOne($table, $column, $id)
    {
        $this->sql .= "DELETE FROM {$table} WHERE {$column} = :id";
        $this->params[":id"] = $id;
        return $this;
    }

    //Xóa nhiều bản ghi
    public function deleteMany($table, $column, $ids)
    {
        $placeholders = [];
        foreach ($ids as $index => $id) {
            $placeholders[":value{$index}"] = $id;
        }
        $placeholdersList = implode(", ", array_keys($placeholders));
        $this->sql .= "DELETE FROM {$table} WHERE {$column} IN ({$placeholdersList})";
        $this->params = array_merge($this->params, $placeholders);
        return $this;
    }

    //Join dữ liệu từ một bản đã chọn
    public function join($table, $column, $lookupColumn)
    {
        $this->sql .= " INNER JOIN {$table} ON {$table}.{$column} = $lookupColumn";
        return $this;
    }

    //Tìm bản ghi bằng một điều kiện nào đó.
    public function where($column, $values)
    {
        $placeholders = [];
        foreach ($values as $index => $value) {
            $placeholders[":value{$this->count}"] = $value;
            $this->count++;
        }
        $placeholdersList = implode(", ", array_keys($placeholders));
        if (strpos($this->sql, 'WHERE') !== false) {
            $this->sql .= " {$column} IN ({$placeholdersList}) ";
        } else {
            $this->sql .= " WHERE {$column} IN ({$placeholdersList}) ";
        }
        $this->params = array_merge($this->params, $placeholders);
        return $this;
    }

    //Không bằng
    public function unequal($column, $values) {
        $placeholders = [];
        foreach ($values as $index => $value) {
            $placeholders[":value{$this->count}"] = $value;
            $this->count++;
        }
        $placeholdersList = implode(", ", array_keys($placeholders));
        if (strpos($this->sql, 'WHERE') !== false) {
            $this->sql .= " {$column} != $placeholdersList ";
        } else {
            $this->sql .= " WHERE {$column} != $placeholdersList ";
        }
        $this->params = array_merge($this->params, $placeholders);
        return $this;
    }

    //Giới hạn số bản ghi mỗi lần truy vấn
    public function limit($limit)
    {
        $limit = (int)$limit;
        $this->sql .= " LIMIT {$limit}";
        return $this;
    }

    //Bỏ qua n bản ghi
    public function offset($offset)
    {
        $offset = (int)$offset;
        $this->sql .= " OFFSET {$offset}";
        return $this;
    }

    //Nhóm các bản ghi theo column nào đó
    public function group($groupColumn)
    {
        $this->sql .= " GROUP BY $groupColumn";
        return $this;
    }

    //Sắp xếp bản ghi theo cột nào đó
    public function order($column, $direction)
    {
        $this->sql .= " ORDER BY $column $direction";
        return $this;
    }

    //Tìm kiếm bản ghi
    public function search($column, $search)
    {
        if (strpos($this->sql, 'WHERE') !== false) {
            $this->sql .= " {$column} LIKE :search";
        } else {
            $this->sql .= " WHERE {$column} LIKE :search";
        }
        $this->params[":search"] = "%$search%";
        return $this;
    }

    public function between($column, $min, $max)
    {
        if (strpos($this->sql, 'WHERE') !== false) {
            $this->sql .= " {$column} BETWEEN :min AND :max";
        } else {
            $this->sql .= " WHERE {$column} BETWEEN :min AND :max";
        }
        $this->params[":min"] = $min;
        $this->params[":max"] = $max;
        return $this;
    }

    public function _count($table, $column)
    {
        $this->sql = "SELECT count($column) AS result FROM $table";
        return $this;
    }

    public function or() {
        $this->sql .= " OR";
        return $this;
    }

    public function and() {
        $this -> sql .= " AND";
        return $this;
    }

    //Thực hiện truy vấn
    protected function _execute()
    {
        $this->stmt  = $this->conn->prepare($this->sql);
        if (!$this->stmt) {
            throw new Error(implode("<br>", $this->conn->errorInfo()));
        }
        if ($this->params) {
            $isExecute = $this->stmt->execute($this->params);
        } else {
            $isExecute = $this->stmt->execute();
        }
        if (!$isExecute) {
            throw new Error(implode("<br>", $this->conn->errorInfo()));
        }
        // Lưu trạng thái của câu lệnh SQL
        $isSelect = strpos($this->sql, 'SELECT') === 0;
        $isInsert = strpos($this->sql, 'INSERT') === 0;

        // Đặt $this->sql và $this->params thành giá trị mặc định
        $this->sql = "";
        $this->params = [];
        $this->count = 0;

        // Kiểm tra trạng thái của câu lệnh SQL
        if ($isSelect) {
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } elseif ($isInsert) {
            return $this->conn->lastInsertId();
        } else {
            return $this->stmt->rowCount();
        }
    }

    public function beginTransaction()
    {
        $this->conn->beginTransaction();
    }
    public function commit()
    {
        $this->conn->commit();
    }
    public function rollBack()
    {
        $this->conn->rollBack();
    }
    //Đóng kết nối.
    protected function _close()
    {
        $this->stmt = null;
        $this->conn = null;
    }
}
