<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 18/03/2019
 * Time: 21:30
 */

ini_set('memory_limit', '');
class viewFood extends food
{

    public function search($name){
        return $datas=$this->searchsql($name);

    }


    public function searchType($type){
        return $datas=$this->SearchTypesql($type);


    }

    public function searchID($FoodID){
        $datas=$this->SearchIDsql($FoodID);
        if (isset($datas)) {
           return $datas;

        }

    }








    public function searchName($name){
       return $Name=$this->SearchNamesql($name); //reruns name
    }


    public function addFood($name,$calories,$fat,$carbs,$protein,$Type,$url){

        $FoodID=$this->addFoodsql($name,$calories,$fat,$carbs,$protein,$Type,$url); //returns entered food id
        return $FoodID;
    }


    public function setRID($foodID,$recipieID){
        $this->setRecipieIDsql($foodID,$recipieID);
    }



}
