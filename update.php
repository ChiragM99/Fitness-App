<?php





require_once 'core/init.php';

// u get age and height from db  before u do this
// then u update weight and update calorie allowance as given result
//$caloriesAllowence=66 + (13.7 *$weight) + (5 * $height) - (6.8 * $age);//calorie callculation

$account = new Account();

if(!$account -> isLoggedIn()) {
    Redirect::to('index.php');
}
if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validation();
        $validation = $validate -> check($_POST, array(
            'fullName' => array(
                'max' => 50,
                'disp_text' => 'Full Name'
            ),
            'email' => array(
                'max' => 50,
                'disp_text' => 'Email',
                'unique' => 'account'
            ),
            'phone' => array(
                'min' => 11,
                'max' => 15,
                'disp_text' => 'Phone Number'
            ),
            'age' => array(
            ),
            'height' => array(
            ),
            'wight' => array(
            ),
            'goals' => array(
                'max' => 60
            )

        ));
        if($validation -> passed()) {
            try {
                $account -> update(array(
                    'fullName' => Input::get('fullName'),
                    'email' => Input::get('email'),
                    'phone' => Input::get('phone'),
                    'age' => Input::get('age'),
                    'height' => Input::get('height'),
                    'wight' => Input::get('wight'),
                    'goals' => Input::get('goals')
                ));

                Session::flash('home', 'Your account details have been updated');

            } catch(Exception $e) {
                die($e -> getMessage());
            }

        } else {
            foreach($validation -> errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}


if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validation();
        $validation = $validate -> check($_POST, array(
            'current_password' => array(
                'required' => TRUE,
                'min' => 5,
                'disp_text' => ' Current Password'
            ),
            'new_password' => array(
                'required' => TRUE,
                'min' => 5,
                'disp_text' => 'New Password'
            ),
            'new_password_confirm' => array(
                'required' => TRUE,
                'min' => 5,
                'matches' => 'new_password',
                'disp_text' => ' New Password Confirmation'
            )
        ));

    if($validation -> passed()) {
        if(password_hash(Input::get('current_password'), PASSWORD_DEFAULT) !== $account -> data() -> password) {
                echo 'Current password is incorrect';
            } else {
              $account -> update(array(
                  'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT)
              ));
                Session::flash('home', 'Your password has been changed');
            }
        } else {
            foreach ($validation -> errors() as $error) {
              echo $error, '<br>';
            }
        }
    }
}

?>
<html>
<head>
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
            font-color:white;
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
  <link href="css/navbar.css" rel="stylesheet">
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
            <a href="foodDiary.php"><i class="fa fa-fw fa-search"></i>Food Diary</a>
          <a href="update.php"><i class="fa fa-fw fa-search"></i>Account Details</a>
          </div>
          </div>
              <a href="search.php"><i class="fa fa-fw fa-search"></i>Search</a>


</div>


<form action="" method="post">
            <div class="fieldn">
                <h1 style=" text-align: center;"> Account Details</h1>
                <label for="fullName">Full Name</label>
                <input type="text" name="fullName" value="<?php echo escape($account -> data() -> fullName); ?>">
                <br>
                <br>
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo escape($account -> data() -> email); ?>">

                <label for="phone">Phone Number</label>
                <input type="number" name="phone" value="<?php echo escape($account -> data() -> phone); ?>">

        <label for="age">Age</label>
        <input type="number" name="age" value="<?php echo escape($account -> data() -> age); ?>">

        <label for="height">Height</label>
        <input type="number" step="any" name="height" value="<?php echo escape($account -> data() -> height); ?>" id="height" placeholder="Enter Height"><span style="margin-left:-90px;">meters</span>

        <label for="wight">Weight</label>
        <input type="number" step="any" name="wight" value="<?php echo escape($account -> data() -> wight); ?>" id="wight" placeholder="Enter Weight"><span style="margin-left:-50px;">kg</span>

        <label for="goals">Goals</label>
        <input type="text" name="goals" value="<?php echo escape($account -> data() -> goals); ?>" id="goals" placeholder="Enter a goal">

        <input type="submit" value="Update">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

    </div>
</form>


<form action ="" method="post">
     <div class="fields">
         <label for="current_password">Current Password</label>
         <input type="password" name="current_password" id="current_password">
     </div>

     <div class="fields">
         <label for="new_password">New Password</label>
         <input type="password" name="new_password" id="new_password">
     </div>

     <div class="fields">
         <label for="new_password_confirm">Confirm New Password</label>
         <input type="password" name="new_password_confirm" id="new_password_confirm">
     </div>

     <input type="submit" value="Change Password">
     <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>




</body>


</html>
