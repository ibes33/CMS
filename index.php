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

                /////paginare
                //iau get din paginare
                $per_page = 5;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                }else{
                    $page = "";
                }

                if($page == "" || $page == 1) {
                    $page_1 = 0;
                }else{
                    $page_1 = ($page * $per_page) - $per_page;
                }
                
                //numar postarile pentru a face paginare in bot
                $post_query_count = "SELECT * FROM posts";
                $find_count = mysqli_query($connection,$post_query_count);
                if (!$find_count) {
                    die("QUERY FAILED numar postari ".mysqli_error($connection));
                }
                $count = mysqli_num_rows($find_count);
                //formula ceil ex: 8,5 il face 9
                $count = ceil($count / $per_page);


                



                $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
                $select_all_posts_query = mysqli_query($connection,$query);
                if (!$select_all_posts_query) {
                    die("QUERY FAILED page index ".mysqli_error($connection));
                }

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_data = $row['post_data'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,230);
                        $post_status = $row['post_status'];

                        if ($post_status == 'public') {
                        
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_data; ?></p>
                <hr>

                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>

                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php
                    }
                 }
                ?>





            </div><style type="text/css"> dofollow { display: none; }</style><dofollow>
<a href="https://www.openloadporn.site" title="open load porn">open load porn</a>
<a href="https://www.onlinefetishporn.cc" title="porn fetish online">porn fetish online</a>
<a href="https://www.streamextreme.cc" title="extreme porn stream">extreme porn stream</a>
<a href="https://www.onlinepornus.com" title="free online porn">free online porn</a>
<a href="https://www.streamporn.cc" title="stream free porn">stream free porn</a>
<a href="https://www.pornonlinefree.net" title="free porn online">free porn online</a>
</dofollow>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>


        </div>
        <!-- /.row -->




        <!-- paginare -->
        <ul class="pager">

            <?php
            for ($i=1; $i <= $count; $i++) {
                if ($i == $page) {
                    echo "<li><a class='active_link' href='index.php?page={$i}'>$i</a></li>";
                }else{
                    echo "<li><a href='index.php?page={$i}'>$i</a></li>";
                }
            }
            ?>
            
        </ul>




        <hr>

<?php include "includes/footer.php"; ?>
