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
        $table_columns = implode(',', array_keys($para));
        $table_value = implode(',', $para);
        $sql = "INSERT INTO $table ('$table_columns') VALUES ('$table_value')";

        $result = $this->mysqli->query($sql);
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