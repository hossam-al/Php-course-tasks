<?php

include_once '../../env/database.php';

// Select Categories
$selectCategories = "SELECT * FROM categories"; // Query
$allCategories =  mysqli_query($conn, $selectCategories); // Run Query

// Create Products
$message = null;
if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $insert = "INSERT INTO products VALUES(null,'$name',$price,$category) "; // Query
    $isDone =  mysqli_query($conn, $insert);

    header("location: /Php-course-tasks/TASK-5 CRUD/data/products/list.php");
}

// Edit
$name = null;
$price = null;
$categoryId = null;
$update = false;
if (isset($_GET['edit'])) {
    $update = true;
    $id = $_GET['edit'];
    $selectOneProduct =  "SELECT * FROM `products` where id =$id ";
    $selectOneProductItem = mysqli_query($conn, $selectOneProduct);
    $OneProduct =  mysqli_fetch_assoc($selectOneProductItem);
    $name = $OneProduct['name'];
    $price = $OneProduct['price'];
    $categoryId = $OneProduct['categoryid'];

    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $update = "UPDATE products SET name = '$name' , price = $price , categoryid = $category where id = $id  ";
        mysqli_query($conn, $update);
        header("location: /Php-course-tasks/TASK-5 CRUD/data/products/list.php");
    }
}





?>
<?php include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
?>


<h2 class="text-center text-light my-3"> CURD Opreation Using PHP </h2>

<div class="container col-md-6">
    <div class="card">

        <?php if ($message != null): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <input value="<?= $name ?>" name="name" type="text" placeholder="Product Name" class="form-control">
                </div>
                <div class="form-group">
                    <input value="<?= $price ?>" name="price" type="number" placeholder=" Product Price" class="form-control">
                </div>
                <div class="form-group">
                    <select name="category" id="" class="form-select">
                        <option disabled selected>Select Category</option>
                        <?php foreach ($allCategories as $item): ?>
                            <?php if ($item['id'] == $categoryId) : ?>
                                <option selected value="<?= $item['id'] ?>"> <?= $item['name'] ?> </option>
                            <?php else: ?>
                                <option value="<?= $item['id'] ?>"> <?= $item['name'] ?> </option>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="d-grid">
                    <?php if ($update):  ?>
                        <button name="update" class="btn mx-auto btn-warning w-50"> Update </button>
                    <?php else: ?>
                        <button name="send" class="mx-auto w-50 btn btn-info"> Add Product</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>





<?php include_once '../../shared/script.php'; ?>