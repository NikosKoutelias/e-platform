<?php  include "db.php"; ?>
<?php  include "header.php"; ?>
<?php  include "functions.php"; ?>

<body>
<?php include "navigation.php";?>

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

            $post_query_count = "SELECT * FROM courses ";

            $find_count = mysqli_query($connection,$post_query_count);
            $count = mysqli_num_rows($find_count);
            $total_count = mysqli_num_rows($find_count);

            if($count < 1){

                echo "<h4 class='col-12 text-center'>No Post Avaiable</h4>";

            }else{

                $count = ceil($count/$per_page);

                $query = "SELECT * FROM courses LIMIT $page_1, $per_page ";

                $select_all_posts_query = mysqli_query($connection, $query);
                ?> 
                
                <!-- Page Header -->

                <h4 class="col-12 pb-2">Total Courses: <small> <?php echo $total_count;?></small></h4>
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
                <a class="page-link" href="home_page.php?page=<?php echo (int)$page-1; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
                <?php 
            }
                for($i=1;$i<=$count;$i++){
                    if($i == $page){
                        echo "<li class='page-item'><a class='active_link page-link' href='home_page.php?page=$i'>$i</a></li>";   
                    }else{
                        echo "<li class='page-item'><a class='page-link' href='home_page.php?page=$i'>$i</a></li>";
                    }
                }
            if((int)$page !== (int)$count){
                ?>
            <li class="page-item">
                <a class="page-link" href="home_page.php?page=<?php echo (int)$page == ""  ? (int)$page+2 : (int)$page+1 ; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </nav>
</div>
<?php include "footer.php"; ?>