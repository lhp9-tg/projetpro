<?php

session_start();

$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}

// either new or old, it should live at most for another hour
$_SESSION['discard_after'] = $now + 3600;

$page = 'my_retrospective';

require '../config/env.php';
require '../helpers/database.php';
require '../models/users.php';

$obj_users = new Users();

if (isset($_GET['id']))
{
    $id = $_GET['id'];
    var_dump($id);
}






include '../views/my_retrospective.php';