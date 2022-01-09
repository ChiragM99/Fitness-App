<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 25/03/2019
 * Time: 11:00
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
$account= new Account();
$member=new viewMember();


if($account -> isLoggedIn()) {
    $accountID = $account -> getaccID(); //that's it
}


if(isset($_POST["submit"])){

    if(isset($_POST['fullName'])) {

        $name=$_POST['fullName'];


        if (isset($_POST['email'])) {

            $email=$_POST['email'];


            if (isset($_POST['phone'])){

                $phone=$_POST['phone'];

                if (isset($_POST['age'])){

                    $age=$_POST['age'];

                    if (isset($_POST['height'])){

                        $heihgt=$_POST['height'];

                        if (isset($_POST['wight'])){

                            $weight=$_POST['wight'];

                            if (isset($_POST['goals'])){

                                $goals=$_POST['goals'];

echo $accountID. $name. $email. $phone. $age. $heihgt. $weight. $goals;
                                $member->setMembersPersonal($accountID, $name, $email, $phone, $age, $heihgt, $weight, $goals);

                            }
                        }
                    }
                }
            }
        }
    }
}







?>

<html><head>
    <title>
        Account Details
    </title>

    <style>
        body {
            font-family: Verdana;
            background-color: white;
            background-image: url(https://previews.123rf.com/images/phonlamaiphoto/phonlamaiphoto1610/phonlamaiphoto161000380/63713513-3d-rendering-metal-dumbbell-with-gym-background.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: block;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 5%;
        }

        * {
            box-sizing: border-box;
        }


        /* Add padding to containers */
        .container {
            background-color: white;
            padding: 16px;
        }

        /* Full-width input fields */
        input[type=text], input[type=password], input[type=number], input[type=email] {
            display: inline-block;
            border: none;
            background: #f1f1f1;
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
        }

        input[type=text]:focus, input[type=password]:focus, input[type=number], input[type=email]   {
            outline: none;
            background-color: #ddd;
        }


        a {
            color: dodgerblue;
        }

        .border{
            border: 5px solid grey;
            background-color: white;
            padding: 16px;
        }
        .updatebutton {
            cursor: pointer;
            width: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.9;
            background-color: #4CAF50;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
        }

        .updatebutton:hover {
            opacity: 1;
        }

    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/style2.css" rel="stylesheet">
</head>
<body>
<div class ="navbar">
    <div class = "container">
        <div class ="logo">
            <img src ="img/logo.jpeg" alt="logo" class="logo">
        </div>
    </div>

    <a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <a href="search.php"><i class="fa fa-fw fa-search"></i>Search</a>
    <a href="logout.php"><i class="fa fa-fw fa-search"></i>Logout</a>

</div>
<div class="fieldn container">

<form action="#" method="post">

                <h1 style=" text-align: center;"> Account Details</h1>
                <label for="fullName">Full Name</label>
                <input type="text" name="fullName" placeholder="Enter your new name">

                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter your new email">
                <label for="phone">Phone Number</label>
                <input type="number" name="phone" placeholder="Enter your new phone">

        <label for="age">Age</label>
        <input type="number" name="age" placeholder="Enter your  new age">

        <label for="height">Height</label>
        <input type="number" step="any" name="height"  id="height" placeholder="Enter your  new  Height"></span>

        <label for="wight">Weight</label>
        <input type="number" step="any" name="wight"  placeholder="Enter your new Weight"></span>

        <label for="goals">Goals</label>
        <input type="text" name="goals"  id="goals" placeholder="Enter your new goals">

        <input type="submit" value="submit" class="updatebutton">
    </form>
</div>

</body>
</html>

