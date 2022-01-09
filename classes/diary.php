<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 22/03/2019
 * Time: 17:24
 */

class diary extends dbh
{
    protected function createDiarysql($accountID){
        $sql="INSERT INTO fooddiary (accountID)
              VALUES ('$accountID')";

        $this->connect()->query($sql);
        $sql="select * from fooddiary where accountID='$accountID'";


        $result=$this->connect()->query($sql);
        $numRows=$result->num_rows;
        if($numRows>0) {
            while ($row = $result->fetch_assoc()) {
                return $row['diaryID'];
            }
        }
    }

    protected function getDiarysql($accountID){
        $sql="select * from fooddiary where accountID='$accountID'";

        $result=$this->connect()->query($sql);
        $numRows=$result->num_rows;
        if($numRows>0) {
            while ($row = $result->fetch_assoc()) {
                $data[]=$row;
            }
            return $data;
        }
    }


    protected function getDiaryNsql($accountID){
        $sql="select * from fooddiary where diaryID='$accountID'";

        $result=$this->connect()->query($sql);
        $numRows=$result->num_rows;
        if($numRows>0) {
            while ($row = $result->fetch_assoc()) {
                $data[]=$row;
            }
            return $data;
        }
    }






    protected function setdiarybreakfastsql($id,$foodD)//set diary id
    {
        $sql="UPDATE fooddiary
              SET breakfast = '$foodD'
              WHERE accountID = '$id'";
        $this->connect()->query($sql);
    }

    protected function setDLsql($id,$foodD)//set diary id
    {
        $sql="UPDATE fooddiary
              SET lunch = '$foodD'
              WHERE accountID = '$id'";
        $this->connect()->query($sql);
    }

    protected function setDDsql($id,$foodD)//set diary id
    {
        $sql="UPDATE fooddiary
              SET dinner = '$foodD'
              WHERE accountID = '$id'";
        $this->connect()->query($sql);
    }

}
