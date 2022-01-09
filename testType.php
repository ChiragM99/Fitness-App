<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 19/03/2019
 * Time: 18:43
 */
include 'classes/dbh.php';
include 'classes/food.php';
include 'classes/viewFood.php';
include 'classes/recipe.php';
include 'classes/viewRecipe.php';
include 'classes/review.php';
include 'classes/viewReview.php';
include 'classes/member.php';
include 'classes/viewMember.php';
$search= new viewFood();
?>

<html lang="en">
<head>
    <style>
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
        table {
            border-spacing: 15px;

        }
    </style>
    <title>test</title>
</head>
<body>


<?php
$trimmed='1 2 3 ';
$foodID='5 ';
?>
<br>
<form action="#" method="post">
    <button type="submit" name="btn" value="add">   AddFood    </button>
    <button type="submit" name="btn" value="remove">removeFood </button>

</form>
<?php
if(isset($_POST['btn'])){
     if($_POST['btn']=="add"){
         $trimmed.=$foodID;//dot adds string foodID to trimmed
         $data =explode(" ",$trimmed);//explodes into array
         foreach($data as $value)
         {
             echo  $search->searchID($value);//gets values as one
         }

     }elseif ($_POST['btn']=="remove"){
         $trimmed = str_replace($foodID, '', $trimmed);//this line removes food ID from string trimmed
         $data =explode(" ",$trimmed);//explodes into array
         foreach($data as $value)
         {
             echo  $search->searchID($value);//gets values as one
         }
     }
}


?>


<div style="">
    <div background="">
    </div>

    <div>
    <table>

    </table>

    </div>
    <button>remove</button>

</div>





</body>
</html>
