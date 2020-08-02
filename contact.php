<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>



<?php

// incercare de a trimite un mail
//the message
// $msg = "First line of text\nSecond line of text\nBine acolo booooss ai reusit sa trimit un mail!!! :))))";

// // use wordwrap() if lines are longer than 70 characters
// $msg = wordwrap($msg,70);

// // send email
// mail("sebi_msm@yahoo.com","My subject",$msg);





if (isset($_POST['submit_c'])) {

    $to = "sebi_msm@yahoo.com";
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $header = "From" . $_POST['email'];
        
    mail($to,$subject,$body,$header);
    
    echo "<h4>Email trimis cu succes</h4>";
    

}


?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">

                       
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                        </div>

                         <div class="form-group">
                            <label for="body" class="sr-only">Body</label>
                            <textarea class="form-control" name="body" id="body"cols="40" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit_c" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
