<?php
include_once '../../shared/allhead.php';
auth('student');


$selectPosition = "SELECT * FROM `groups`";
$positions = mysqli_query($conn, $selectPosition);



if (isset($_POST['send'])) {

    if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['linkedin'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $linkedin = $_POST['linkedin'];
    } else {
        $_SESSION['error'] = "All fields are required.";
        redirect('app/students/add.php');
        exit;
    }
    $password = "12345678";
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $hasImage = !empty($_FILES['image']['name']);
    if ($hasImage) {
        $image_name = time() . $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];
        $location = "../../upload/users/" . $image_name;
        move_uploaded_file($temp_name, $location);
        $createUser = "INSERT INTO users VALUES (null, '$name', '$email', '$phone','$hash_password', '$image_name','$linkedin', 'student')";
    } else {
        $createUser = "INSERT INTO users VALUES (null, '$name', '$email', '$phone', '$hash_password',Default,'$linkedin', 'student')";
    }
    
    try {
    $InsertUser = mysqli_query($conn, $createUser);
    $selectUser = "SELECT * FROM users WHERE email = '$email'";
    $userData = mysqli_query($conn, $selectUser);
    $userAllData = mysqli_fetch_assoc($userData);
    $user_id = $userAllData['id'];
  
        $position = $_POST['position'];

    // Insert into students table
  

    $createAdmin = "INSERT INTO `students`( `group_id`, `user_id`) VALUES ($position,$user_id)";
    $insertAdmin = mysqli_query($conn, $createAdmin);

    $_SESSION['success'] = "Create Student Successfully";

    redirect('app/students/');
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        redirect('app/students/add.php');
        exit();
    }
   
}

?>



<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Layouts</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="container  col-lg-12">
            <div class="row">
                <div class="card">
                    <h5 class="card-titel">Add New student
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?>
                            <form method="post" action="<?= htmlspecialchars(url("env/functions.php"), ENT_QUOTES, 'UTF-8') ?>">
                                <button name="closeSession" type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <input type="hidden" value="<?= htmlspecialchars("http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}", ENT_QUOTES, 'UTF-8') ?>" name="fullpath">
                            </form>
                        </div>
                    <?php endif; ?>
                        <a href="./index.php" class="btn btn-info float-end"> Back </a>
                    </h5>

                    <div class="card-body">

                        <!-- Vertical Form -->
                        <form method="post" class="row g-3" enctype="multipart/form-data">
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label"> Name</label>
                                <input type="text" name="name" class="form-control" id="inputNanme4">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="inputEmail4">
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label"> phone</label>
                                    <input type="tel" name="phone" class="form-control" id="inputNanme4">
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">linkedin:</label>
                                    <input type="text" name="linkedin" class="form-control" id="inputNanme4">
                                </div>
                                <div class="col-12">
                                    <label for="imge" class="form-label">Profile Image</label>
                                    <input type="file" accept="images/*" name="image" class="form-control" id="imge">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label"> groups </label>
                                    <select name="position" class="form-select">
                                        <option disabled selected> Select groups </option>
                                        <?php foreach ($positions  as $item): ?>
                                            <option value="<?= $item['id'] ?>"> <?= $item['title']  ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="send" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>


            </div>
        </div>
    </section>

</main><!-- End #main -->



<?php
include_once '../../shared/allscript.php'
?>