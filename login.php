<?php include "header.php"; ?>
<?php include "db.php"; ?>
<?php include "functions.php"?>

<body class="login">    

<?php

    $token = token_generator();

    token_validator($token);

    if(ifItIsMethod('post')){

        if(isset($_POST['username']) && isset($_POST['password'])){

            login_user($_POST['username'], $_POST['password']);

        }
    }

?>

<!-- Page Content -->
<div class="container">
    <div class="container">
        <div class="row">    
            <div class="text-center">

                <article>
                    <a href="home_page.php" class="home_link"><h1>My E-learning Platform</h1></a>
                    <p class="text-center">Login</p>
                </article>

                    <form id="login-form" role="form" style="margin:0 auto;" autocomplete="off" class="form col-lg-6 col-md-8" method="post">
                
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

                                <input name="username" type="text" class="form-control" placeholder="Enter Username">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                <input name="password" type="password" class="form-control" placeholder="Enter Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>" />
                            <input name="login" class="btn btn-lg btn-primary btn-block" value="Login" type="submit">
                        </div>

                    </form>
                    <a href="" style="font-size:smaller;">Forgot Password?</a> 
                    <hr style="border-top:none;">
                    <a href="signup.php"> Sign Up</a>
                    
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>