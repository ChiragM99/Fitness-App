<?php
/**
 * Created by PhpStorm.
 * User: Martynas
 * Date: 21/03/2019
 * Time: 19:42
 */

//ini_set('memory_limit','53M');
include 'classes/dbh.php';
include 'classes/food.php';
include 'classes/viewFood.php';
include 'classes/recipe.php';
include 'classes/viewRecipe.php';
include 'classes/review.php';
include 'classes/viewReview.php';
include 'classes/member.php';
include 'classes/viewMember.php';
include 'classes/diary.php';
include 'classes/viewDiary.php';
require_once 'core/init.php';


$diary= new viewDiary();
$viewFood=new viewFood();
$member=new viewMember();
$recipe=new viewRecipe();
$account = new Account();


if(!$account -> isLoggedIn()) {
    Redirect::to('index.php');
}

if($account -> isLoggedIn()) {
    $accountID = $account -> getaccID(); //that's it
}



$datas=$member->getMembersCaloriesGoal($accountID);
foreach ($datas as $data) {
    $goals=$data['goals'];
    $calorieA=$data['calorieAllowance'];
    $foodDiaryID=$data['diaryID'];
    $weight=$data['wight'];
    $age=$data['age'];
    $height=$data['height'];
}

//$caloriesA=66 + (13.7 *$weight) + (5 * $height) - (6.8 * $age);//calorie callculation
$Dar=$diary->getDiaryN($foodDiaryID);

foreach ($Dar as $D) {
    $breakfast=$D['breakfast'];
    $lunch=$D['lunch'];
    $dinner=$D['dinner'];

}

if(isset($_POST['dinner'])) {
    $foodID=$_POST['dinner'];
    $foodID.=' ';
    $dinner = str_replace($foodID, '', $dinner);//this line removes food ID from string trimmed
    $diary->setdiarydinner($accountID,$dinner);

}

if(isset($_POST['lunch'])) {
    $foodID=$_POST['lunch'];
    $foodID.=' ';
    $lunch = str_replace($foodID, '', $lunch);//this line removes food ID from string trimmed
    $diary->setdiarylunch($accountID,$lunch);

}

if(isset($_POST['breakfast'])) {
    $foodID=$_POST['breakfast'];
    $foodID.=' ';
    $breakfast = str_replace($foodID, '', $breakfast);//this line removes food ID from string trimmed
    $diary->setdiarybreakfas($accountID,$breakfast);

}



?>
<html>
<head>
  <title> Food Diary </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="css/navbar.css" rel="stylesheet">
  <link href="css/style2.css" rel="stylesheet">
  <link href="css/CSS.css" rel="stylesheet">

    <style>

        *  {
            -webkit-transition: ease-in-out width 2s; /* Safari */
            transition: ease-in-out width 2s;
        }


        div.gallery {
        display: inline-block;
        min-width: 99.3%;

        margin: auto;
        border: 1px solid #ccc;
        border-radius: 8px;
        float: left;
        width: 180px;
    }

    div.gallery:hover {
        border: 1px solid #777;
    }

    div.gallery img {
        width: 50%;
        height: 200px;
        border-radius: 8px;
        float: right;

    }

    .Rary{
        display: inline-block;
        width: 33.3%;



        border: solid black 1px;
    }

    .btn{
             display: block;
             font-size:30px;
             margin-top: 20px ;
             width: 100%;
             background-color: #5bc0de;
             padding-top: 15px;
             padding-bottom: 15px;
             border-radius: 8px;
         }

        .btn:hover{

            background-color: #0f9ede;

        }


    h1{
        text-align: center;
    }


        .sibling-hover:hover ~ .sibling-highlight {
            background-color: #74ff69;
            color: white;
            display:block;

        }

        .sibling-highlight{
            display: none;
            transition: ease-out width 5s;
        }
        .link{
            background-color: #87f46e;
            width: 100%;
            color: white;
            padding-top: 25px;
            padding-bottom: 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 25px;


        }

        .link:hover{
            background-color: #16fa0c;
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
          <a href="test.php"><i class=""></i>Create Personal Food</a>
      <a href="update.php"><i class=""></i>Account Details</a>
      <a href="logout.php"><i class=""></i>Logout</a>
      </div>
      </div>
          <a href="search.php"><i class="fa fa-fw fa-search"></i>Search</a>


  </div>


<a class="link" href="test.php">Add personal food<a>


<form action="" method="post">

<?php





echo '<div class="Rary"><h1>breakfast</h1>';
$foodD = explode(" ", $breakfast);//explodes into array
foreach ($foodD as $foodIDS) {
    if ($foodIDS != ' '||$foodIDS != '') {
        $datas = $viewFood->searchID($foodIDS);//gets values as one
        if(isset($datas)) {
            foreach ($datas as $data) {
                echo '<div class="gallery">';

                echo "<img src=".$data['imgRef']." alt=\"Image not available\" width=\"300\" height=\"200\">";
                echo '<h4>'.$data['foodName'].'</h4>';
                echo '<h4>Calories:'.$data['Calories'].'</h4>';
                echo '<table>';
                echo "<tr><th>Fat: </th><th>" . $data['Fat'] . "</th></tr>";
                echo "<tr><th>Carbs:</th><th>" . $data['Carbs'] . "</th></tr>";
                echo "<tr><th>Protein:</th><th>" . $data['Protein'] . "</th></th>";
                echo "<tr><th>Type:</th><th>" . $data['Type'] . "</th></tr>";
                echo '</table>';

                if($data['RecipeID']!=''||$data['RecipeID']!=0){
                     $Rec=$recipe->getall($data['FoodID']);
                    if(isset($Rec)) {
                        echo '<div class="sibling-hover"> See Recipie</div>';
                        foreach ($Rec as $da) {

                            echo "<div class='sibling-highlight' '> <h1>Recipie</h1>
                                  <table>";

                            echo "<tr><th>Ingrediants</th><th>Instructions</th></tr>";
                            echo "<tr><td>" . $da['Ingrediants'] . "</td><td>" . $da['Instructions'] . "</td></tr>";

                            echo "</table>
                                  </div>";
                        }
                    }
                }

                echo '<button type="submit" value="'.$data['FoodID'].'" name="breakfast" class="btn" style="display: none;"></button>';
                echo '<button type="submit" value="'.$data['FoodID'].'" name="breakfast" class="btn">Remove</button>';
                echo '</div>';
            }
        }
    }
}
echo '</div>';



echo '<div class="Rary"><h1>lunch</h1>';
    $foodD = explode(" ", $lunch);//explodes into array
    foreach ($foodD as $foodIDS) {
        if ($foodIDS != ' '||$foodIDS != '') {
            $datas = $viewFood->searchID($foodIDS);//gets values as one
            if(isset($datas)) {
                foreach ($datas as $data) {
                    echo '<div class="gallery">';

                    echo "<img src=".$data['imgRef']." alt=\"Image not available\" width=\"300\" height=\"200\">";
                    echo '<h4>'.$data['foodName'].'</h4>';
                    echo '<h4>Calories:'.$data['Calories'].'</h4>';
                    echo '<table>';
                    echo "<tr><th>Fat: </th><th>" . $data['Fat'] . "</th></tr>";
                    echo "<tr><th>Carbs:</th><th>" . $data['Carbs'] . "</th></tr>";
                    echo "<tr><th>Protein:</th><th>" . $data['Protein'] . "</th></th>";
                    echo "<tr><th>Type:</th><th>" . $data['Type'] . "</th></tr>";
                    echo '</table>';

                    if($data['RecipeID']!=''||$data['RecipeID']!=0){
                        $Rec=$recipe->getall($data['FoodID']);
                        if(isset($Rec)) {
                            echo '<div class="sibling-hover"> See Recipie</div>';
                            foreach ($Rec as $da) {

                                echo "<div class='sibling-highlight' '> <h1>Recipie</h1>
                                  <table>";

                                echo "<tr><th>Ingrediants</th><th>Instructions</th></tr>";
                                echo "<tr><td>" . $da['Ingrediants'] . "</td><td>" . $da['Instructions'] . "</td></tr>";

                                echo "</table>
                                  </div>";
                            }
                        }
                    }

                    echo '<button type="submit" value="'.$data['FoodID'].'" name="lunch" class="btn" style="display: none;"></button>';
                    echo '<button type="submit" value="'.$data['FoodID'].'" name="lunch" class="btn">Remove</button>';
                    echo '</div>';
                }
            }
        }
    }
echo '</div>';


echo '<div class="Rary"><h1>dinner</h1>';
$foodD = explode(" ", $dinner);//explodes into array
foreach ($foodD as $foodIDS) {
    if ($foodIDS != ' '||$foodIDS != '') {
        $datas = $viewFood->searchID($foodIDS);//gets values as one
        if(isset($datas)) {
            foreach ($datas as $data) {
                echo '<div class="gallery">';

                echo "<img src=".$data['imgRef']." alt=\"Image not available\" width=\"300\" height=\"200\">";
                echo '<h4>'.$data['foodName'].'</h4>';
                echo '<h4>Calories:'.$data['Calories'].'</h4>';
                echo '<table>';
                echo "<tr><th>Fat: </th><th>" . $data['Fat'] . "</th></tr>";
                echo "<tr><th>Carbs:</th><th>" . $data['Carbs'] . "</th></tr>";
                echo "<tr><th>Protein:</th><th>" . $data['Protein'] . "</th></th>";
                echo "<tr><th>Type:</th><th>" . $data['Type'] . "</th></tr>";
                echo '</table>';

                if($data['RecipeID']!=''||$data['RecipeID']!=0){
                    $Rec=$recipe->getall($data['FoodID']);
                    if(isset($Rec)) {
                        echo '<div class="sibling-hover"> <b>See Recipie</b></div>';
                        foreach ($Rec as $da) {

                            echo "<div class='sibling-highlight' '> <h1>Recipie</h1>
                                  <table>";

                            echo "<tr><th>Ingrediants</th><th>Instructions</th></tr>";
                            echo "<tr><td>" . $da['Ingrediants'] . "</td><td>" . $da['Instructions'] . "</td></tr>";

                            echo "</table>
                                  </div>";
                        }
                    }
                }

                echo '<button type="submit" value="'.$data['FoodID'].'" name="dinner" class="btn" style="display: none;"></button>';
                echo '<button type="submit" value="'.$data['FoodID'].'" name="dinner" class="btn">Remove</button>';
                echo '</div>';
            }
        }
    }
}
echo '</div>';


?>
    <script>
        // When the user clicks on div, open the popup
        function myFunction() {
            var popup = document.getElementById("myPopup");
            popup.classList.toggle("show");
        }
    </script>
</form>

</body>
</html>
