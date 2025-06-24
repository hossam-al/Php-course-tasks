<?php
include_once './shared/allhead.php';


auth('instructors', 'student');


$user_id = $_SESSION['auth']['id'];


$select_type = "SELECT * FROM users where id = $user_id";
$select_user_type = mysqli_query($conn, $select_type);
$select_user_data = mysqli_fetch_assoc($select_user_type);

if ($select_user_data['type'] == 'admin') {
    $select_profile_data = "SELECT * FROM `admin_data` WHERE user_id =$user_id ";
} else if ($select_user_data['type'] == 'instructors') {
    $select_profile_data = "SELECT * FROM `instructors_data` WHERE user_id =$user_id ";
}elseif ($select_user_data['type'] == 'student') {
    $select_profile_data = "SELECT * FROM `students_data` WHERE user_id =$user_id ";
} 


$profile_user_data = mysqli_query($conn, $select_profile_data);
$profile_data = mysqli_fetch_assoc($profile_user_data);

if (isset($_POST['change_password'])) {
    $current_password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $renewpassword = $_POST['renewpassword'];
    // fail
    $db_password = $select_user_data['password'];

    if (password_verify($current_password, $db_password)) {

        if ($newpassword == $renewpassword) {
            $hash_newpassword = password_hash($newpassword, PASSWORD_DEFAULT);

            $update = "UPDATE users SET password = '$hash_newpassword' where id = $user_id";
            $u = mysqli_query($conn, $update);
            $_SESSION['success'] = "Change password Successfully ";
            redirect('./profile.php');
        } else {
            $_SESSION['fail'] = "Wrong Password and confirmation";
        }
    } else {
        $_SESSION['fail'] = "Wrong Current Password";
    }
}


if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $linkedin = $_POST['linkedin'];
    $phone = $_POST['phone'];
    if (!empty($_FILES['image']['name'])) {

        $image_old =  $profile_data['image'];
        if ($image_old != null) {
            unlink("./upload/users/$image_old");
        }
        $image_name =  time() . $_FILES['image']['name'];
        $temp_name =  $_FILES['image']['tmp_name'];
        $location = "./upload/users/" .   $image_name;
        move_uploaded_file($temp_name,  $location);
    } else {
        $update = "UPDATE users SET name = '$name' , email = '$email' , phone = '$phone', linkedin = '$linkedin'  where id = $user_id";
        $u = mysqli_query($conn, $update);
    }
    if (!empty($_FILES['image']['name'])) {
        $update = "UPDATE users SET name =  '$name' , email = '$email', phone = '$phone', linkedin = '$linkedin' , image = '$image_name' where id = $user_id";
        $u = mysqli_query($conn, $update);
    }

    $_SESSION['success'] = "Update Your Profile Successfully";
    $_SESSION['auth']['image'] = $image_name;
    redirect('./profile.php');
}


?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <?php if ($profile_data['image'] == null) : ?>
                            <img src="<?= url('assets/person-placeholder.jpg') ?>" alt="Profile" class="rounded-circle">
                        <?php else: ?>
                            <img src="<?= url('upload/users/') . $profile_data['image'] ?>" alt="dsfsdfd" class="rounded-circle">
                        <?php endif; ?>
                        <h2> <?= $profile_data['name']  ?> </h2>
                        <h5> <?= $profile_data['type']  ?> </h5>
                        <?php if ($select_user_data['type'] == 'admin') : ?>
                            <h3><?= $profile_data['position_name'] ?></h3>
                        <?php elseif ($select_user_data['type'] == 'instructor') : ?>
                            <h3><?= $profile_data['track'] ?></h3>
                        <?php endif; ?>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">
                <?php
                $host = $_SERVER['HTTP_HOST'];
                $url = $_SERVER['REQUEST_URI'];
                $full_path =  "http://" . $host . $url;

                if (isset($_SESSION['fail'])): ?>

                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $_SESSION['fail'] ?>

                        <form method="post" action="<?= url("env/functions.php") ?>">
                            <button name="closeSession" type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <input type="hidden" value="<?= $full_path ?>" name="fullpath">
                        </form>
                    </div>
                <?php endif; ?>
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
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item ">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active   profile-overview profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <?php if ($profile_data['image'] == null) : ?>
                                                <img src="<?= url('assets/person-placeholder.jpg') ?>" alt="Profile">
                                            <?php else: ?>
                                                <img src="<?= url('upload/users/') . $profile_data['image'] ?>" alt="dsfsdfd">
                                            <?php endif; ?>
                                            <div class="pt-2">
                                                <label for="upload_image" class="btn btn-primary btn-sm text-light" title="Upload new profile image"><i class="bi bi-upload"></i></label>
                                                <span id="upload_image_span"></span>
                                                <input type="file" accept="image/*" name="image" class="d-none" id="upload_image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName" value="<?= $profile_data['name'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email" value="<?= $profile_data['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">linkedin</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="linkedin" type="text" class="form-control" id="fullName" value="<?= $profile_data['linkedin'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="fullName" value="<?= $profile_data['phone'] ?>">
                                        </div>
                                    </div>
                             


                                    <div class="text-center">
                                        <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form method="post">
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" id="currentPassword">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->


<script>
    let upload_image_span = document.getElementById("upload_image_span");
    let upload_image = document.getElementById("upload_image");

    upload_image.addEventListener('change', function() {
        // console.log(upload_image.value);
        upload_image_span.innerHTML = upload_image.value

    });
</script>

<?php
include_once './shared/allscript.php'
?>