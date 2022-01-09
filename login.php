<?php
require_once 'core/init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validation();
        $validation = $validate -> check($_POST, array(
            'userName' => array('required' => TRUE, 'disp_text' => 'Username'),
            'password' => array('required' => TRUE, 'disp_text' => 'Password')
        ));

        if($validation -> passed()) {
            $account = new Account();
            $login = $account -> login(Input::get('userName'), Input::get('password'));

            if($login) {
                Redirect::to('index.php');
            } else{
                echo "<div style = 'color:red;font-size:20px;position:right;'> Username or Password is Incorrect</div>", '<br>';
            }
        }  else {
            foreach($validation -> errors() as $error) {
                echo "<div style = 'color:red;font-size:20px;position:right;'> $error</div>", '<br>';
            }
        }
    }
}
?>





<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/login.css" rel="stylesheet">

</head>
<body>

  <div class ="navbar">
   <div class = "container">
      <div class ="logo">
        <img src ="img/logo.jpeg" alt="logo" class="logo">
      </div>
      </div>

        <a href="index.php">Home</a>
        <a href="search.php">Search</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>



<form action="" method="post">
  <h2>Login Form</h2>
  <div style="border:5px solid grey;">
    <div class="logincontainer">
        <label for="userName">Username</label>
        <input type="text" name="userName" id="userName" autocomplete="off" value="<?php echo escape(Input::get('userName')); ?>" placeholder="Enter Username">


        <label for="password">Password</label>
        <input type="password" name="password" id="password" autocomplete="off" placeholder="Enter Password">

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <button type="submit">Login</button>
    </div>
</div>
</form>
</body>
</html>
