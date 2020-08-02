<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Users</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>

        <?php

        //TABEL VIEW ALL COMMENT

        $query = "SELECT * FROM users";
        $result = mysqli_query($connection,$query);
        if (!$result) {
            die("QUERY FAILED tabel users la afisare " . mysqli_error($connection));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $randSalt = $row['randSalt'];

            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";



            // $query = "SELECT * FROM posts WHERE post_id = '{$comment_post_id}'";
            // $select_post_id_query = mysqli_query($connection,$query);
            // if (!$select_post_id_query) {
            //     die("QUERY FAILED" . mysqli_error($connection));
            // }

            // while ($row = mysqli_fetch_assoc($select_post_id_query)) {
            //     $post_id = $row['post_id'];
            //     $post_title = $row['post_title'];

            //     echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";

            // }


            echo "<td>$user_role</td>";
            echo "<td><a href='users.php?admin={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?subscriber={$user_id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";


        }



        //delete
        if (isset($_GET['delete'])) {

            if (isset($_SESSION['user_role'])) {
                if ($_SESSION['user_role']=='admin') {


                    $delete_id = mysqli_real_escape_string($connection,$_GET['delete']);
                    
                    $query = "DELETE FROM users WHERE user_id = '{$delete_id}'";
                    $result = mysqli_query($connection,$query);
                    if (!$result) {
                        die("QUERY FAILED delete user " . mysqli_error($connection));
                    }
                    header("location: ./users.php");



                }
            }


        }

        //admin
        if (isset($_GET['admin'])) {
            $admin_id = escape($_GET['admin']);
        
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = '{$admin_id}'";
        $admin = mysqli_query($connection,$query);
        if (!$admin) {
            die("QUERY FAILED user admin " . mysqli_error($connection));
        }
        header("location: ./users.php");
        }

        //subscriber
        if (isset($_GET['subscriber'])) {
            $subscriber_id = escape($_GET['subscriber']);
        
        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = '{$subscriber_id}'";
        $subscriber = mysqli_query($connection,$query);
        if (!$subscriber) {
            die("QUERY FAILED " . mysqli_error($connection));
        }
        header("location: ./users.php");
        }


        ?>



    </tbody>                    
</table>
