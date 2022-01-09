<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 18/03/2019
 * Time: 21:20
 */

class dbh
{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    protected function connect(){
        $this->servername="localhost";
        $this->username="root";
        $this->password="";
        $this->dbname="seprojectgroup48";

        $conn= new mysqli($this->servername,$this->username,
            $this->password,$this->dbname);
        return $conn;
    }
}
