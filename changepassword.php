<?php
require_once 'core/init.php';

$account = new Account();

if(!$account -> isLoggedIn()) {
    Redirect::to('index.php');
}

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validation();
        $validation = $validate -> check($_POST, array(
            'current_password' => array(
                'required' => TRUE,
                'min' => 5
                'disp_text' => ' Current Password',
            ),
            'new_password' => array(
                'required' => TRUE,
                'min' => 5
                'disp_text' => 'New Password',
            ),
            'confirm-new_password' => array(
                'required' => TRUE,
                'min' => 5,
                'matches' => 'new_password'
                'disp_text' => ' New Password Confirmation',
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

      <input type="submit" value="Change">
      <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
 </form>
