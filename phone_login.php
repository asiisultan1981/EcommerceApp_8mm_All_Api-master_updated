<?php

require_once 'classes/class.account.php';

if (!empty($_POST)) {


    $phone = $_POST['phone'];


    $account = new account();


    if ($account->loginByPhone($phone)){


        echo json_encode(array('error' => False, 'msg' => 'User Login Successfully',"data"=>$account->getAccountInfoByPhone($phone)));

    }
    else echo json_encode(array('error' => TRUE, 'msg' => 'Unable to Login'));

}


?>