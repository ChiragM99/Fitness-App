<?php
require_once 'core/init.php';

if(!$username = Input::get('account')) {
    Redirect::to('index.php');
} else {
    $account = new Account($username);
    if(!$account-> exists()) {
        Redirect::to(404);
    } else {
        $data = $account -> data();
    }
    ?>

    <h2>Welcome <?php echo escape($data -> userName); ?></h2>

  <?php
}
