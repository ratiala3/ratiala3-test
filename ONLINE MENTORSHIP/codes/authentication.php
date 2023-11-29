<?php
// include('config/app.php');

include_once('controllers/RegisterController.php');
include_once('controllers/LoginController.php');

if(isset($_POST['login'])){
    $email = validateInput($db->conn, $_POST['email']);
    $password = validateInput($db->conn, $_POST['password']);

    $auth = new loginController;
    $checkLogin = $auth->userLogin($email,$password);
    if($checkLogin){
        redirect("Logged in sucessfully", "home.php");
    }
    else
    {
        redirect("invalid credentials", "login.php");
    }
}

if(isset($_POST['submit']))
{
    $username = validateInput($db->conn,$_POST['username']);
    $email = validateInput($db->conn,$_POST['email']);
    $password = validateInput($db->conn,$_POST['password']);
    $cpassword = validateInput($db->conn,$_POST['cpassword']);
    $category = validateInput($db->conn,$_POST['category']);

    $register = new RegisterController; 
    $result_password = $register->confirmPassword($password,$cpassword);
    if($result_password)
    {
        $result_user = $register->isUserExists($email);
        if($result_user){
            redirect("Already Email Exists", "login.php");
        }else{
            $register_query = $register->registration($username, $email, $password, $category);
            if($register_query){
                redirect("Registered Successfully", "login.php");
            }else{
                redirect("Something went wrong", "signup.php");
            }
        }
         
    }
    else{
        redirect("Password Does not match","signup.php" );
    }

}


?>