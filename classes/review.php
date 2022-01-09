<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 19/03/2019
 * Time: 10:48
 */
require_once '/core/init.php';
class review extends dbh
{
    protected function getReviewsql($foodID){
        $sql="select *from review where FoodID='$foodID'   ORDER BY dateR";
        $result=$this->connect()->query($sql);
        $numRows=$result->num_rows;
        if($numRows>0){
            while($row=$result->fetch_assoc()){
                $data[]=$row;
            }
            return $data;
        }
        else{
            echo '<h1>No reviews yet<h1>';
        }
    }

    protected function addReviewsql($comment,$rating,$date,$accID,$fID){
        $sql="INSERT INTO review (comment,rating, dateR, accountID, FoodID)
              VALUES ('$comment','$rating','$date','$accID','$fID')";

        $this->connect()->query($sql);

    }
}
