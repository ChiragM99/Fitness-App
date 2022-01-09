<?php
require_once 'core/init.php';

$account = new Account();
$account -> logout();
Redirect:: to('index.php');
