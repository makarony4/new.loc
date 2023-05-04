<?php

class Product extends DbConnect
{
   public $columns = '*';
    public function getAllProducts(){
        $sql = "SELECT * FROM products";
        $result = $this->connect()->query($sql);
        $num_rows = $result->num_rows;
        if($num_rows>0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
    }
}