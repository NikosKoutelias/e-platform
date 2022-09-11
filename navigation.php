<nav class="navbar navbar-dark navbar-expand-md bg-dark nav_style" role="navigation">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="home_page.php">E-learning Platform</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav align-items-center justify-content-center">    
        
    <?php 
    $uriSegments = explode("/", $_SERVER['PHP_SELF']);
    ?>
    <li><a class="li_element <?php echo $uriSegments[2]=='home_page.php' ? 'active_tab' : '' ;?>" href='home_page.php'>Courses</a></li>
    <li><a class='li_element <?php echo $uriSegments[2]=='seafarers.php' ? 'active_tab' : '' ;?>' href='seafarers.php'>Seafarers</a></li>
    <li><a class='li_element <?php echo $uriSegments[2]=='enrolments.php' ? 'active_tab' : '' ;?>' href='enrolments.php'>Enrolments</a></li>
    <li><a class='li_element <?php echo $uriSegments[2]=='completions.php' ? 'active_tab' : '' ;?>' href='completions.php'>Completions</a></li>

    <li style='color: grey; text-align: center; padding: 16px;'><b>|</b></li>

    <?php  
        if(isLoggedIn()){

        echo "<li><a href='logout.php'>Logout</a></li>";
    ?>
        <h5 class="li_element ml-4 mr-0"> Welcome Back <?php echo $_SESSION['username'];?></h5>
    <?php
    } else{
        ?>
        
        <li><a class="li_element" href="signup.php">SignUp</a></li>
        <li><a class="li_element" href="login.php">Login</a></li>  

    <?php } ?>
    </ul>
</nav>