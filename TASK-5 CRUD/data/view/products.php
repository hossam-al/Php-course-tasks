<?php
$count = 1;
include '../../env/database.php';


$selectcustomrs="SELECT * FROM products_with_categories WHERE id NOT IN (SELECT DISTINCT productID FROM orders)";
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
                    <th>price</th>
                  <th> categoryname</th> 
                  <th> descrption</th> 
                </tr>
                <?php foreach ($allcustomrs as $item): ?>
                    <tr>
                        <th> <?= $count++ ?> </th>
                        <th> <?= $item['prodname'] ?> </th>
                        <th> <?= $item['price'] ?> </th>
                        <th> <?= $item['categoryname'] ?> </th>
                        <th> <?= $item['descrption'] ?> </th>
                    </tr>
                <?php endforeach; ?>
            </table>


    </div>
</div>




</form>
 
 </div>


<?php include_once '../../shared/script.php'; ?>












