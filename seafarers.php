<?php  include "db.php"; ?>
<?php  include "header.php"; ?>
<?php  include "functions.php"; ?>

<body>
<?php include "navigation.php";?>

<div class="container" style="margin-top:5rem ;">
       
    <div class="col-md-12">

        <table class="table table-bordered table-hover seafarers_table table-responsive-md" style="box-shadow:10px 10px 250px 1px rgba(0,0,0,.6);">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Position</th>
                    <!-- <th>Date</th> -->
                    
                    
                </tr>
            </thead>
            <tbody style="background-color:rgba(230, 230, 230, 0.2);">
            <?php 
                $query = "SELECT * FROM users";
                $select_users = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_users)) {
                    $user_id = $row['id'];
                    $username = $row['username'];
                    $user_password = $row['password'];
                    $user_firstname = $row['firstname'];
                    $user_lastname= $row['lastname'];
                    $user_email = $row['mail'];
                    $user_position = $row['position'];
                    
                    echo "<tr>";
                        echo "<td>$user_id</td>";
                        echo "<td>$username</td>";
                        echo "<td>$user_firstname</td>";
                        echo "<td>$user_lastname</td>";
                        echo "<td>$user_email</td>";
                        echo "<td>$user_position</td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>


<?php include "footer.php"; ?>