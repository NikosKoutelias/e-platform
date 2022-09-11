<?php  include "db.php"; ?>
<?php  include "header.php"; ?>
<?php  include "functions.php"; ?>

<?php

$token = token_generator();

token_validator($token);

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $position = trim($_POST['position']);

    $error = [
        'username'=> '',
        'email'=>'',
        'password'=>'',
        'firstname'=>'',
        'lastname'=>'',
        'position'=>'',

    ];


    if(strlen($username) < 4){

        $error['username'] = "Username needs to be longer";
    }

    if($username == ''){

        $error['username'] = "Username cannot be empty";
    }

    if(username_exists($username)){

        $error['username'] = "User Already Exists";
    }

    if($email == ''){

        $error['email'] = "Email cannot be empty";
    }

    if(email_exists($email)){

        $error['email'] = 'Email Already Exists, <a href="index.php">Please Login</a>';
    }

    if($password ==''){

        $error['password'] = 'Password cannot be empty';
    }

    if($firstname ==''){

        $error['firstname'] = 'Firstname cannot be empty';
    }

    if($lastname ==''){

        $error['lastname'] = 'Lastname cannot be empty';
    }

    if($position ==''){

        $error['position'] = 'Position cannot be empty';
    }

    foreach ($error as $key => $value){

        if(empty($value)){

            unset($error[$key]);
        }
    }

    if(empty($error)){
        
        $message = register_user($username, $email, $password, $firstname, $lastname, $position);
        login_user($username, $password);
        if($message == true){
            echo "<small>User Registered Successfully</small>";
            //redirect("login.php");
        }
    }

}

?>

<!-- Page Content -->
<body class="login">
<div class="container">
    <div class="row">    
        <div class="text-center">

            <article>
                <a href="home_page.php" class="home_link"><h1>My E-learning Platform</h1></a>
                <p class="text-center">Register</p>
            </article>
            <form role="form" action="signup.php" method="post" id="register-form" style="margin:0 auto;" class="form col-lg-6 col-md-8 mb-4" autocomplete="off">
                    <div class="form-group">
                        <label for="username" class="sr-only">username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo "Enter Your Username"; ?>"
                        autocomplete="on" value = "<?php echo isset($username) ? $username : '' ?>"
                        >
                        <small><?php echo isset($error['username']) ? $error['username'] : '' ?></small>
                    </div>
                        <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo "Enter Your Email"; ?>"
                        autocomplete="on" value = "<?php echo isset($email) ? $email : '' ?>"
                        >
                        <small><?php echo isset($error['email']) ? $error['email'] : '' ?></small>
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo "Enter Your Password"; ?>">
                        <small><?php echo isset($error['password']) ? $error['password'] : '' ?></small>
                    </div>
                    <div class="form-group">
                        <label for="Firstname" class="sr-only">firstname</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="<?php echo "Enter Your Firstname"; ?>"
                        autocomplete="on" value = "<?php echo isset($firstname) ? $firstname : '' ?>"
                        >
                        <small><?php echo isset($error['firstname']) ? $error['firstname'] : '' ?></small>
                    </div>
                    <div class="form-group">
                        <label for="Lastname" class="sr-only">lastname</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="<?php echo "Enter Your Lastname"; ?>"
                        autocomplete="on" value = "<?php echo isset($lastname) ? $lastname : '' ?>"
                        >
                        <small><?php echo isset($error['lastname']) ? $error['lastname'] : '' ?></small>
                    </div>
                    <div class="form-group">
                        <label for="Position" class="sr-only">position</label>
                        <input type="text" name="position" id="position" class="form-control" placeholder="<?php echo "Enter Your Position"; ?>"
                        autocomplete="on" value = "<?php echo isset($position) ? $position : '' ?>"
                        >
                        <small><?php echo isset($error['position']) ? $error['position'] : '' ?></small>
                    </div>
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>" />
                    <input type="submit" name="register" id="btn-register" class="btn btn-custom btn-lg btn-block" value="<?php echo "Register"; ?>">
            </form>
                
        </div>
    </div>
</div>

<?php include "footer.php" ?>