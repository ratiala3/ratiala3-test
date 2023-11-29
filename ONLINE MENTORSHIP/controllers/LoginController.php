<?php

class LoginController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function userLogin($email, $password)
    {
        $checkLogin = "SELECT * FROM credentials WHERE email = '$email' AND password = '$password' LIMIT 1";

        $result = $this->conn->query($checkLogin);
        if($result->numb_rows>0){
            $data = $result->fetch_assoc();
            $this->UserAuthentication($data);
            return true;
        }else{
            return false;
        }
    }

    public function userAuthentification()
    {
        $_SESSION['authentification'] = true;
        // $_SESSION['auth_role'] = $data['role_as'];
        $_SESSION['auth_user'] = [
            'user_id' => $data['id'],
            'user_name' => $data['name'],
            'user_category' => $data['category'],
            'user_email' => $data['email']

    
        ];
    }


}


?>