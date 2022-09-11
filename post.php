<?php  include "db.php"; ?>
<?php  include "header.php"; ?>
<?php  include "functions.php"; ?>

<body>
<?php include "navigation.php";?>


<?php 

    if(isset($_POST['enroll'])){

        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];

        mysqli_query($connection,"INSERT INTO enrolments(course_id, user_id) VALUES($post_id, $user_id)");
    }

    if(isset($_POST['completed'])){

        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];
        $completed = $_POST['completed'];

        mysqli_query($connection,"UPDATE enrolments SET completed = '{$completed}' WHERE user_id = '{$user_id}' AND course_id = '{$post_id}' ");
    }

?>

<div class="container" style="margin-top:5rem ;">

    <div class="col-sm-12 text-center">

        <!-- Blog Entries Column -->
        <div class="column">

            <?php

            if(isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];
                $query = "SELECT * FROM courses WHERE id = $the_post_id";
                $select_all_posts_query = mysqli_query($connection, $query);

                    if(mysqli_num_rows($select_all_posts_query) < 1) {

                        echo "<h1 class='text-center'>There is No Post Avaiable</h1>";

                    } else {

                    while($row = mysqli_fetch_assoc($select_all_posts_query)) {

                        $post_title = $row['title'];
                        $post_content = $row['description'];
                        
                        ?>

                        <!-- First Blog Post -->
                        <h2 class="post_title" style="position:relative ;"><?php echo $post_title;?></h2>
                        <i class="fas fa-play play" ></i>
                        <hr>
                        <div style="position:relative;">
                            <img class="img-fluid" style="opacity:.6;" src="https://picsum.photos/seed/picsum/700/500" alt="">
                            <?php if(isLoggedIn() && isEnrolled($the_post_id)){ ?>
                                <h4 class="h3_title mt-3">
                                    <?php echo isCompleted($the_post_id) ? 'Not Completed?' : 'Completed?';?>
                                    <?php echo isCompleted($the_post_id) ? "<i class='fas fa-toggle-on' style='-webkit-text-fill-color:#133a78; cursor:pointer;' data-toggle='completed'></i>" : "<i class='fas fa-toggle-off' data-toggle='not_completed' style='-webkit-text-fill-color:#133a78; cursor:pointer;'></i>" ?>
                                </h4>
                            <?php } else {
                                echo "<h4 class= 'my-4'></h4>";
                            } ?>
                        </div>
                        <hr class="mt-0">
                        <p class="discreption_text"><?php echo $post_content;?></p>
                        
                        <hr>
                        <?php if(isLoggedIn()){ ?>
                            <div class="row">
                                <p class="enrollment_text"><?php echo isEnrolled($the_post_id) ? "<i class='fas fa-check-circle'></i>" : "<i class='fas fa-exclamation-circle'></i>" ?>
                                <?php echo isEnrolled($the_post_id) ? 'You Own this course' : 'You don&#39t own this course -> <a style="font-size:20px; -webkit-text-fill-color:#133a78; cursor:pointer;" data-toggle="tooltip" >Enroll</a>';?></p>
                            </div>
                            <?php } 
                        else { ?>
                            <div class="row justify-content-center">
                                <b><p style="font-size:20px;" class="discreption_text " >You need to  <a style="font-weight:700; -webkit-text-fill-color:#133a78" href="login.php">login</a> to Enroll</p></b>
                            </div>

                        <?php } ?>

                        <div class="clearfix"></div>

                        <?php

                        if(isLoggedIn() && isEnrolled($the_post_id)){ ?>
                            <div class="row">
                                <p class="enrollment_text"><?php echo isCompleted($the_post_id) ? "<i class='fas fa-vote-yea'></i>" : "<i class='fas fa-window-close'></i>" ?>
                                <?php echo isCompleted($the_post_id) ? 'You Have Completed the Course' : 'You haven&#39t completed this course yet';?></p>
                            </div>
                        <?php } ?>
                        
                <?php  }
                }
            }?>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>

<script>

    $(document).ready(function(){

        $("[data-toggle='tooltip']").tooltip;
        var post_id = "<?php echo $the_post_id;?>";
        var user_id =  "<?php echo loggedInUserId();?>";
 
        // Enrolling
        $('.enrollment_text').click(function(){
  
            $.ajax({

                url:"post.php?p_id=<?php echo $the_post_id;?>",
                type: 'post',
                data: {
                    'enroll': 1,
                    'post_id': post_id,
                    'user_id': user_id
                }

            });
            location.reload(); 
        });
    });

    
    $(document).ready(function(){

        $("[data-toggle='completed']").tooltip;
        var post_id = "<?php echo $the_post_id;?>";
        var user_id =  "<?php echo loggedInUserId();?>";
 
        // Completing
        $('.fa-toggle-on').click(function(){
  
            $.ajax({

                url:"post.php?p_id=<?php echo $the_post_id;?>",
                type: 'post',
                data: {
                    'completed': 0,
                    'post_id': post_id,
                    'user_id': user_id
                }

            });
            location.reload(); 
        });
    });

    $(document).ready(function(){

        $("[data-toggle='not_completed']").tooltip;
        var post_id = "<?php echo $the_post_id;?>";
        var user_id =  "<?php echo loggedInUserId();?>";
 
        // Not Completed
        $('.fa-toggle-off').click(function(){
  
            $.ajax({

                url:"post.php?p_id=<?php echo $the_post_id;?>",
                type: 'post',
                data: {
                    'completed': 1,
                    'post_id': post_id,
                    'user_id': user_id
                }

            });
            location.reload(); 
        });
    });
    
</script>