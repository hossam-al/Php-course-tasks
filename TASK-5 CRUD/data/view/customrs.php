<?php
$count = 1;
include '../../env/database.php';


$selectcustomrs="SELECT * FROM customers WHERE id NOT IN (SELECT  customerID FROM orders)";
$allcustomrs=mysqli_query($conn,$selectcustomrs);





?>


<?php include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
?>
 
 <div class="container">

<form action="" method="get">

<div class="card">
    <div class="card-body">

    <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>gender</th>
                    <th>phone</th>
                </tr>
                <?php foreach ($allcustomrs as $item): ?>
                    <tr>
                        <th> <?= $count++ ?> </th>
                        <th> <?= $item['name'] ?> </th>
                        <th> <?= $item['gender'] ?> </th>
                        <th> <?= $item['phone'] ?> </th>
                    </tr>
                <?php endforeach; ?>
            </table>


    </div>
</div>




</form>
 
 </div>


<?php include_once '../../shared/script.php'; ?>












