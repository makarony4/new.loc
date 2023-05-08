<?php

class db
{
    public $que;
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'root';
    private $dbname = 'crud';
    private $result = array();
    private $mysqli = '';

    public function __construct()
    {
        $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->dbname);
    }

    public function insert($table, $para = array())
    {
        $types = '';
        foreach ($para as $params){
            if (is_string($params)){
                $types .= 's';
            }
            elseif(is_int($params)){
                $types .= 'i';
            }
        }

        $table_columns = implode(',', array_keys($para));
        $table_value = array_values($para);
        $question_marks = str_repeat('?,',count($para));
        $question_marks = rtrim($question_marks, ',');
        $stmt = $this->mysqli->prepare("INSERT INTO $table ($table_columns) VALUES ($question_marks)");
        $stmt->bind_param($types, ...$table_value);
        $stmt->execute();

    }

    public function update($table, $id, $para = array())
    {
        $args = array();
        foreach($para as $key=>$value){
            $args[] = "$key = '$value'";
            $sql = "UPDATE $table SET" . implode(',' , $args);
            $sql .="WHERE $id";
            $result = $this->mysqli->query($sql);
        }
    }

    public function delete($table, $id){
        $sql = "DELETE FROM $table";
        $sql .= "WHERE $id ";
        $result = $this->mysqli->query($sql);
    }

    public $sql;

    public function select($table, $rows = '*', $where = NULL){
        if($where != NULL){
            $sql = "SELECT $rows FROM $table WHERE $where";
        }else{
            $sql = "SELECT $rows FROM $table";
        }
        $this->sql = $result = $this->mysqli->query($sql);
    }

    public function __destruct()
    {
        $this->mysqli->close();
    }
}