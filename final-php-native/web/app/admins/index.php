<?php
include_once '../../shared/allhead.php';
auth();
$count = 1;
$admins = "SELECT * FROM `admin_data` order by admin_id desc";
$allAdmins = mysqli_query($conn, $admins);



if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // استعلام للحصول على بيانات الـ admin
    $admin = "SELECT * FROM `admin_data` WHERE admin_id = $id";
    $OneAdmin = mysqli_query($conn, $admin); 
    $admin_Data = mysqli_fetch_assoc($OneAdmin);

    if ($admin_Data) {
        $image_name = $admin_Data['image'];
        $user_id = $admin_Data['user_id'];

        // حذف من جدول instructors
        $adminDelete = "DELETE FROM admins WHERE id = $id";
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

    redirect('app/admins/');
}

?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Admin Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') ?>
                            <form method="post" action="<?= htmlspecialchars(url("env/functions.php"), ENT_QUOTES, 'UTF-8') ?>">
                                <button name="closeSession" type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <input type="hidden" value="<?= htmlspecialchars("http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}", ENT_QUOTES, 'UTF-8') ?>" name="fullpath">
                            </form>
                        </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title">Admin List
                            <a href="./add.php" class="btn btn-primary float-end">Add New Admin</a>
                        </h5>

                        <table class="table table-hover table-bordered text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($allAdmins as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($count++, ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($item['email'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($item['position_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="<?= htmlspecialchars(url("app/admins/view.php?view=") . $item['admin_id'], ENT_QUOTES, 'UTF-8') ?>">View</a>
                                            <a class="btn btn-sm btn-warning" href="<?= htmlspecialchars(url("app/admins/edit.php?edit=") . $item['admin_id'], ENT_QUOTES, 'UTF-8') ?>">Edit</a>
                                            <a class="btn btn-sm btn-danger" href="<?= htmlspecialchars(url("app/admins/index.php?delete=") . $item['admin_id'], ENT_QUOTES, 'UTF-8') ?>">Delete</a>
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