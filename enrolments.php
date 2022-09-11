<?php  include "db.php"; ?>
<?php  include "header.php"; ?>
<?php  include "functions.php"; ?>

<body>
<?php include "navigation.php";?>

<?php if(isLoggedIn()){ ?>
    <div class="container" style="margin-top:5rem ;">
       
            <div class="col-md-12">

                <!-- Blog Entries Column -->
                <div class="row">

                    <?php
                
                    $per_page = 9;

                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = "";
                    }

                    if($page == "" || $page == 1){
                        $page_1 = 0;
                    }else{
                        $page_1 = ($page * $per_page) - $per_page;

                    }
                    $user_id = $_SESSION['user_id'];

                    $post_query_count = "SELECT * FROM enrolments WHERE user_id = '$user_id'";

                    $find_count = mysqli_query($connection,$post_query_count);
                    $count = mysqli_num_rows($find_count);
                    $total_count = mysqli_num_rows($find_count);

                    if($count < 1){

                        echo "<h3 class='col-12 text-center my-4 py-4 h3_title'>You haven&#39t Enrolled in any Course </h3>";

                    }else{

                        $count = ceil($count/$per_page);

                        $query = "SELECT course_id FROM enrolments WHERE user_id = '$user_id'";

                        $select_all_course_id = mysqli_query($connection, $query);
                        
                        while($row = mysqli_fetch_assoc($select_all_course_id)) {
                            $course_ids[] = $row['course_id'];
                        }

                        $in = '(' . implode(',', $course_ids) .')';
                        $query = "SELECT * FROM courses WHERE id IN $in LIMIT $page_1, $per_page";
                        $select_all_posts_query = mysqli_query($connection, $query);
                        
                        ?> 
                        
                        <!-- Page Header -->

                        <h4 class="col-12 pb-2">Total Courses Enrolled: <small> <?php echo $total_count;?></small></h4>
                        <div class="d-flex flex-row flex-wrap ">
                            <?php
                            //pic count
                            $counter = 0;
                            while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                                $post_id = $row['id'];
                                $post_title = $row['title'];
                                $post_content = substr($row['description'],0,100);
                                $post_content .= "...";
                                //pic increment
                                $counter = $counter+1; 
                                ?>

                                <!-- First Blog Post -->
                                
                                <div class="col-md-6 col-lg-4 align-self-center">
                                    <h5 class="h5_title">
                                        <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title;?></a>
                                    </h5>
                                    <hr>
                                    <a href="post.php?p_id=<?php echo $post_id;?>">
                                    <img class="img-responsive" style=width:150px; src="https://picsum.photos/150/150?random=<?php echo $counter;?>" alt="">
                                    </a>
                                    <hr>
                                    <p class="discreption_text"><?php echo $post_content;?></p>
                                    <a class="btn-sm btn-primary" style="opacity:0.9 ;" href="post.php?p_id=<?php echo $post_id;?>">See More <span class="glyphicon glyphicon-chevron-right"></span></a>         
                                    <hr>
                                </div>

                        <?php } 
                    }?> </div>             

                </div>
            </div>
    </div>

    <div class="d-flex col-12 align-items-center justify-content-center">
        <nav class="m-4 " aria-label="Page navigation">
            <ul class="pagination">
                <?php if((int)$page !== 1 && (int)$page !== 0){ ?>
                <li class="page-item">
                    <a class="page-link" href="enrolments.php?page=<?php echo (int)$page-1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                    <?php 
                }
                    for($i=1;$i<=$count;$i++){
                        if($i == $page){
                            echo "<li class='page-item'><a class='active_link page-link' href='enrolments.php?page=$i'>$i</a></li>";   
                        }else{
                            echo "<li class='page-item'><a class='page-link' href='enrolments.php?page=$i'>$i</a></li>";
                        }
                    }
                    if((int)$page !== (int)$count){
                    ?>
                <li class="page-item">
                    <a class="page-link" href="enrolments.php?page=<?php echo (int)$page+1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

<?php 
    }else{
?>
    <div class="container" style="margin-top:5rem ;">
       
       <div class="col-md-12" style="box-shadow:  0px 22px 70px 4px rgba(0, 0, 0, 0.26);">
           <b><p style="font-size:20px;" class="discreption_text m-4 p-4" >You need to  <a style="font-weight:700; -webkit-text-fill-color:#133a78" href="login.php">login</a> to see your Enrolments</p></b>
       </div>
    </div> 
<?php 
    } 
?>



<?php include "footer.php"; ?>