<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>


        <?php
        if(isset($_GET['edit'])){
            $cat_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
            $result = mysqli_query($connection,$query);

            while ($row = mysqli_fetch_assoc($result)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
            
        ?>

        <input value="<?php echo $cat_title; ?>" type="text" class="form-control" name="cat_title">

        <?php
            }
        }
        ?>


        <?php
        // update query

        if (isset($_POST['update'])) {

            $the_cat_title = $_POST['cat_title'];

            $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = '{$cat_id}'";
            $delete_query = mysqli_query($connection,$query);
            if (!$delete_query) {
                die("ERROR UPDATE CATEGORY" . mysqli_error($connection));
            }
        }



        ?>



        
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update Category">
    </div>    
</form>