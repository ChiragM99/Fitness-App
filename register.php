<?php






include 'classes/dbh.php';
include 'classes/member.php';
include 'classes/viewMember.php';
include 'classes/diary.php';
include 'classes/viewDiary.php';




require_once '/core/init.php';
$passed = false;
$validate = null;
if(Input::exists()) {
    //Get the token from the form which is set in the session(which is set as a session for the user)
    //Token is then in the source of the date_create_from_format
    //When form is submitted, check() to pass in the token thats supplied by the form
    if(Token::check(Input::get('token'))) {
        $validate = new Validation();
        $validates = $validate -> check($_POST, array(
            'fullname' => array(
                'required' => true,
                'min' => 1,
                'max' => 40,
                'disp_text' => 'Full Name'
            ),
            'age' => array(
                'required' => true,
                'min' => 1,
                'disp_text' => 'Age'
            ),
            'height' => array(
                'required' => true,
                'disp_text' => 'Height'
            ),
            'wight' => array(
                'required' => true,
                'disp_text' => 'Weight'
            ),
            'goals' => array(
              'disp_text' => 'goals'
            ),
            'userName' => array(
                'required' => true,
                'min' => 2,
                'max' => 17,
                'unique' => 'account',
                'disp_text' => 'Username'
            ),
            'email' => array(
                'required' => true,
                'disp_text' => 'Email',
                'unique' => 'account'
            ),
            'phone' => array(
                'required' => true,
                'disp_text' => 'Phone Number',
                'min' => 11,
                'max' => 15
            ),
            'password' => array(
                'required' => true,
                'min' => 5,
                'disp_text' => 'Password'

            ),
            'confirm-password' => array(
                'required' => true,
                'matches' => 'password',
                'disp_text' => 'Password Confirmation'
            )
        ));
        $passed = $validate -> passed();
        if($passed) {
            $account = new Account();
            $member = new viewMember();
            $foodDiary = new viewDiary();
            try {
                $account -> create(array(
                    'userName' => Input::get('userName'),
                    'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
                    'fullName' => Input::get('fullname'),
                    'age' => Input::get('age'),
                    'height' => Input::get('height'),
                    'wight' => Input::get('wight'),
                    'goals' => Input::get('goals'),
                    'email' => Input::get('email'),
                    'phone' => Input::get('phone'),
                    'joined' => date('Y-m-d H:i:s'),
                    'permission' =>  1
                ));

                Session::flash('home', 'You have been registered');

                $usName = $_POST['userName'];//should get username
                echo $usName;
                $accountID=$member ->getIDbyName($usName);
                echo $accountID;
                $foodDiaryID= $foodDiary -> createDiary($accountID);
                echo $foodDiaryID;
                $member -> setMembersFoodDiary($accountID,$foodDiaryID);


                Redirect::to('login.php');









            } catch(Exception $e) {
                die($e ->getMessage());
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


/* Add padding to containers */
.container {
  background-color: white;
  padding: 16px;
}

/* Full-width input fields */
input[type=text], input[type=password], input[type=email], input[type=number], input[type=textarea]:focus {
  display: inline-block;
  border: none;
  background: #f1f1f1;
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
}

input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, input[type=number]:focus, input[type=textarea]:focus {
  outline: none;
  background-color: #ddd;
}


hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;

}


.registerbutton {
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

.registerbutton:hover {
  opacity: 1;
}


a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  display: block;
  margin-left: auto;
  margin-right: auto;
  background-color: #f1f1f1;
  text-align: center;
  width: 100%;
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

<form name="register" action="" method="post">

  <div class="container">
    <div style="border:5px solid grey;">
      <?php

      if(!$passed)
      {
        if($validate != null)
        {
          foreach($validate -> errors() as $error) {
              echo "<div style = 'color:red;font-size:20px; position: right;'> $error</div>", '<br>';
          }
        }
      }
      ?>
    <div class="container">
      <h1 align="center">Register</h1>
      <center>Please fill in this form to create an account.</center>
    <hr>
    <label for="fullname">Full Name</label>
    <input type="text" name="fullname" value="<?php echo escape(Input::get('fullname')); ?>" id="fullname" placeholder="Enter Full Name">

    <label for="age">Age</label>
    <input type="number" name="age" value="<?php echo escape(Input::get('age')); ?>" id="age" placeholder="Enter Age">

    <label for="height">Height</label>
    <input type="number" step="any" name="height" value="<?php echo escape(Input::get('height')); ?>" id="height" placeholder="Enter Height"><span style="margin-left:-90px;">meters</span>

    <label for="wight">Weight</label>
    <input type="number" step="any" name="wight" value="<?php echo escape(Input::get('wight')); ?>" id="wight" placeholder="Enter Weight"><span style="margin-left:-50px;">kg</span>

    <label for="goals">Goals</label>
    <input type="text" name="goals" value="<?php echo escape(Input::get('goals')); ?>" id="goals" placeholder="Enter a goal">

      <label for="userName">Username</label>
      <input type="text" name="userName" id="userName" value="<?php echo escape(Input::get('userName')); ?>" autocomplete="off" placeholder="Enter Username">

      <label for="email">Email</label>
      <input type="email" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off" placeholder="Enter Email">

      <label for="phone">Phone Number</label>
      <input type="number" name="phone" id="phone" value="<?php echo escape(Input::get('phone')); ?>" autocomplete="off" placeholder="Enter Phone Number">

      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Enter Password">

      <label for="confirm-password">Confirm Password</label>
      <input type="password" name="confirm-password" id="confirm-password" placeholder="Repeat Password">
      <hr>
      <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

      <button type="submit" class="registerbutton">Register</button>
  </div>

    <input type="hidden" name="token" value="<?php echo Token::generate();?>">

    <div class="container signin">
      <p>Already have an account? <a href="login.php">Log in</a>.</p>
    </div>
  </div>
</form>

</body>
</html>
