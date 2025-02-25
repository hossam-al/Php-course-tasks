<?php
$show = false;
$message = "";
$password="123456";
if(isset($_POST["set"])){
 
    
    if($password == $_POST["Current"]){


if($_POST["copassword"]==$_POST["newpassword"]){
$password =  $_POST["copassword"];
    $show = true;


}else{
    $message =  '<div align="center" class="alert alert-danger mt-3" >New password does not match</div>'; 
}
    }else{
        $message = '<div align="center" class="alert alert-danger mt-3" >Incorrect current password</div>';
    }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

<form method="post" >
<h3 class="text-center my-4"> Change Password Form</h3>
<div class="container w-50 mt-5"> 


<div class="form-group ">


<input placeholder="Current Password" class="form-control"  type="text" name="Current" required>

</div>
<div class="form-group">
 <input  placeholder="New Password" class="form-control" id="pas" type="password" name="newpassword" required> 
</div>
<div class="form-group">
 <input  placeholder="Confirm New Password" class="form-control" id="pas" type="password" name="copassword" required> 
</div>

<input class="btn btn-primary" type="submit" value="Click me" name="set">

</form>
<?= $message; ?>

 <?php if ($show): ?>
        <div class="container col-md-5 my-5">
        <h4 class="text-center my-4">Password changed successfully</h4>
            <div class="card">
                <div class="card-body">

                    <h6>Your password : <?= $password ?> </h6>
                    <hr>
                    
                </div>
            </div>
        </div>
    <?php endif; ?>










<script src="js/jquery-3.7.1.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>

</body>
</html>
