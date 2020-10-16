<?php

require_once 'class.db_connect.php';

class account extends db_connect
{


    public function __construct($dbo = NULL)
    {

        parent::__construct($dbo);
    }

    public function sign_up($name = '', $email = '', $password = '', $phone = '')
    {

        $currentTime = time();

        $stmt = $this->db->prepare("INSERT INTO users (id,name,email,password,phone,date) VALUES ('',(:name),(:email),(:password),(:phone),(:date))");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        $stmt->bindParam(":date", $currentTime);


        if ($stmt->execute()) return json_encode(array('error' => False, 'msg' => 'User Registered!' ,"data"=>$this->getAccountInfo($email)));
        else return json_encode(array('error' => True, 'msg' => 'There is error in registering new user!'));


    }

    public function is_email_already_reg($email)
    {

        $stmt = $this->db->prepare("SELECT id from users where email=:email");

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) return true;
        else return false;

    }

    public function is_phone_already_reg($phone)
    {

        $stmt = $this->db->prepare("SELECT id from users where phone=:phone");

        $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) return true;
        else return false;

    }

    public function loginByEmailNdPass($email = '', $password = '')
    {

        $stmt = $this->db->prepare("SELECT * from users where email=:email AND password=:password");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) return true;
        else return false;
    }

    public function loginByPhone($phone = '')
    {

        $stmt = $this->db->prepare("SELECT * from users where phone=:phone ");
        $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) return true;
        else return false;
    }

    public function getAccountInfo($email)
    {

        $result=array();

        $stmt = $this->db->prepare("SELECT * from users where email=:email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $row = $stmt->fetch();

            $result=array(
                "id"=>$row['id'],
                "name"=>$row['name'],
                "email"=>$row['email'],
                "phone"=>$row['phone']


            );

            return $result;

        }

        return $result;
    }

    public function getAccountInfoByPhone($phone)
    {

        $result=array();

        $stmt = $this->db->prepare("SELECT * from users where phone=:phone");
        $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $row = $stmt->fetch();

            $result=array(
                "id"=>$row['id'],
                "name"=>$row['name'],
                "email"=>$row['email'],
                "phone"=>$row['phone']


            );

            return $result;

        }

        return $result;
    }




}

?>