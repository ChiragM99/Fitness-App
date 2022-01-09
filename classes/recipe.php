<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 19/03/2019
 * Time: 10:51
 */

class recipe extends dbh

{
    protected function getRecipe($foodID){
        $sql="select *from recipe 
              where FoodID=$foodID";
        $result=$this->connect()->query($sql);
        $numRows=$result->num_rows;
        if($numRows>0){
            while($row=$result->fetch_assoc()){
                $data[]=$row;
            }
            return $data;
        }
    }

    protected function setRecipiesql($ingrediants, $instructions,$foodID){
        $sql="INSERT INTO recipe (Ingrediants, Instructions, FoodID)
              VALUES ('$ingrediants', '$instructions', '$foodID')";
        $this->connect()->query($sql);

        $sql="select * from recipe where Ingrediants='$ingrediants' and Instructions='$instructions'and FoodID='$foodID'";

        $result=$this->connect()->query($sql);
        $numRows=$result->num_rows;
        if($numRows>0) {
            while ($row = $result->fetch_assoc()) {
                return $row['RecipieID'];
            }
        }


    }





}