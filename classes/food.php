<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 18/03/2019
 * Time: 21:24
 */

class food extends dbh
{
    protected function getFoodByIDsql($foodID){

        $sql="select *from food where FoodID=$foodID";
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;
            if($numRows>0){
                while($row=$result->fetch_assoc()){
                  $data[]=$row;
                }
            return $data;
        }
    }


    protected function searchsql($name){

        $sql="select * from food 
              where foodName like '%$name%'";
        $result=$this->connect()->query($sql);
        $numRows= $result->num_rows;
        if($numRows>0){
            while($row=$result->fetch_assoc()){
                $data[]=$row;
            }

            return $data;
        }
    }

    protected function SearchTypesql($type){

        $sql="select * from food 
              where Type= '$type' ";
        $result=$this->connect()->query($sql);
        $numRows=$result->num_rows;
        if($numRows>0){
            while($row=$result->fetch_assoc()){
                $data[]=$row;
            }

            return $data;
        }
    }



    protected function SearchIDsql($FoodID){

        $sql="select * from food 
              where FoodID= '$FoodID' ";
        $result=$this->connect()->query($sql);
        $numRows=$result->num_rows;
        if($numRows>0){
            while($row=$result->fetch_assoc()){
                $data[]=$row;
            }

            return $data;
        }
    }


    protected function searchNamesql($name){
        $sql="select * from food 
              where foodName= '$name'";
        $result=$this->connect()->query($sql);
        $numRows=$result->num_rows;
        if($numRows>0) {
            while ($row = $result->fetch_assoc()) {
                return $row['foodName'];
            }
        }

    }



    protected function AddFoodsql($name,$calories,$fat,$carbs,$protein,$type,$url){

        $sql="INSERT INTO food (foodName, Calories, Fat, Carbs, Protein, Type,imgRef)
              VALUES ('$name', '$calories', '$fat', '$carbs', '$protein', '$type', '$url')";

        $this->connect()->query($sql);



        $sql="select * from food where foodName='$name' and Calories='$calories' and Fat='$fat' and Carbs='$carbs' and Protein='$protein' and Type='$type'";


        $result=$this->connect()->query($sql);
        $numRows=$result->num_rows;
        if($numRows>0) {
            while ($row = $result->fetch_assoc()) {
                return $row['FoodID'];
            }
        }

    }

    protected function setRecipieIDsql($foodID,$recipieID){
        $sql="UPDATE food
              SET RecipeID = '$recipieID'
              WHERE FoodID = '$foodID'";
        $this->connect()->query($sql);


    }





}