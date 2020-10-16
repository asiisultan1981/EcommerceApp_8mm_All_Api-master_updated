<?php

require_once 'classes/class.account.php';

if (!empty($_POST)) {


    $phone = $_POST['phone'];


    $account = new account();

    if (!$account->is_phone_already_reg($phone)) {
        echo $account->sign_up('', '', '', $phone);
    }
    else echo json_encode(array('error' => True, 'msg' => 'Phone Already Registered'));

}



?>