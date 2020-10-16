<?php

require_once 'classes/class.account.php';

if (!empty($_POST)) {


    $email = $_POST['email'];
    $password = $_POST['password'];


    $account = new account();


    if ($account->loginByEmailNdPass($email,$password)){

        echo json_encode(array('error' => False, 'msg' => 'User Login Successfully',"data"=>$account->getAccountInfo($email)));

    }
    else echo json_encode(array('error' => TRUE, 'msg' => 'Unable to Login'));

}


?>