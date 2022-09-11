<?php

function token_generator(){
    
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    return $token = $_SESSION['token'];
}

function token_validator($token){
    if (!$token || $token !== $_SESSION['token']) {
        // return 405 http status code
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        var_dump("Action Denied");
        exit;
    }
}

function confirm($result){
    global $connection;

    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }

}

function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;
    }

    return false;
}

function query($query){

    global $connection;

    return mysqli_query($connection, $query);
}

function loggedInUserId(){
    if(isLoggedIn()){
        $result = query("SELECT * FROM users WHERE username='" . $_SESSION['username'] ."'");
        confirm($result);
        $user = mysqli_fetch_array($result);
        return mysqli_num_rows($result) >= 1 ? $user['id'] : false;
    }
    return false;
}

function isEnrolled($post_id){
    $result = query("SELECT * FROM enrolments WHERE user_id=" . loggedInUserId() . " AND course_id = {$post_id}");
    confirm($result);
    return mysqli_num_rows($result) >= 1 ? true : false; 
}

function isCompleted($post_id){
    $result = query("SELECT * FROM enrolments WHERE user_id=" . loggedInUserId() . " AND course_id = {$post_id} AND completed = 1");
    confirm($result);
    return mysqli_num_rows($result) >= 1 ? true : false; 
}

function username_exists($username){

    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    confirm($result);

    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }

}

function email_exists($email){

    global $connection;

    $query = "SELECT mail FROM users WHERE mail = '$email' ";
    $result = mysqli_query($connection, $query);
    confirm($result);

    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }

}

function escape($string){
    global $connection;

   return mysqli_real_escape_string($connection,trim($string));

}

function register_user($username, $email, $password, $firstname, $lastname, $position){
    global $connection;

        $username = escape($username);
        $email = escape($email);
        $password = escape($password);
        $firstname = escape($firstname);
        $lastname = escape($lastname);
        $position = escape($position);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

        $query = "INSERT INTO users (username, mail, password, firstname, lastname, position) ";
        $query .= "VALUES ('{$username}','{$email}','{$password}','{$firstname}','{$lastname}','{$position}')";
        $register_user_query = mysqli_query($connection,$query);

        confirm($register_user_query);
        return true;
}

function redirect($location){

    header("Location:" . $location);
    exit;
}

function isLoggedIn(){

    if(isset($_SESSION['username'])){

        return true;
    }

    return false;
}

function login_user($username, $password){

    global $connection;

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $username = escape($_POST['username']);
    $password = escape($_POST['password']);
   
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    confirm($select_user_query);
  
  
    while($row = mysqli_fetch_array($select_user_query)){
  
        $db_user_id = $row['id'];
        $db_username = $row['username'];
        $db_firstname = $row['firstname'];
        $db_lastname = $row['lastname'];

        $hash = $row['password'];   

        if(password_verify($password, $hash)) {    
            if (session_status() === PHP_SESSION_NONE) session_start();
                $_SESSION['username'] = $db_username;
                $_SESSION['user_id'] = $db_user_id;
                $_SESSION['firstname'] = $db_firstname;
                $_SESSION['lastname'] = $db_lastname;
               
                $token = $_SESSION['token'];
                redirect("home_page.php");
        } else {
        
             return false;
        }
      
    }
  return true;
  
}

?>