<?php
//verific daca am apasat pe butoane check
if (isset($_POST['checkBoxArray'])) {
    
    //daca apas mai multe butoane check le pun intr-un array
    //$_POST['checkBoxArray'] si
    //$postIdBox este ID-ul luat din value la checkbox
    foreach ($_POST['checkBoxArray'] as $postIdBox) {

        //status luat din form select
        $bulk_options_status = $_POST['bulk_options_status'];

        switch ($bulk_options_status) {
            case 'public':
                    $query = "UPDATE posts SET post_status='{$bulk_options_status}' WHERE post_id='{$postIdBox}'";
                    $result = mysqli_query($connection,$query);
                    if (!$result) {
                        die("QUERY FAILED public checkbox " . mysqli_error($connection));
                    }
                break;

            case 'private':
                    $query = "UPDATE posts SET post_status='{$bulk_options_status}' WHERE post_id='{$postIdBox}'";
                    $result = mysqli_query($connection,$query);
                    if (!$result) {
                        die("QUERY FAILED private checkbox " . mysqli_error($connection));
                    }
                break;

            case 'delete':
                    $query = "DELETE FROM posts WHERE post_id='{$postIdBox}'";
                    $result = mysqli_query($connection,$query);
                    if (!$result) {
                        die("QUERY FAILED delete checkbox " . mysqli_error($connection));
                    }
                break;


            case 'clone':

                    //selectez postul pt clonat
                    $query = "SELECT * FROM posts WHERE post_id='{$postIdBox}'";
                    $result = mysqli_query($connection,$query);
                    if (!$result) {
                        die("QUERY FAILED clone select " . mysqli_error($connection));
                    }
                    while ($row = mysqli_fetch_assoc($result)) {
                        $post_id = $row['post_id'];
                        $post_category_id = $row['post_category_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_data = $row['post_data'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_tags = $row['post_tags'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_status = $row['post_status'];
                    }

                    //clonez postul
                    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_data,post_image,post_content,post_tags,post_status) VALUES ('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
                    $result = mysqli_query($connection,$query);
                    if (!$result) {
                        die("QUERY FAILED clone update " . mysqli_error($connection));
                    }

                break;


            case 'reset':
                    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = '{$postIdBox}'";
                    $result = mysqli_query($connection,$query);
                    if (!$result) {
                        die("Error query reset views " . mysqli_error($connection));
                    }
                   // header("location: ./posts.php");
                break;



            
            default:
                # code...
                break;
        }

        


    }

    



}

?>


<form action="" method="post">

    <table class="table table-bordered table-hover">



        <div style="padding-left: 0px;" id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options_status" id="">
                <option value="">Select Option</option>
                <option value="public">Public</option>
                <option value="private">Private</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
                <option value="reset">Reset Views</option>
            </select>
        </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>




        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>Id</th>
                
                <!-- inainte era Author -->
                <th>User</th>

                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Data</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Visit</th>
            </tr>
        </thead>
        <tbody>

            <?php

            //TABEL VIEW ALL POSTS

            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $select_posts = mysqli_query($connection,$query);
            if (!$select_posts) {
                die("Eroare query select post " . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id = $row['post_id'];
                $post_category_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_data = $row['post_data'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_status = $row['post_status'];
                $post_views_count = $row['post_views_count'];

                echo "<tr>";
                ?>

                <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>

                <?php
                echo "<td>$post_id</td>";


//////////////////////////////////////////////////////////

                if (isset($post_author) || !empty($post_author)) {
                     echo "<td>$post_author</td>";
                }elseif(isset($post_user) || !empty($post_user)){
                    echo "<td>$post_user</td>";
                }
                
//////////////////////////////////////////////////////////         



                echo "<td>$post_title</td>";


                //afisez ceva titlul din category...

                 $query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}'";
                 $result = mysqli_query($connection,$query);
                 if (!$result) {
                     die("QUERY FAIL".mysqli_error($connection));
                 }
                 while ($row = mysqli_fetch_assoc($result)) {
                     $cat_title = $row['cat_title'];
                     echo "<td>$cat_title</td>";
                 }


                echo "<td>$post_status</td>";
                echo "<td><img style='width:100px;' src='../images/$post_image'></td>";
                echo "<td>$post_tags</td>";

                //afisez numarul de comentarii
                $query = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}'";
                $result = mysqli_query($connection,$query);
                if (!$result) {
                    die("QUERY FAILED afis numar comm " . mysqli_error($connection));
                }
                $count_comm = mysqli_num_rows($result);
                while ($row = mysqli_fetch_assoc($result)) {
                    $comment_id = $row['comment_id'];
                }

                echo "<td><a href='post_comments.php?id=$post_id'>$count_comm</a></td>";
                


                echo "<td>$post_data</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a onClick=\" javascript: return confirm('Are you sure you want tot delete?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
                echo "</tr>";
            }

            ?>

        </tbody>                    
    </table>

</form>
<?php
//delete
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id='{$delete_id}'";
    $delet = mysqli_query($connection,$query);
    if (!$delet) {
        die("Error query delete " . mysqli_error($connection));
    }
    header("location: ./posts.php");
}

//reset views
if (isset($_GET['reset'])) {
    $the_post_id = $_GET['reset'];

    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = '{$the_post_id}'";
    $result = mysqli_query($connection,$query);
    if (!$result) {
        die("Error query reset views " . mysqli_error($connection));
    }
    header("location: ./posts.php");
}


?>