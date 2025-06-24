<?php
include_once '../../shared/allhead.php';
auth();
$count = 1;
if ($_GET['view']) {
    $id  = $_GET['view'];
    $admins = "SELECT * FROM `admin_data` where admin_id = $id";
    $allAdmins = mysqli_query($conn, $admins);
    $admin = mysqli_fetch_assoc($allAdmins);
    $user_id = $admin['email'];
    // استعلام للحصول على بيانات الـ user
    $user = "SELECT * FROM `users` where email = '$user_id'";
    $allUsers = mysqli_query($conn, $user);
    $user = mysqli_fetch_assoc($allUsers);
}

?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Admin Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url('index.php') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= url('app/admins/') ?>">Admins</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Admin Details</h5>
            <a href="./add.php" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add New
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 p-3 bg-light">
                    <div class="text-center">
                        <img
                            src="<?= $admin['image'] != null ? url('upload/users/') . $admin['image'] : url('assets/person-placeholder.jpg') ?>"
                            class="rounded-circle shadow mb-3"
                            alt="Admin Image"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    <hr>

                    <div class="px-3">
                        <div class="mb-3">
                            <i class="bi bi-person-fill"></i>
                            <strong>name:</strong> <?= $admin['user_name'] ?>
                        </div>
                      <?php  if($admin['leader_name'] != null):?>
                        <div class="mb-3">
                            <i class="bi bi-person-fill-up"></i>
                            <strong>Leader:</strong> <?= $admin['leader_name'] ?>
                        </div>
                        <?php else: ?>
                            <div class="mb-3">
                                <i class="bi bi-person-fill-up"></i>
                                <strong>Leader:</strong> Super Admin
                            </div>
                        <?php endif ?>
                        <div class="mb-3">
                            <i class="bi bi-person-badge-fill"></i>
                            <strong>position:</strong> <?= $admin['position_name'] ?>
                        </div>
                        <div class="mb-3">
                            <i class="bi bi-envelope me-2 text-primary"></i>
                            <strong>Email:</strong> <?= $admin['email'] ?>
                        </div>
                        <div class="mb-3">
                            <i class="bi bi-linkedin"></i>
                            <strong>linkedin:</strong> <?= $user['linkedin'] ?>
                        </div>

                        <div class="mb-3">
                            <i class="bi bi-phone"></i>
                            <strong>Phone:</strong> <?= $user['phone'] ?>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= url('app/admins/') ?>" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>
                            <a href="<?= url("app/admins/edit.php?edit=") . $admin['admin_id'] ?>" class="btn btn-warning">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->



<?php
include_once '../../shared/allscript.php'
?>