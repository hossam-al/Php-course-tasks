<?php
include_once '../../shared/allhead.php';
auth('instructors');

$selectinstrctors = "SELECT * FROM `instructors_data`";
$instrctors = mysqli_query($conn, $selectinstrctors);
$admin = mysqli_fetch_assoc($instrctors);

if ($_GET['edit']) {
    $id  = $_GET['edit'];
    $admins = "SELECT * FROM `instructors_data` where id = $id";
    $allAdmins = mysqli_query($conn, $admins);
    $admin = mysqli_fetch_assoc($allAdmins);
    $user_id = $admin['email'];
    // استعلام للحصول على بيانات الـ user
    $user = "SELECT * FROM `users` where email = '$user_id'";
       $allUsers = mysqli_query($conn, $user);
       $user = mysqli_fetch_assoc($allUsers);

}

$selectPosition = "SELECT * FROM departments";
$positions = mysqli_query($conn, $selectPosition);

if (isset($_POST['send'])) {
    // User Table
    $name = $_POST['name'];
    $email = $_POST['email'];
    $track = $_POST['track'];
    $linkedin = $_POST['linkedin'];
    $phone = $_POST['phone'];
    $selected = $_POST['selected'];
    if (isset($_POST['name'], $_POST['email'], $_POST['track'], $_POST['selected'], $_POST['linkedin'], $_POST['phone'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $track = $_POST['track'];
        $linkedin = $_POST['linkedin'];
        $phone = $_POST['phone'];
        $selected = $_POST['selected'];
        $selectUser = "SELECT * FROM users WHERE email = '$email'";
        $userData = mysqli_query($conn, $selectUser);
        $userAllData = mysqli_fetch_assoc($userData);
        $user_id = $userAllData['id'];
    
        $query = "UPDATE `users` SET `name`='$name',`email`='$email' , `linkedin`='$linkedin' , `phone`='$phone' WHERE id = $user_id";
        mysqli_query($conn, $query);
    
        $select = "UPDATE `instructors` SET `department_id`= $selected, `track`='$track' WHERE id = $id";
        mysqli_query($conn, $select);
    
        $_SESSION['success'] = "Update instructor Successfully";
        redirect('app/instructors/');
    } else {
        $_SESSION['error'] = "All fields are required.";
        redirect('app/instructors/edit.php?edit=' . $id);
        exit;
    }
  

}



?>


<main id="main" class="main">
    <form method="post">
        <div class="pagetitle">
            <h1>instrctor Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= url('index.php') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= url('app/instructors/') ?>">instrctor</a></li>
                    <li class="breadcrumb-item active">edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0">instrctor Details</h5>
                <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?>
                            <form method="post" action="<?= htmlspecialchars(url("env/functions.php"), ENT_QUOTES, 'UTF-8') ?>">
                                <button name="closeSession" type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <input type="hidden" value="<?= htmlspecialchars("http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}", ENT_QUOTES, 'UTF-8') ?>" name="fullpath">
                            </form>
                        </div>
                    <?php endif; ?>
                <a href="./add.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Add New
                </a>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <div class="card shadow-lg border-0 p-3 bg-light">
                        <div class="text-center">
                            <?php if ($admin['name'] == null): ?>

                                <h2>Super Admin</h2>
                            <?php endif ?>
                            <img
                                src="<?= $admin['image'] != null ? url('upload/users/') . $admin['image'] : url('assets/person-placeholder.jpg') ?>"
                                class="rounded-circle shadow mb-3"
                                alt="Admin Image"
                                style="width: 150px; height: 150px; object-fit: cover;">
               

                            <h4 class="mb-0"><?= $admin['name'] ?></h4>
                            <small class="text-muted"><?= $admin['department_name'] ?></small>
                            <div class="mt-3">


                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group mb-3">
                        <label for="name">name</label>
                        <input id="name" name="name" value="<?= $admin['name'] ?>" type="" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="Email">Email</label>
                        <input id="Email" name="email" value="<?= $admin['email'] ?>" type="email" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">phone</label>
                        <input id="phone" name="phone" value="<?=  $user['phone'] ?>" type="tel" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="track">track</label>
                        <input id="track" name="track" value="<?= $admin['track'] ?>" type="text" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="linkedin">linkedin</label>
                        <input id="linkedin" name="linkedin" value="<?=  $user['linkedin'] ?>" type="text" class="form-control" required>
                    </div>
                    <label for="sel" class="form-label">positions </label>
                    <select id="sel" name="selected" class="form-select" required>
                        <option selected disabled> <?= $admin['department_name'] ?></option>
                        <?php foreach ($positions  as $item): ?>

                            <option value="<?= $item['id'] ?>"> <?= $item['name']  ?> </option>
                        <?php endforeach; ?>
                    </select>

                    <div class="text-center mt-4">
                        <button type="submit" name="send" class="btn btn-primary">Submit</button>
                    </div>


                </div>
            </div>
            </div>
            </div>
            </div>
        </section>
    </form>
</main><!-- End #main -->



<?php
include_once '../../shared/allscript.php'
?>