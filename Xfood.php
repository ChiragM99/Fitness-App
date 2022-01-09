<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 21/03/2019
 * Time: 19:48
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
include 'classes/Redirect.php';
include 'classes/diary.php';
include 'classes/viewDiary.php';
require_once '/core/init.php';
$foodDiary=new viewDiary();//gets food diary
$food= new viewFood();
$review= new viewReview();
$account= new Account();


if(!$account -> isLoggedIn()) {
    Redirect::to('index.php');
}

if($account -> isLoggedIn()) {
    $accountID = $account -> getaccID(); //that's it
}

$recipe=new viewRecipe();
$t=time();
date_default_timezone_set('UTC');
$date=date("Y-m-d h:i:sa", $t);
$member= new viewMember(); //account


$datas=$member->getMembersCaloriesGoal($accountID); // gets from account member diary id
foreach ($datas as $data) {
    $foodDiaryID=$data['diaryID'];//food diary id
}


$datas=$foodDiary->getDiary($accountID); // gets food diary
foreach ($datas as $data) {
    $DiaryBreakfast=$data['breakfast'];
    $DiaryL=$data['lunch'];
    $DiaryDinner=$data['dinner'];

}

if(isset($_POST['btn'])){
    $foodID=$_POST['btn'];

}

if(isset($_POST['add'])){
    $foodID=$_POST['add'];


    if(isset($_POST['col'])){
        $foodID.=' ';

        $R=$_POST['col'];
        if($R=='breakfast'){

            $DiaryBreakfast.=$foodID;
            $foodDiary->setdiarybreakfas($accountID,$DiaryBreakfast);

        }else if($R=='lunch'){

            $DiaryL.=$foodID;
            $foodDiary->setdiarylunch($accountID,$DiaryL);

        }else if($R=='diner'){

            $DiaryDinner.=$foodID;
            $foodDiary->setdiarydinner($accountID,$DiaryBreakfast);
        }
        Redirect::to('/foodDiary.php');
    }
}





if(isset($_POST['review'])){
    $foodID=$_POST['review'];

    if(isset($_POST['comment'])) {
        $comment=$_POST['comment'];

        if (isset($_POST['rating'])) {
                $rating=$_POST['rating'];

            $review->addReview($comment, $rating, $date, $accountID, $foodID);//returns review id
        }else{
            $rating=0;
            $review->addReview($comment, $rating, $date, $accountID, $foodID);//returns review id
        }
    }

}




$datas=$food->searchID($foodID);//gets values as one
foreach ($datas as $data) {

?>
<html>
<head>
  <title> 3HealthyWay </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="css/navbar.css" rel="stylesheet">
  <link href="css/style2.css" rel="stylesheet">
  <link href="css/CSS.css" rel="stylesheet">
    <style>
        /*dont mind this is for radio butons*/
        *{font-family: 'Roboto', sans-serif;}

        @keyframes click-wave {
            0% {
                height: 40px;
                width: 40px;
                opacity: 0.35;
                position: relative;
            }
            100% {
                height: 200px;
                width: 200px;
                margin-left: -80px;
                margin-top: -80px;
                opacity: 0;
            }
        }

        .option-input {
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            -o-appearance: none;
            appearance: none;
            position: relative;
            top: 13.33333px;
            right: 0;
            bottom: 0;
            left: 0;
            height: 40px;
            width: 40px;
            transition: all 0.15s ease-out 0s;
            background: #cbd1d8;
            border: none;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            margin-right: 0.5rem;
            outline: none;
            position: relative;
            z-index: 1000;
        }
        .option-input:hover {
            background: #9faab7;
        }
        .option-input:checked {
            background: #40e0d0;
        }
        .option-input:checked::before {
            height: 40px;
            width: 40px;
            position: absolute;
            content: '✔';
            display: inline-block;
            font-size: 26.66667px;
            text-align: center;
            line-height: 40px;
        }
        .option-input:checked::after {
            -webkit-animation: click-wave 0.65s;
            -moz-animation: click-wave 0.65s;
            animation: click-wave 0.65s;
            background: #40e0d0;
            content: '';
            display: block;
            position: relative;
            z-index: 100;
        }
        .option-input.radio {
            border-radius: 50%;
        }
        .option-input.radio::after {
            border-radius: 50%;
        }

        /*dont mind this is for radio butons*/

        .rating {
            float:left;
        }

        /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t
           follow these rules. Every browser that supports :checked also supports :not(), so
           it doesn’t make the test unnecessarily selective */
        .rating:not(:checked) > input {
            position:absolute;
            top:-9999px;
            clip:rect(0,0,0,0);
        }

        .rating:not(:checked) > label {
            float:right;
            width:1em;
            padding:0 .1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:200%;
            line-height:1.2;
            color:#ddd;
            text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
        }

        .rating:not(:checked) > label:before {
            content: '★ ';
        }

        .rating > input:checked ~ label {
            color: #f70;
            text-shadow:1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0,0,0,.5);
        }

        .rating:not(:checked) > label:hover,
        .rating:not(:checked) > label:hover ~ label {
            color: gold;
            text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
        }

        .rating > input:checked + label:hover,
        .rating > input:checked + label:hover ~ label,
        .rating > input:checked ~ label:hover,
        .rating > input:checked ~ label:hover ~ label,
        .rating > label:hover ~ input:checked ~ label {
            color: #ea0;
            text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
        }

        .rating > label:active {
            position:relative;
            top:2px;
            left:2px;
        }

        /*dont mind this*/








        body{
        background-image: url("<?php echo $data['imgRef']?>");
        }
        .content{
            display: grid;
            background-color: #898989;
            opacity: 0.9;
            padding: 50px;

        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

         th, td {
            text-align: left;
            padding: 8px;
             border-right: solid #0a2b1d;
             border-top: solid #0a2b1d;
        }

         tr:nth-child(even){background-color: #f2f2f2}

         th {
            background-color: #4CAF50;
            color: white;
        }

        .food{
            display: inline-block;
            float: left;
            margin-left:20px;
            margin-top:20px;
            padding: 30px;
            border: solid 2px #5bc0de;
            border-radius: 30px;
            opacity:0.9;
        }


        #R{
            background-color: #6c04d4;
        }
        button[type=submit]{
            display: block;
            font-size:30px;
            margin-top: 20px ;
            width: 100%;
            background-color: #71de7b;
            padding: 10px;
            border-radius: 10px;

        }

        button[type=submit]:hover{

            background-color: #13de04;



        }



    </style>
    <table>

    </table>
</head>
<body>

<div class="content">
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
    <a href="update.php"><i class=""></i>Account Details</a>
    <a href="logout.php"><i class=""></i>Logout</a>
    </div>
    </div>
        <a href="search.php"><i class="fa fa-fw fa-search"></i>Search</a>


</div>
    <?php




        echo "<div class='food' '>
                <h1>" . $data['foodName'] . "</h1>
                       <table>";
        echo "<tr><th>Calories:</th><td>" . $data['Calories'] . "</td></tr>";
        echo "<tr><th>Fat: </th><td>" . $data['Fat'] . "</td></tr>";
        echo "<tr><th>Carbs:</th><td>" . $data['Carbs'] . "</td></tr>";
        echo "<tr><th>Protein:</th><td>" . $data['Protein'] . "</td></th>";
        echo "<tr><th>Type:</th><td>" . $data['Type'] . "</td></tr>";
        echo "</table></div>";
    }
    //from here
    $datas=$recipe->getall($foodID);
    if(isset($datas)) {
        foreach ($datas as $data) {

            echo "<div class='food' '> <h1>Recipie</h1>
                       <table>";

            echo "<tr><th>Ingrediants</th><th>Instructions</th></tr>";
            echo "<tr><td>" . $data['Ingrediants'] . "</td><td>" . $data['Instructions'] . "</td></tr>";

            echo "</table></div>";
        }
    }
    //to here u can use where u want to get recipie ingrediants etc where u want. just inport and create
    // the instance 'class of viewRecipie' and then you should be able to see this anywhere :)
    // have fun
    ?>

    <div class="food">
    <form action="" method="post">
        <h1>Want to add ?</h1>
        <h2>choose where:</h2>
        Breakfast : <input type="radio" value="breakfast" name="col" class="option-input radio">
        Lunch : <input type="radio" value="lunch" name="col" class="option-input radio">
        Dinner: <input type="radio" value="diner" name="col" class="option-input radio">
        <br>
        <br>
        <br>
        <br>
        <button type="submit" name="add" value="<?php echo $foodID;?>" style="display: none">   AddFood to foodDiary   </button>
        <button type="submit" name="add" value="<?php echo $foodID;?>">   Add Food to Diary  </button>
    </form>

    </div>

</div>



<div class="content" id="R">
    <div class="food">
<h1>Reviews</h1>
<form action="#" method="post">
    <h2>Comment:</h2>
    <textarea type="text" name="comment" placeholder="Enter your comment" rows="4" cols="50"></textarea><br>
    <br>
    <br>
    <br>
    <div class="star-rating">
        <fieldset class="rating">
            <legend>Please rate:</legend>
            <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
        </fieldset><br>
    </div>
    <br><br><br>

    <button type="submit" name="review" value="<?php echo $foodID;?>" style="display: none">   AddFood to foodDiary   </button>
    <button type="submit" name="review" value="<?php echo $foodID;?>">   Submit Review   </button>
</form>



</div>
<div class="food">
<?php
$datas=$review->getReview($foodID);
if(isset($datas)) {
    foreach ($datas as $data) {

        echo "<div style='display: inline-block; margin: 10px ; '>
                   <table>";
        echo "<tr><th>date:</th><th>" . $data['dateR'] . "</th></tr>";
        echo "<tr><th>comment:</th><th>" . $data['comment'] . "</th></tr>";
        echo "<tr><th>rating: </th><th>" . $data['rating'] . "</th></tr>";

        $mDATA = $member->getMembersCaloriesGoal($data['accountID']); // gets from account member username for review
        foreach ($mDATA as $dat) {
            echo "<tr><th>Username:</th><th>" . $dat['userName'] . "</th></tr>";
        }


        echo "</table></div>";
    }
}

?>

    </div>
</div>
</body>
</html>
