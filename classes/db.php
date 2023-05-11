<?php

class db
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $dbname = 'crud';
    private $result = array();
    public $mysqli = '';

    public $sql;


    public function __construct()
    {
        $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->dbname);
    }

    public function insert($table, $params = array())
    {
        $types = '';
        foreach ($params as $param) {
            if (is_string($param)) {
                $types .= 's';
            } elseif (is_int($param)) {
                $types .= 'i';
            }
        }

        $table_columns = implode(',', array_keys($params));
        $table_value = array_values($params);
        $question_marks = str_repeat('?,', count($params));
        $question_marks = rtrim($question_marks, ',');
        $stmt = $this->mysqli->prepare("INSERT INTO $table ($table_columns) VALUES ($question_marks)");
        $stmt->bind_param($types, ...$table_value);
        $stmt->execute();

    }

    public function update($table, $id, $params = array())
    {
        $types = 's';
        $columns = array();
        $values = array();
        foreach ($params as $key => $value) {
            $columns[] = $key . "= ?";
            $values[] = $value;
            if (is_string($value)){
                $types .= 's';
            }elseif (is_int($value)){
                $types .= 'i';
            }
        }

        $values[] = $id;

        $sql = "UPDATE $table SET " . implode(',', $columns);
            $sql .= " WHERE id = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param($types, ...$values);
            $stmt->execute();
//            $result = $this->mysqli->query($sql);
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table";
        $sql .= "WHERE $id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('s', $id);
//        $this->sql = $result = $stmt->execute();

        $stmt->execute();
    }


    public function select($table, $rows = '*', $identificator = NULL, $parameter = NULL)
    {
        if ($identificator != NULL) {
            $sql = "SELECT $rows FROM $table WHERE $identificator = ? ";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param('s', $parameter);
            $stmt->execute();
            $this->sql = $stmt->get_result();
        } else {
            $sql = "SELECT $rows FROM $table";
            $this->sql = $result = $this->mysqli->query($sql);
        }
    }

    public function __destruct()
    {
        $this->mysqli->close();
    }
}