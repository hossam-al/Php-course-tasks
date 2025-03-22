<?php

include_once './env/database.php';



$customers_count = $conn->query("SELECT COUNT(*) AS count FROM customers")->fetch_assoc()['count'];
$orders_count = $conn->query("SELECT COUNT(*) AS count FROM orders")->fetch_assoc()['count'];
$products_count = $conn->query("SELECT COUNT(*) AS count FROM products")->fetch_assoc()['count'];
 


?>



<?php include_once './shared/head.php';
include_once './shared/navbar.php';
?>

<div class="container">

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="alert alert-primary">Total Customers: <?= $customers_count ?></div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-success">Total Orders: <?= $orders_count ?></div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-warning">Total Products: <?= $products_count ?></div>
        </div>
</div>




<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="display-1 text-center "> Welcome At Home Page </h1>
        </div>
    </div>
</div>
<?php include_once './shared/script.php'; ?>