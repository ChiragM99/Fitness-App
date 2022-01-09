<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 19/03/2019
 * Time: 10:51
 */

class viewRecipe extends recipe
{
    public function getall($foodID){
        return $datas=$this->getRecipe($foodID);

    }


    public function getInstructions($foodID){
        $datas=$this->getRecipe($foodID);
        foreach ($datas as $data){
            $ing= $data['Instructions'];
        }
        return $ing;
    }

    public function getIngrediants($foodID){
        $datas=$this->getRecipe($foodID);
        foreach ($datas as $data){
            $ing[]=$data['ingrediants'];
        }
        return $ing;
    }

    public function setRecipie( $ingrediants, $instructions, $foodID){
       $recipeID = $this->setRecipiesql($ingrediants, $instructions, $foodID); //returns recipie ID
        return $recipeID;

    }



}