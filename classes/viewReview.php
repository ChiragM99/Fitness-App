<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 19/03/2019
 * Time: 10:49
 */

class viewReview extends review
{
    public function getReview($foodID)
    {
        $datas=$this->getReviewsql($foodID);
        if (isset($datas)) {
           return $datas;
        }else{

        }
    }


    public function addReview($comment,$rating,$date,$accID,$fID){
        $this->addReviewsql($comment,$rating,$date,$accID,$fID);

    }

}