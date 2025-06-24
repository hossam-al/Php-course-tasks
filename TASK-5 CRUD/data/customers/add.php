<?php


$masseg=false;

include_once '../../env/database.php';
 $selectcustomers="SELECT * FROM `customers` order BY id DESC";
 $allcustomers=mysqli_query($conn,$selectcustomers);


if(isset($_POST['send'])){
        $name=$_POST['name'];
        $gender=$_POST['gender'];
         $phone=$_POST['phone'];
   
$insert="INSERT INTO customers VALUES(null,'$name','$gender',$phone)";
$isdone=mysqli_query($conn,$insert);
header("location: /Php-course-tasks/TASK-5 CRUD/data/customers/list.php");
}





$name=null;
$gender=null;
$phone=null;
$updatecustomrs=false;

if (isset($_GET['cedit'])) {
    $updatecustomrs = true;
    $id = $_GET['cedit'];
    $selectOneProduct =  "SELECT * FROM `customers` where id =$id ";
    $selectOneProductItem = mysqli_query($conn, $selectOneProduct);
    $OneProduct =  mysqli_fetch_assoc($selectOneProductItem);
    $name = $OneProduct['name'];
    $genders = $OneProduct['gender'];
    $phone = $OneProduct['phone'];

    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $update = "UPDATE customers SET name = '$name' , gender =  '$gender' , phone =  $phone where id = $id  ";
        mysqli_query($conn, $update);
        header("location: /Php-course-tasks/TASK-5 CRUD/data/customers/list.php");
    }

}






?>
<?php include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
?>
<h2 class="text-center text-light my-3"> CURD Opreation Using PHP </h2>
<div class="container col-md-6">



<div class="card">
    <div class="card-body">
    <form method="post">

    <div class="form-group">
<input value="<?= $name?>" name="name" class="form-control" type="text" placeholder="customers name">
        </div>

        <div class="form-group">
<input value="<?= $phone?>"name="phone" class="form-control" type="text" placeholder="customers phone">
        </div>
        
<div class="form-group">
<select name="gender"  class="form-select">




    <?php if ($genders == "Male"): ?>
        <option value="Male" selected>Male</option>
        <option value="Female">Female</option>
    <?php elseif ($genders == "Female"): ?>
        <option value="Male">Male</option>
        <option value="Female" selected>Female</option>
    <?php else: ?>
        <?php if ($updatecustomrs):  ?>
        <option  selected><?=$genders?></option>
        <?php endif; ?>
        <option value="Male">Male</option>
        <option value="Female" selected>Female</option>
    <?php endif; ?>

                    
              
                    
</select>
</div>
<div class="d-grid">
                    <?php if ($updatecustomrs):  ?>
                        <button name="update" class="btn mx-auto btn-warning w-50"> Update </button>
                    <?php else: ?>
                        <button name="send" class="mx-auto w-50 btn btn-info"> Add customers</button>
                    <?php endif; ?>
                </div>

</div>
        </form>
    </div>
    
</div>

</div>
<?php include_once '../../shared/script.php'; ?>