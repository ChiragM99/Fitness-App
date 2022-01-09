<?php
require_once 'core/init.php';

if(Session::exists('home')) {
   echo '<p>' . Session::flash('home') . '</p>';
}


//echo Session::get(Config::get('session/session_name'));
$account = new Account();
if($account -> isLoggedIn()) {
    $accountID = $account -> getaccID();

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

?>

<?php
if(!$account -> isLoggedIn()) {
?>
<!DOCTYPE html>
<html>
<head>
  <title> 3HealthyWay </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="css/navbar.css" rel="stylesheet">
  <link href="css/style2.css" rel="stylesheet">

  <style>
  body, html {
    height: 100%;
    margin: 0;
    background: #f2f2f2;
    font-family: 'Open Sans', sans-serif;
  }

  * {
    box-sizing: border-box;
  }

  .bg-image {
    /* The image used */
    background-image: url("css/background1.jpg");

    /* Add the blur effect */
    filter: blur(8px);
    -webkit-filter: blur(8px);

    /* Full height */
    height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }

  /* Position text in the middle of the page/image */
  .bg-text {
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
    color: white;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
    width: 80%;
    padding: 20px;
    text-align: center;
  }
  </style>

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

</div>

<div class="bg-image"></div>

<div class="bg-text">
  <h1>Welcome to 3HealthyWay</h1>
  <p>A fitness application that helps you acheive your goals</p><br>
  <p>Get started</p>
  <form class="search" action="search.php">
    <input type="search" placeholder="Search food..." required>
    <button type="submit">Search</button>
  </form>

</div>


<?php
}
?>


</body>
</html>
