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
require_once 'core/init.php';

$account = new Account();
if($account -> isLoggedIn()) {
    $accountID = $account->getaccID();


        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title> 3HealthyWay </title>
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

        </body>
        </html>
        <?php

}
$search= new viewFood();
?>

<html lang="en">
<head>

    <title> 3HealthyWay </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/style2.css" rel="stylesheet">
    <style>
        table {
            border-collapse: collapse;

            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        input[type=submit],button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=text], select {

            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn{
            display: block;
            font-size:30px;
            margin-top: 20px ;
            width: 100%;
            background-color: #5bc0de;
            padding-top: 25px;

        }

        .btn:hover {
            background-color: #0eadde;
        }


        div.gallery {
            display:inline-block;
            min-width:32%;
            padding:0.2%;
            margin:0.1%;
            border: 1px solid #ccc;
            border-radius: 8px;
            float: left;
            width: 180px;
        }

        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 100%;
            height: 200px;
            border-radius: 8px;

        }


    </style>
    <title>Search</title>
</head>
<body>

<!--<div class ="navbar">
    <div class = "container">
        <div class ="logo">
            <img src ="img/logo.jpeg" alt="logo" class="logo">
        </div>
    </div>

    <a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <a href="search.php"><i class="fa fa-fw fa-search"></i>Search</a>

</div>
-->
<form action="" method="post">
    <input type="text" placeholder="Search.." name="search">
    <button type="submit" name="submitSearch">search</button>

    <h2>search by types</h2>
    <input type="submit" value="breakfast" name="btn">
    <input type="submit" value="lunch" name="btn">
    <input type="submit" value="dinner" name="btn">
    <input type="submit" value="fruit" name="btn">
    <input type="submit" value="vegetable" name="btn">
    <input type="submit" value="desert" name="btn">
    <input type="submit" value="drink" name="btn">
    <input type="submit" value="meal" name="btn">





</form>




<form action="Xfood.php" method="post">

<?php
//search
if(isset($_POST['submitSearch'])) {
    if ($_POST['search'] != "") {
        $name = $_POST['search'];
        $datas = $search->search($name);
        if (isset($datas)) {

            echo '<h1> here is your results for searching this name: ' . $name . '<h1>';
            foreach ($datas as $data) {
                echo '<div class="gallery">';
                echo "<img src=" . $data['imgRef'] . " alt=\"Image not available\" width=\"300\" height=\"200\">";
                echo '<h4>Name:' . $data['foodName'] . '</h4>';
                echo '<h4>Calories:' . $data['Calories'] . '</h4>';

                echo '<button type="submit" value="' . $data['FoodID'] . '" name="btn" class="btn">';

                echo "View Food</button>";


                echo '</div>';
            }
        } else {
            echo '<h1>Unfortunatly there is no results for this name: '.$name.'</h1>';
            echo '<h1><a href="test.php">Would you like to create personal food</a></h1>';


        }
    } else {
        echo '<h1 style="color:red">Please enter a search value<h1>';
    }
}

if(isset($_POST['btn'])){
    $type=$_POST['btn'];
    $datas=$search->searchType($type);
    if (isset($datas)) {
        echo'<h1> here is your results for searching this type: '.$type.'<h1>';
        foreach ($datas as $data) {


            echo '<div class="gallery">';
            echo "<img src=".$data['imgRef']." alt=\"Image not available\" width=\"300\" height=\"200\">";
            echo '<h4>Name:'.$data['foodName'].'</h4>';
            echo '<h4>Calories:'.$data['Calories'].'</h4>';

            echo '<button type="submit" value="'.$data['FoodID'].'" name="btn" class="btn">';

            echo "View Food</button>";


            echo '</div>';





        }
    }else{
        echo "<h1>no extries with such type: ".$type. "<h1>";
    }



}


?>
</form>
</body>
</html>
