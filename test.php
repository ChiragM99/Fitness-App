<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 18/03/2019
 * Time: 21:18
 */
require_once 'core/init.php';
include 'classes/dbh.php';
include 'classes/food.php';
include 'classes/viewFood.php';
include 'classes/recipe.php';
include 'classes/viewRecipe.php';
include 'classes/review.php';
include 'classes/viewReview.php';
include 'classes/diary.php';
include 'classes/viewDiary.php';

// set food works
$setFood= new viewFood();
$setRecipe= new viewRecipe();
$foodDiary= new viewDiary();
$account=new Account();

if(!$account -> isLoggedIn()) {
    Redirect::to('index.php');
}

if($account -> isLoggedIn()) {
    $accountID = $account -> getaccID(); //that's it
}

$datas=$foodDiary->getDiary($accountID); // gets food diary
foreach ($datas as $data) {
    $DiaryBreakfast=$data['breakfast'];
    $DiaryLunch=$data['lunch'];
    $DiaryDinner=$data['dinner'];

}




if(isset($_POST["submit"])){

    if($_POST['name']==""){
        echo "name required <br>";
        echo "input calories <br>";
        echo "input fat <br>";
        echo "input carbs <br>";
        echo "input protein <br>";
        echo "choose type";
    }

    else {
        $name = $_POST['name'];
        $check = $setFood->searchName($name);
        echo $check;

        if ($_POST['img'] == "") {
            echo 'set url';
            echo "input calories <br>";
            echo "input fat <br>";
            echo "input carbs <br>";
            echo "input protein <br>";
            echo "choose type";
        }

        else {$url=$_POST['img'];

            if ($name == $check) {
                echo "This food already exists";

            }
            else {

                if ($_POST['calories'] == "") {
                    echo "input calories <br>";
                    echo "input fat <br>";
                    echo "input carbs <br>";
                    echo "input protein <br>";
                    echo "choose type";


                }

                else {
                    $calories = $_POST['calories'];

                    if ($_POST['fat'] == "") {
                        echo "input fat <br>";
                        echo "input carbs <br>";
                        echo "input protein <br>";
                        echo "choose type";
                    }

                    else {
                        $fat = $_POST['fat'];

                        if ($_POST['carbs'] == "") {
                            echo "input carbs <br>";
                            echo "input protein <br>";
                            echo "choose type";


                        }

                        else {
                            $carbs = $_POST['carbs'];

                            if ($_POST['protein'] == "") {

                                echo "input protein <br>";
                                echo "choose type";

                            }

                            else {
                                $protein = $_POST['protein'];

                                if ($_POST['Type'] == "") {
                                    echo "select type";
                                }


                                else {
                                    $type = $_POST['Type'];
                                    $FoodID = $setFood->addFood($name, $calories, $fat, $carbs, $protein, $type,$url);


                                    if ($_POST['diary'] == "") {
                                        echo 'Need to chose where you want to add';
                                    }

                                    else {
                                        $FoodID .= ' ';
                                        $R = $_POST['diary'];
                                        echo $R;
                                        if ($R == 'Breakfast') {
                                            $DiaryBreakfast .= $FoodID;
                                            $foodDiary->setdiarybreakfas($accountID, $DiaryBreakfast);
                                            if ($_POST['ingredients'] == "") {


                                            }
                                            else {
                                                $ingredients = $_POST['ingredients'];

                                                if ($_POST['instructions'] == "") {


                                                }
                                                else {
                                                    $instructions = $_POST['instructions'];

                                                    $recipeID = $setRecipe->setRecipie($ingredients, $instructions, $FoodID);


                                                    $setFood->setRID($FoodID, $recipeID);
                                                }
                                            }
                                            Redirect::to('/foodDiary.php');
                                        } else if ($R == 'Lunch') {
                                            $DiaryLunch .= $FoodID;
                                            $foodDiary->setdiarylunch($accountID, $DiaryLunch);
                                            if ($_POST['ingredients'] == "") {


                                            }
                                            else {
                                                $ingredients = $_POST['ingredients'];

                                                if ($_POST['instructions'] == "") {


                                                }
                                                else {
                                                    $instructions = $_POST['instructions'];

                                                    $recipeID = $setRecipe->setRecipie($ingredients, $instructions, $FoodID);


                                                    $setFood->setRID($FoodID, $recipeID);
                                                }
                                            }
                                            Redirect::to('/foodDiary.php');
                                        } else if ($R == 'Dinner') {
                                            $DiaryDinner .= $FoodID;
                                            $foodDiary->setdiarydinner($accountID, $DiaryBreakfast);
                                            if ($_POST['ingredients'] == "") {


                                            }
                                            else {
                                                $ingredients = $_POST['ingredients'];

                                                if ($_POST['instructions'] == "") {


                                                }
                                                else {
                                                    $instructions = $_POST['instructions'];

                                                    $recipeID = $setRecipe->setRecipie($ingredients, $instructions, $FoodID);


                                                    $setFood->setRID($FoodID, $recipeID);
                                                }
                                            }
                                            Redirect::to('/foodDiary.php');
                                        }

                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="EN">

<head>
    <style>

        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=number], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        div {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        #recipe{
            display: none;

        }


    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/style2.css" rel="stylesheet">
    <link href="css/CSS.css" rel="stylesheet">

</head>
<body>

<div class ="navbar">
    <div class = "container">
        <div class ="logo">
            <img src ="img/logo.jpeg" alt="logo" class="logo">
        </div>
    </div>


    <a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a>
    <div class="dropdown">
        <button class="dropbtn">Hello <?php echo escape($account -> data() -> userName); ?>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="foodDiary.php"><i class=""></i>Food Diary</a>
            <a href="test.php"><i class=""></i>Create Personal Food</a>
            <a href="update.php"><i class=""></i>Account Details</a>
            <a href="logout.php"><i class=""></i>Logout</a>
        </div>
    </div>
    <a href="search.php"><i class="fa fa-fw fa-search"></i>Search</a>


</div>

<h1>Create your personal food</h1>
<form action="#" method="post" id="sample">

    <label for="name">Name:</label><input type="text" name="name" placeholder="Enter Name">
    <label for="calories">Calories: </label><input type="number" name="calories" min="0" placeholder="Enter Calories">
    <label for="fat">Fat: </label><input type="number" name="fat" min="0" placeholder="Enter Fat">
    <label for="carbs">Carbs: </label><input type="number" name="carbs" min="0">
    <label for="protein">Protein: </label><input type="number" name="protein" min="0">
    <label for="protein">URL: </label><input type="text" name="img" placeholder="Coppy image url from google">
    <label for="type">Where to add</label>

    <select  name="diary"">
    <option disabled selected> Select where to add </option>
    <option value="Breakfast">Breakfast</option>
    <option value="Lunch">Lunch</option>
    <option value="Dinner">Dinner</option>
    </select>
    <label for="type">Type:</label>
    <select id="mySelect" name="Type" onchange="myFunction()">
        <option disabled selected> Select Type </option>
        <option value="Breakfast">Breakfast</option>
        <option value="Lunch">Lunch</option>
        <option value="Dinner">Dinner</option>
        <option value="Fruit">Fruit</option>
        <option value="Vegetable">Vegetable</option>
        <option value="Desert">Desert</option>
        <option value="Drink">Drink</option>
        <option value="Meal">Meal</option>
    </select>







    <p id="demo"></p>

    <script>

        function myFunction() {
            var x = document.getElementById("mySelect");
            var i = x.selectedIndex;
            var y = x.options[i].text;
            if(y=="Breakfast"||y=="Lunch"|| y=="Diner"||y=="Meal"||y=="Desert") {
                document.getElementById("recipe").style.display = "inline-block";
            }
            else{
                document.getElementById("recipe").style.display = "none";
            }
        }
    </script>

    <div id="recipe">
        <h1>Want to add recipie ?</h1>
        <label for="calories"> Ingredients:</label></br>
        <textarea type="text" name="ingredients" rows="4" cols="50"></textarea><br>


        <label for="calories"> Instructions:</label></br>
        <textarea type="text" name="instructions" rows="4" cols="50"></textarea>



    </div>

    <input type="submit" name="submit">

</form>




</body>
</html>

