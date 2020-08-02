<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>                
                    </div>
                </div>
                <!-- /.row -->



       
                <!-- /.row -->
                
<div class="row">

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">

            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                        ///////////////////////////afisez numarul de postari
                        $query = "SELECT * FROM posts";
                        $select_all_posts = mysqli_query($connection,$query);
                        if (!$select_all_posts) {
                            die("QUERY FAILED dash post select afis numar ".mysqli_error($connection));
                        }

                        $post_count = mysqli_num_rows($select_all_posts);

                            echo "<div class='huge'>{$post_count}</div>";

                        ?>
                        <div>Posts</div>
                    </div>
                </div>
            </div>

            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>

        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">

            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                        ///////////////////////////afisez numarul de comentarii
                        $query = "SELECT * FROM comments";
                        $select_all_comments = mysqli_query($connection,$query);
                        if (!$select_all_comments) {
                            die("QUERY FAILED dash comm select afis numar ".mysqli_error($connection));
                        }

                        $comm_count = mysqli_num_rows($select_all_comments);

                            echo "<div class='huge'>{$comm_count}</div>";

                        ?>
                        <div>Comments</div>
                    </div>
                </div>
            </div>

            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>

        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">

            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                        ///////////////////////////afisez numarul de Users
                        $query = "SELECT * FROM users";
                        $select_all_users = mysqli_query($connection,$query);
                        if (!$select_all_users) {
                            die("QUERY FAILED dash post select afis numar ".mysqli_error($connection));
                        }

                        $user_count = mysqli_num_rows($select_all_users);

                            echo "<div class='huge'>{$user_count}</div>";

                        ?>
                        <div> Users</div>
                    </div>
                </div>
            </div>

            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>

        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">

            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                        ///////////////////////////afisez numarul de categories
                        $query = "SELECT * FROM categories";
                        $select_all_categories = mysqli_query($connection,$query);
                        if (!$select_all_categories) {
                            die("QUERY FAILED dash post select afis numar ".mysqli_error($connection));
                        }

                        $cat_count = mysqli_num_rows($select_all_categories);

                            echo "<div class='huge'>{$cat_count}</div>";

                        ?>
                        <div>Categories</div>
                    </div>
                </div>
            </div>

            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>

        </div>
    </div>

</div>
                <!-- /.row -->




                <!-- LUAT DE PE GOOGLE Charts -->
                <div class="row">


                    <?php
                    //posts private
                    $query = "SELECT * FROM posts WHERE post_status = 'private'";
                    $select_all_private_posts = mysqli_query($connection,$query);
                    if (!$select_all_private_posts) {
                        die("QUERY FAILED select draft " . mysqli_error($connection));
                    }
                    $count_post_private = mysqli_num_rows($select_all_private_posts);

                    //posts public
                    $query = "SELECT * FROM posts WHERE post_status = 'public'";
                    $select_all_public_posts = mysqli_query($connection,$query);
                    if (!$select_all_public_posts) {
                        die("QUERY FAILED select draft " . mysqli_error($connection));
                    }
                    $count_post_public = mysqli_num_rows($select_all_public_posts);

                    //comments
                    $query = "SELECT * FROM comments WHERE comment_status = 'unapprove'";
                    $select_all_unapprove_comments = mysqli_query($connection,$query);
                    if (!$select_all_unapprove_comments) {
                        die("QUERY FAILED select draft " . mysqli_error($connection));
                    }
                    $count_comments_unapprove = mysqli_num_rows($select_all_unapprove_comments);


                    //users
                    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                    $select_all_subscriber = mysqli_query($connection,$query);
                    if (!$select_all_subscriber) {
                        die("QUERY FAILED select draft " . mysqli_error($connection));
                    }
                    $count_subscriber = mysqli_num_rows($select_all_subscriber);

                    ?>



                    <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],

                        <?php

                        $element_text = ['Active Post','Pulbic Post','Private Post','Comments','Comments Unnaprove','Ussers','Ussers Subscriber','Categories'];
                        $element_count = [$post_count, $count_post_public, $count_post_private, $comm_count, $count_comments_unapprove, $user_count, $count_subscriber, $cat_count];

                        for($i=0; $i < 7; $i++) { 
                            echo "['{$element_text[$i]}'" . "," . " {$element_count[$i]}],";
                        }

                        ?>

                        // ['2014', 1000],
                    ]);

                    var options = {
                        chart: {
                        title: '',
                        subtitle: '',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                    </script>

                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                    
                </div>







            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>