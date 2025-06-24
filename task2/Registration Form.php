<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج تسجيل</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

<div class="container col-md-6">
    <h2 class="text-center mb-4">Registration Form </h2>
    
    <form method="post">
        <div class="form-group">
            <label for="username"> Username</label>
            <input type="text" id="username" name="username" class="form-control" required minlength="3" maxlength="15">
        </div>

        <div class="form-group mt-3">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div  class="form-group mt-3">
            <label for="password">password</label>
            <input type="password" id="password" name="password" class="form-control" required minlength="6">
        </div>
        <div class="d-grid">
                <button name="print" class=" btn btn-info mt-4 "> Registr</button>
            </div>
    </form>
</div>

<script src="js/jquery-3.7.1.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
<?php
if( isset($_POST["print"])){
    echo '<div align="center"  class="alert alert-success mt-3" >Registration successful</div>';

}

?>