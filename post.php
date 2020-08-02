<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
    <!-- Navigation -->

    <?php include "includes/navigation.php"; ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">


                <?php

                //iau id-ul din index.php

                if (isset($_GET['p_id'])) {
                    $the_post_id = $_GET['p_id'];



                //numar vizitatorii pe un anumit post
                $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = '{$the_post_id}'";
                $result = mysqli_query($connection,$query);
                if (!$result) {
                    die("QUERY FAILED numar vizitatori" . mysqli_error($connection));
                }


                //afisez informatiile

                $query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}'";
                $select_all_posts_query = mysqli_query($connection,$query);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_data = $row['post_data'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_data; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
              

                <hr>

                <?php
                    }
                }else{
                    header("location: index.php");
                }
                ?>

<!------------------------------------------------------ceva cu post------------------------------------------------------------>


                <?php

                //preiau datele din form

                if (isset($_POST['create_comment'])) {

                	$the_post_id = $_GET['p_id'];

                	$comment_author = $_POST['comment_author'];
                	$comment_email = $_POST['comment_email'];
                	$comment_content = $_POST['comment_content'];


                    if (empty($comment_author) && empty($comment_email) && empty($comment_content)) {

                        echo "<script>alert('Fields cannot be empty')</script>";

                    }else{

                        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($the_post_id,'{$comment_author}','{$comment_email}','{$comment_content}','unapproved',now())";
                        $result = mysqli_query($connection,$query);
                        if(!$result){
                            die("QUERY FAILD adaugare comentariu " . mysqli_error($connection));
                        }


                        //ESTE BUN, NU STERGE!!!(o alta metoda) incrementez numarul de comentarii
                        /*
                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id='{$the_post_id}'";
                        $result = mysqli_query($connection,$query);
                        if(!$result){
                            die("QUERY FAILD la numararea comentariilor " . mysqli_error($connection));
                        }
                        */

                    }

                }

                ?>


                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">

                    	<label for="Author">Author</label>
                    	<div class="form-group">
                            <input type="text" class="form-control" name="comment_author">
                        </div>

                        <label for="Email">Email</label>
                    	<div class="form-group">
                            <input type="email" class="form-control" name="comment_email">
                        </div>

                        <label for="comment">Your Comment</label>
                        <div class="form-group">
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>

                        <button name="create_comment" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

<!-- Comment -->
                <?php

                //daca comentariul este aprobat il afisez
                $query = "SELECT * FROM comments WHERE comment_post_id='{$the_post_id}' AND comment_status='approve' ORDER BY comment_id DESC ";
                $result = mysqli_query($connection,$query);
                if (!$result) {
                    die("QUERY FAILED afisare comentariu daca e approve ".mysqli_error($connection));
                }
                while ($row = mysqli_fetch_array($result)) {
                    $comments_author = $row['comment_author'];
                    $comments_date = $row['comment_date'];
                    $comments_content = $row['comment_content'];
                ?>


                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comments_author; ?>
                            <small><?php echo $comments_date; ?></small>
                        </h4>
                        <?php echo $comments_content; ?>
                    </div>
                </div>


                <?php
                }
                ?>

 
<!--------------------------------------------------end ceva cu post------------------------------------------------------------>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>


        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>
