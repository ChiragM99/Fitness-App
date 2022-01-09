<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 22/03/2019
 * Time: 17:24
 */

class viewDiary extends diary
{

    public function createDiary($accauntID){//use this to create diary in the form and just pass the value into this of account id
        return $diaryID=$this->createDiarysql($accauntID);
    }



    public function getDiary($memberID) {
        $datas=$this->getDiarysql($memberID);
        if (isset($datas)) {

            return $datas;

        }

    }

    public function getDiaryN($foodID) //returns diary id
    {
        $datas=$this->getDiaryNsql($foodID);
        if (isset($datas)) {
            return $datas;

        }

    }


    public function setdiarybreakfas($id,$foodD){
        $this->setdiarybreakfastsql($id,$foodD);
    }

    public function setdiarydinner($id,$foodD){
        $this->setDDsql($id,$foodD);
    }

    public function setdiarylunch($id,$foodD){
        $this->setDLsql($id,$foodD);
    }

}
