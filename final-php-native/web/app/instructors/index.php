<?php
include_once '../../shared/allhead.php';
auth('instructors');

$count = 1;
$admins = "SELECT * FROM `instructors_data`";
$allAdmins = mysqli_query($conn, $admins);


// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // استعلام للحصول على بيانات الـ admin
    $admin = "SELECT * FROM `instructors_data` WHERE id = $id";
    $OneAdmin = mysqli_query($conn, $admin); // ✅ صححنا المتغير هنا
    $admin_Data = mysqli_fetch_assoc($OneAdmin);

    if ($admin_Data) {
        $image_name = $admin_Data['image'];
        $user_id = $admin_Data['user_id'];

        // حذف من جدول instructors
        $adminDelete = "DELETE FROM instructors WHERE id = $id";
        mysqli_query($conn, $adminDelete);

        // حذف من جدول users
        $UserDelete = "DELETE FROM users WHERE id = $user_id";
        mysqli_query($conn, $UserDelete);

        // حذف الصورة لو موجودة
        $image_path = "../../upload/users/$image_name";
        if (!empty($image_name) && file_exists($image_path)) {
            unlink($image_path);
        }

        $_SESSION['success'] = "Delete Admin successfully";
    } else {
        $_SESSION['error'] = "Admin not found.";
    }

    redirect('app/instructors/');
}




?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <?php
                    $host = $_SERVER['HTTP_HOST'];
                    $url = $_SERVER['REQUEST_URI'];
                    $full_path =  "http://" . $host . $url;

                    if (isset($_SESSION['success'])): ?>

                        <div class="alert alert-success alert-dismissible fade show">
                            <?= $_SESSION['success'] ?>

                            <form method="post" action="<?= url("env/functions.php") ?>">
                                <button name="closeSession" type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <input type="hidden" value="<?= $full_path ?>" name="fullpath">
                            </form>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">List All instructors
                            <a href="./add.php" class="btn btn-info float-end"> Add New </a>
                        </h5>


                        <table class="table table-striped table-bordered text-center align-middle">
                            <thead class="table-info">

                                <tr>
                                    <th scope="col">#NO</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">departments</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($allAdmins as $item) : ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['email'] ?></td>
                                        <td><?= $item['department_name'] ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-info px-3" href="<?= url("app/instructors/view.php?view=") . $item['id'] ?>">View</a>
                                        </td>

                                        <td> <a class="btn btn-sm btn-warning" href="<?= url("app/instructors/edit.php?edit=") . $item['id'] ?>">Edit</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-danger px-3" href="<?= url("app/instructors/index.php?delete=") . $item['id'] ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->




<?php
include_once '../../shared/allscript.php'
?>