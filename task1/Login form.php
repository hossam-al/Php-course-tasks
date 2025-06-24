
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login Form</title>
    <link rel="stylesheet" href="css/bootstrap.css">

</head>
<body>

<script> src = "js/bootstrap.js"</script>
<script> src = "js/jquery-3.7.1.js"</script>
<script> src = "js/popper.min.js"</script>
    <form method="post">

    
    <div class="container w-50 mt-5"> 


            <div class="form-group ">

            <label for="txt">Username</label>
            <input class="form-control" id="txt" type="text" name="username" required>

            </div>
           <div class="form-group">
           
           <label for="pas">Password</label>
             <input  class="form-control" id="pas" type="password" name="password" required> 
      
           </div>

            <input class="btn btn-primary" type="submit" value="Click me" name="set">
     
    </form>





</body>
</html>

<?php


 $usernam="mohamed";
 $pass="123";
if ( isset($_POST["set"])){
   
    if($usernam==$_POST["username"] and $pass==$_POST["password"]){
        echo '<div align="center" class="alert alert-success mt-3" >Welcome to the website</div>';
    } else {
        echo '<div align="center" class="alert alert-danger mt-3""> Incorrect credentials, please try again</div>';
    }

}





?>