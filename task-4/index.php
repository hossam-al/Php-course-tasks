
<?php

$host="localhost";
$user="root";
$password="";
$dbname="shop";


try{
    $conn= mysqli_connect($host,$user,$password,$dbname);
}catch(Exception $e){
echo $e->getMessage();
}
$select="SELECT * FROM categories";
$categor=  mysqli_query($conn,$select);

$delete=false;
$message=null;
if (isset($_POST['send'])){
$name=$_POST['name'];
$price=$_POST['price'];
$category=$_POST['category'];
$insert = "INSERT INTO products VALUES(null, '$name', $price, $category)";
$isdone= mysqli_query($conn,$insert);
if($isdone){
    $message="Insert product successfuly";
}else{
    $message=null;
}
}

$selectproducts="SELECT * FROM `products_with_categories` ORDER BY id DESC";
$allproducts=  mysqli_query($conn,$selectproducts);

if(isset($_GET['view'])){
    $id=$_GET['view'];
    $selectoneproduct="SELECT * FROM `products_with_categories`WHERE id=$id";
    $selectoneproductitem = mysqli_query($conn,$selectoneproduct);
$oneproduct=    mysqli_fetch_assoc($selectoneproductitem);
}



if(isset($_GET['dlet'])){
    $id=$_GET['dlet'];
    $deleted="DELETE FROM `products` WHERE id=$id";
    $selectoneproductitem = mysqli_query($conn,$deleted);

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <title>Document</title>
</head>
<body class="bg-dark  p-5">
<h2 class="text-center text-light my-3">CRUD Opreation using php</h2>

<div class="container col-md-6">
    <div class="bg-dark" class="card">
        <?php if($message !=null):?>
    <div class="alert alert-success  alert-dismissible fade show" role="alert">
<?=$message?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif ?>
<div class="card-body">
<form method="post">

<div class="form-group">
<input name="name"  class="form-control" type="text" placeholder="produc tname">
</div>
<div class="form-group">
<input name="price" class="form-control" type="text" placeholder="price name">
</div>
<div class="form-group">
<select name="category" class="form-select" aria-label="Default select example">
  <option value="" selected>Open this select menu</option>
<?php  foreach($categor as $item):   ?>
<option value="<?= $item['id']?>"> <?=$item['name']?></option>
    <?php endforeach?>
</select>

<div class="d-grid">
<button name="send" class="my-3 w-100 btn btn-info">Add Product</button>
</div>
</form>
</div>

</div>
    </div>
</div>


<h2 class="text-center text-light my-3">List All Product</h2>
<div  class="container col-md-8">
    <div class="bg-dark" class="card">
        <div class="card-body">
            <table class="table table-dark">
            
<tr>
    <th>id</th>
    <th>name</th>
<th colspan="3">Action</th>
</tr>
<?php foreach($allproducts as $item):?>
                <tr>
                  <th><?=$item['id']?></th>  
                  <th><?=$item['prodname']?></th>  
               <th> <a href="/dashboard/hossam/index.php?view=<?= $item['id']?>"><i class="text-info fa-solid fa-eye"></i> </a> </th>
               <th> <a href=""><i class=" text-warning fa-solid fa-pen-to-square"> </i></a> </th>
               <th> <a href="/dashboard/hossam/index.php?dlet=<?= $item['id']?>"><i class="text-danger fa-solid fa-trash-can"></i> </a> </th>

          <?php endforeach;?>

                
            </table>
        </div>
    </div>
</div>
<?php if (isset($_GET['view'])):?>
<div class="mymodel">
    <div class="myConent">
        <div class="card bg-dark text-white">
            <h6>List view product number: <?=$oneproduct['id']?></h6>
            <a class="float-end" href="/dashboard/hossam/index.php">
                <i class="fa-solid fa-xmark"></i>
            </a> 
            <div class="card-body p-3">
              <h6> Name :   <?=$oneproduct['prodname']?></h6>
              <hr>
              <h6> price :   <?=$oneproduct['price']?></h6>
              <hr>
              <h6> categoryname :   <?=$oneproduct['categoryname']?></h6>
              <hr>
              <h6> descrption :   <?=$oneproduct['descrption']?></h6>
              <hr>
            </div>
        </div>
    </div>
</div>

<?php endif?>




<script src="js/jquery-3.7.1.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="./js/main.js">
    

</script>
</body>
</html>