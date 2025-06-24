<?php
$count = 1;

include_once '../../env/database.php';
// Read Product
$selectProducts = "SELECT * FROM `products_with_categories` order BY id DESC";
$allProducts = mysqli_query($conn, $selectProducts);



// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = " DELETE FROM products WHERE id =  $id";
    mysqli_query($conn, $delete);
    $allProducts = mysqli_query($conn, $selectProducts);
    
}



// Read One item By ID
if (isset($_GET['view'])) {
    $id =  $_GET['view'];
    $selectOneProduct =  "SELECT * FROM `products_with_categories` where id =$id ";
    $selectOneProductItem = mysqli_query($conn, $selectOneProduct);
    $OneProduct =  mysqli_fetch_assoc($selectOneProductItem);
}

?>
<?php include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
?>


<h2 class="text-center text-light my-5"> List All Product </h2>
<div class="container col-md-8">
    <div class="card">
        <div class="card-body">
            <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th colspan="3"> Action </th>
                </tr>
                <?php foreach ($allProducts as $item): ?>
                    <tr>
                        <th> <?= $count++ ?> </th>
                        <th> <?= $item['prodname'] ?> </th>
                        <th> <a href="/web/data/products/list.php?view=<?= $item['id'] ?>"> <i class="text-info fa-solid fa-eye"></i> </a> </th>
                        <th> <a href="/web/data/products/add.php?edit=<?= $item['id'] ?>"> <i class="text-warning fa-solid fa-pen-to-square"></i> </a> </th>
                        <th> <a href="/web/data/products/list.php?delete=<?= $item['id'] ?>"> <i class="text-danger fa-solid fa-trash-can"></i> </a> </th>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php if (isset($_GET['view'])): ?>
    <div class="mymodel">
        <div class="myConent">
            <div class="card p-4">
                <h6> List View Product Number : <?= $OneProduct['id']  ?>
                    <a class="float-end" href="/web/data/products/list.php"> <i class="fa-solid fa-square-xmark"></i></a>
                </h6>

                <div class="card-body p-3">
                    <h6> Name : <?= $OneProduct['prodname'] ?> </h6>
                    <hr>
                    <h6> price : <?= $OneProduct['price'] ?> </h6>
                    <hr>
                    <h6> categoryName : <?= $OneProduct['categoryname'] ?> </h6>
                    <hr>
                    <h6> description : <?= $OneProduct['descrption'] ?> </h6>
                    <hr>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php include_once '../../shared/script.php'; ?>