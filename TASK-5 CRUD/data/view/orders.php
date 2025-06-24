<?php
$count = 1;
include '../../env/database.php';


$selectcustomrs="SELECT * FROM `odrders`";
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
                    <th>orderAmount</th>
                    <th>customer</th>
                    <th>product</th>
                </tr>
                <?php foreach ($allcustomrs as $item): ?>
                    <tr>
                        <th> <?= $count++ ?> </th>
                        <th> <?= $item['orderAmount'] ?> </th>
                        <th> <?= $item['customer'] ?> </th>
                        <th> <?= $item['product'] ?> </th>
                    </tr>
                <?php endforeach; ?>
            </table>


    </div>
</div>




</form>
 
 </div>


<?php include_once '../../shared/script.php'; ?>












