<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 19/03/2019
 * Time: 10:50
 */

class viewMember extends member
{
    public function getDiaryID($memberID){
        return $FoodDiary=$this->getMembersFoodDiarysql($memberID); //reruns name
    }

    public function getIDbyName($name){
        return $accountID=$this->getIDByNamesql($name); //reruns name
    }

    public function setMembersFoodDiary($memberID, $foodDiary)//set diary id
    {
        $this->setMembersFoodDiarysql($memberID, $foodDiary);
    }

    public function getMembersCaloriesGoal($memberID){
        $datas=$this->getMembersCaloriesGoalfoodDiarysql($memberID);
        if (isset($datas)) {
            return $datas;
        }
    }

    public function setMembersPersonal($memberID, $name, $email, $phone, $age, $heihgt, $weight, $goals){
        $this->setMembersPersonal($memberID, $name, $email, $phone, $age, $heihgt, $weight, $goals);

    }


}
