<?php


$masseg=false;

include_once '../../env/database.php';
 $selectcustomers="SELECT * FROM `odrders` order BY id DESC";
 $allcustomers=mysqli_query($conn,$selectcustomers);



if(isset($_POST['send'])){
        $orderAmount=$_POST['order'];
        $customerName=$_POST['customer'];
         $productName=$_POST['product'];
   
$insert="INSERT INTO orders VALUES(null,$orderAmount,'$customerName','$productName')";
$isdone=mysqli_query($conn,$insert);
header("location: /Php-course-tasks/TASK-5 CRUD/data/order/list.php");
}
 



$orderAmount=null;
$customer=null;
$product=null;
$update=false;

if (isset($_GET['oedit'])) {
    $update = true;
    $id = $_GET['oedit'];
    $selectOneProduct =  "SELECT * FROM `odrders` where id =$id ";
    $selectOneProductItem = mysqli_query($conn, $selectOneProduct);
    $OneProduct =  mysqli_fetch_assoc($selectOneProductItem);
    $orderAmount = $OneProduct['orderAmount'];
    $customer = $OneProduct['customer'];
    $product = $OneProduct['product'];
    $categoryId=$OneProduct['id'];



    if (isset($_POST['update'])) {
        $orderAmount = $_POST['order'];
        $customer = $_POST['customer'];
        $product = $_POST['product'];
        $update = "UPDATE `orders` SET customerid ='$customer', productid ='$product', orderAmount = $orderAmount WHERE id =$id";
        mysqli_query($conn, $update);
        header("location: /Php-course-tasks/TASK-5 CRUD/data/order/list.php");
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
<input value="<?= $orderAmount?>" name="order" class="form-control" type="text" placeholder="orderAmount">
        </div>


        
        <div class="form-group">
                    <select name="customer" id="" class="form-select">
                        <option disabled selected>Select customer</option>
                        <?php foreach ( $allcustomers as $item): ?>
                            <?php if ($item['id'] == $categoryId) : ?>
                                <option selected value="<?= $item['id'] ?>"> <?= $item['customer'] ?> </option>
                            <?php else: ?>
                                <option value="<?= $item['id'] ?>"> <?= $item['customer'] ?> </option>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="product" id="" class="form-select">
                        <option disabled selected>Select product</option>
                        <?php foreach ($allcustomers as $item): ?>
                            <?php if ($item['id'] == $categoryId) : ?>
                                <option selected value="<?= $item['id'] ?>"> <?= $item['product'] ?> </option>
                            <?php else: ?>
                                <option value="<?= $item['id'] ?>"> <?= $item['product'] ?> </option>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
               

<div class="d-grid">
                    <?php if ($update):  ?>
                        <button name="update" class="btn mx-auto btn-warning w-50"> Update </button>
                    <?php else: ?>
                        <button name="send" class="mx-auto w-50 btn btn-info"> Add Orders</button>
                    <?php endif; ?>
                </div>

</div>
        </form>
    </div>
    
</div>

</div>
<?php include_once '../../shared/script.php'; ?>