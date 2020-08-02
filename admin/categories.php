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


                        <!-- ADAUG DATE IN PRIMUL FORMULAR STANGA SUS ADMIN -->
                        <?php insert_categories(); ?>


                        <!--------------- ADD CATEGORY  ---------------->
                        <div class="col-xs-6">

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>    
                            </form>

                        <?php // UPDATE
                            if (isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];
                                include "includes/update_categories.php";
                            }
                        ?>

                        </div>
                        <!--------------- END ADD CATEGORY  ---------------->



                        <div class="col-xs-6">


                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- TABEL DREAPTA BAZE DATE -->
                                    <?php findAllCategories(); ?>

                                    <!-- STERGE CATEGORIE DIN TABEL -->
                                    <?php deleteCategories(); ?>
<!-- 
                                    <tr>
                                        <td>Baseball Category</td>
                                        <td>Basketeball Category</td>
                                    </tr>
 -->
                                </tbody>                    
                            </table>
                            </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>