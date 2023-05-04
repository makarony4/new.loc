<?php

class dataMapper extends DbConnect
{
    public $query;
    public $connection;
    public function fetchAssoc($query){
        $fetched = mysqli_fetch_assoc($query);
        return $fetched;
    }
}