<?php

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection,trim($string));
}



function user_online(){
//?????????????????????? afisare cati utilizatori sunt online

    global $connection;

$session = session_id();
$time = time();
$time_out_in_seconds = 30;
$time_out = $time - $time_out_in_seconds;

//selectez sesiunea
$query = "SELECT * FROM users_online WHERE session = '{$session}'";
$result = mysqli_query($connection,$query);
if (!$result) {
    die("QUERY FAILED user_online " . mysqli_error($connection));
}
$count = mysqli_num_rows($result);

if ($count == NULL) {
    //daca nu exista sesiune o inserez
    $query = "INSERT INTO users_online(session,time) VALUES ('$session','$time')";
    $result = mysqli_query($connection,$query);
    if (!$result) {
    die("QUERY FAILED user_online insert " . mysqli_error($connection));
    }

}else{
    //daca exista sesiune fac update
    $query = "UPDATE users_online SET time = '{$time}' WHERE session = '{$session}' ";
    $result = mysqli_query($connection,$query);
    if (!$result) {
    die("QUERY FAILED user_online update1 " . mysqli_error($connection));
    }

}


$query = "SELECT * FROM users_online WHERE time > '{$time_out}'";
$result = mysqli_query($connection,$query);
if (!$result) {
die("QUERY FAILED user_online select2  " . mysqli_error($connection));
}
return $count_user = mysqli_num_rows($result);

////////////la final afisez $count_user in navigator









 /*  
     if (isset($_GET['onlineusers'])) {  
            global $connection;

            if (!$connection) {

                session_start();
                include("../includes/db.php");


                $session = session_id();
                $time = time();
                $time_out_in_seconds = 30;
                $time_out = $time - $time_out_in_seconds;

                //selectez sesiunea
                $query = "SELECT * FROM users_online WHERE session = '{$session}'";
                $result = mysqli_query($connection,$query);
                if (!$result) {
                    die("QUERY FAILED user_online " . mysqli_error($connection));
                }
                $count = mysqli_num_rows($result);

                if ($count == NULL) {
                    //daca nu exista sesiune o inserez
                    $query = "INSERT INTO users_online(session,time) VALUES ('$session','$time')";
                    $result = mysqli_query($connection,$query);
                    if (!$result) {
                    die("QUERY FAILED user_online insert " . mysqli_error($connection));
                    }

                }else{
                    //daca exista sesiune fac update
                    $query = "UPDATE users_online SET time = '{$time}' WHERE session = '{$session}' ";
                    $result = mysqli_query($connection,$query);
                    if (!$result) {
                    die("QUERY FAILED user_online update1 " . mysqli_error($connection));
                    }

                }


                $query = "SELECT * FROM users_online WHERE time > '{$time_out}'";
                $result = mysqli_query($connection,$query);
                if (!$result) {
                die("QUERY FAILED user_online select2  " . mysqli_error($connection));
                }
                echo $count_user = mysqli_num_rows($result);

                ////////////la final afisez $count_user in navigator

        }

    } //end get request isset()
*/
}
// user_online();



// FORM 
function insert_categories(){
    global $connection;
    if (isset($_POST['submit'])) 
    {
        $cat_title = $_POST['cat_title'];
        if ($cat_title == "" || empty($cat_title)) 
        {
            echo "Campul trebuie completat";
        }
        // elseif($cat_title == $cat_title)
        // {
        //     echo "Titlul ales este deja folosit! Va rugam alegeti alt titlu!";
        // }
        else
        {
            $query = "INSERT INTO categories(cat_title) VALUES ('{$cat_title}')";
            $create_category = mysqli_query($connection,$query);
            if (!$create_category)
            {
                die("ERROR ADD CATEGORY" . mysqli_error($connection)); 
            }
        }
    }

}

// TABEL
function findAllCategories(){
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection,$query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
            echo "</tr>";
        }

}
// BUTON DELETE DIN TABEL
function deleteCategories(){
    global $connection;

    if (isset($_GET['delete'])) {
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
    $delete_query = mysqli_query($connection,$query);
    if (!$delete_query) {
        die("ERROR DELETE CATEGORY" . mysqli_error($connection));
    }

    header("location: categories.php");

    }
}

?>