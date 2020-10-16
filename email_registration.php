<?php

require_once 'classes/class.account.php';

if (!empty($_POST)) {


    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $account = new account();

    if (!$account->is_email_already_reg($email)) {
        echo $account->sign_up($name, $email, $password, '');
    }
    else echo json_encode(array('error' => True, 'msg' => 'Email Already Registered'));

}


?>