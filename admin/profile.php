<?php include "includes/admin_header.php"; ?>
<?php

//selectez utilizatorul si afisez informatiile

if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_profile_query = mysqli_query($connection,$query);
    if (!$select_user_profile_query) {
        die("QUERY FAILED select profile " . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($select_user_profile_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $randSalt = $row['randSalt'];
    }

}

//update la utilizator

if (isset($_POST['edit_profile'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    if (!empty($user_password)) {
        

    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=>12) );

    $query = "UPDATE users SET user_password='{$user_password}',user_firstname='{$user_firstname}',user_lastname='{$user_lastname}',user_email='{$user_email}' WHERE username='{$username}' ";
    $result = mysqli_query($connection,$query);
    if (!$select_user_profile_query) {
        die("QUERY FAILED update profile " . mysqli_error($connection));
    }

    $msg = "Ai updatat profilul";

    }else{
        $msg = "Completeaza parola";
    }



}else{
    $msg = "";
}

?>

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




<!-------------------------------- form profile ------------------------------------>

<form action="" method="post" enctype="multipart/form-data">    
     
     <?php echo $msg; ?>
     
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>



    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>



    <div class="form-group">
        <label for="post_status">Role</label>
        <select name="user_role">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
        <?php
        //sa apara afisat daca e selectat admin
        if ($user_role == 'admin') {
            echo "<option value='subscriber'>subscriber</option>";
        }else{
            echo "<option value='admin'>admin</option>";
        }

        ?>
            
            
            
        </select>
    </div>



<!-- 
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file"  name="image" >
    </div>
 -->
    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>

    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
    </div>

    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" class="form-control" name="user_password" >
    </div>



    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_profile" value="Update Profile">
    </div>


</form>

<!------------------------------- end form profile ------------------------------------->




                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>