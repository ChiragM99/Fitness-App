<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 19/03/2019
 * Time: 10:50
 */

class member extends dbh
{
    protected function getMembersFoodDiarysql($memberID) //get diary id
    {

        $sql="select * from account where accountID=$memberID";
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;
        if($numRows>0) {
            while ($row = $result->fetch_assoc()) {
                return $row['foodDiary'];
            }
        }
    }

    protected function getIDByNamesql($name) //get diary id
   {

       $sql="select * from account where userName = '$name' ";
       $result = $this->connect()->query($sql);
       if(isset($result)){
          $numRows=$result->num_rows;
          if($numRows>0) {
              while ($row = $result->fetch_assoc()) {
                  return $row['accountID'];
              }
          }
     } else{
       echo 'ur code does not work';
     }
   }

    protected function getMembersCaloriesGoalfoodDiarysql($memberID)//get something from member
    {

        $sql="select * from 	account where accountID=$memberID";
        $result = $this->connect()->query($sql);
        $numRows=$result->num_rows;
        if($numRows> 0) {
            while ($row = $result->fetch_assoc()) {
                $data[]=$row;
            }
            return $data;
        }
    }


    protected function setMembersFoodDiarysql($memberID, $foodDiary)//set diary id
    {
        $sql="UPDATE account
              SET diaryID = '$foodDiary'
              WHERE accountID = '$memberID'";
        $this->connect()->query($sql);
    }


    protected function setMembersPersonalsql($memberID, $name, $email, $phone, $age, $heihgt, $weight, $goals)//set diary id
    {
        $sql="UPDATE account
              SET fullName = '$name', email='$email', phone='$phone', age='$age',
              goals='$goals', height='$heihgt', wight='$weight'; 
              WHERE accountID = '$memberID'";
        $this->connect()->query($sql);
    }




}
