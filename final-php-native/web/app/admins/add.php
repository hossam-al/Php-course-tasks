<?php
include_once '../../shared/allhead.php';
auth();
// Fetch positions

// Fetch admins


$selectPosition = "SELECT * FROM positions";
$positions = mysqli_query($conn, $selectPosition);
// ------------------------------------
$selectAdmins = "SELECT * FROM `admin_data` ";
$admins = mysqli_query($conn, $selectAdmins);
$numberOfadmins = mysqli_num_rows($admins);

$errors = [];
if (isset($_POST['send'])) {
    // User Table
    $lin= false;
    $name = filter_validation($_POST['name']);

    $email =  filter_validation($_POST['email']);
    $phone = filter_validation($_POST['phone']);
    if (empty($phone)) {
        $errors[] = "Please Enter Valid phone";


    }


    $linkedin = filter_validation($_POST['linkedin']);
    $password = "12345678";
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $type = "admin";
    $hasImage = false;
    if (email_validation($email)) {
        $errors[] = 'Please Enter Valida Email';
    }
    if (string_validation($name)) {
        $errors[] = "Please Enter Valid Name";
    }
    if (string_validation($linkedin)) {
        $lin = true;
    }
 

    if (empty($errors)) {
        if (!empty($_FILES['image']['name'])) {
            $image_name =  time() . $_FILES['image']['name'];
            $temp_name =  $_FILES['image']['tmp_name'];
            $image_size =  $_FILES['image']['size'];
            $image_type =  $_FILES['image']['type'];
            if (file_size_validation($image_size)) {
                $errors[] = "Your Image biiger Than 2 Miga";
            }

            if (file_type_validation($image_type, 'image/png', 'image/jpeg', 'image/jpg', 'image/jif')) {
                $errors[] = "Your File is not Image";
            }
            $location = "../../upload/users/" .   $image_name;
            if (empty($errors)) {
                move_uploaded_file($temp_name,  $location);
                $hasImage = true;
            }
        }

        if ($hasImage) {
            if ($lin==true) {

                $createUser = "INSERT INTO users VALUES (null, '$name', '$email', '$phone','$hash_password', '$image_name','$linkedin', '$type')";
            } else {
                $createUser = "INSERT INTO users VALUES (null, '$name', '$email', '$phone','$hash_password', '$image_name', Default ,'$type')";
            }
        } else if ($lin==false) {
        } else {
            $createUser = "INSERT INTO users VALUES (null , '$name','$email', '$phone','$hash_password', Default ,'$linkedin', '$type')";
        }

        $InsertUser = mysqli_query($conn, $createUser);
        // Read
        $selectUser = "SELECT * FROM users WHERE email = '$email'";
        $userData = mysqli_query($conn, $selectUser);
        $userAllData = mysqli_fetch_assoc($userData);
        $user_id = $userAllData['id'];
    }






 
    $position = isset($_POST['position']) && !empty($_POST['position']) ? filter_validation($_POST['position']) : '';
    if (empty($position) || string_validation($position, 1, 3)) {
        $errors[] = "Please Enter Valid position";
    }
  

     


   

    if ($numberOfadmins > 0) {
        $lead = isset($_POST['lead']) && !empty($_POST['lead']) ? filter_validation($_POST['lead']) : '';
        if (empty($lead) || string_validation($lead, 1, 3)) {
            $errors[] = "Please Enter Valid lead";
        }
     
    } else {
        $lead = NULL;
    }
   
    if (empty($errors)) {
        if ($lead == null) {
            $createAdmin = "INSERT INTO admins VALUES (NULL ,$position ,$user_id ,NULL )";
        } else {
            $createAdmin = "INSERT INTO admins VALUES (NULL ,$position ,$user_id ,$lead )";
        }
        $insertAdmin = mysqli_query($conn, $createAdmin);

        $_SESSION['success'] = "Create Admin Successfully";

        redirect('app/admins/');
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
    </div>
    <section class="section">
        <div class="container col-lg-12">
            <div class="row">
                <div class="card">
                    <h5 class="card-titel">Add New Admin
                        <a href="./index.php" class="btn btn-info float-end">Back</a>
                    </h5>
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $err): ?>
                                    <li><?= $err ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?>
                                <form method="post" action="<?= htmlspecialchars(url("env/functions.php"), ENT_QUOTES, 'UTF-8') ?>">
                                    <button name="closeSession" type="submit" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <input type="hidden" value="<?= htmlspecialchars("http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}", ENT_QUOTES, 'UTF-8') ?>" name="fullpath">
                                </form>
                            </div>
                        <?php endif; ?>
                        <form method="post" class="row g-3" enctype="multipart/form-data">
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Admin Name</label>
                                <input type="text" name="name" class="form-control" id="inputNanme4">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" id="inputEmail4">
                            </div>
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label"> phone</label>
                                <input type="text" name="phone" class="form-control" id="inputNanme4">
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
                                <label for="" class="form-label">Positions</label>
                                <select name="position" class="form-select">
                                    <option disabled selected>Select Position</option>
                                    <?php foreach ($positions as $item): ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php if ($numberOfadmins > 0): ?>
                                <div class="col-12">
                                    <label for="" class="form-label">Lead By</label>
                                    <select name="lead" class="form-select">
                                        <option disabled selected>Select Leader</option>
                                        <?php foreach ($admins as $item): ?>
                                            <option value="<?= $item['admin_id'] ?>"><?= $item['user_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                            <div class="text-center">
                                <button type="submit" name="send" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include_once '../../shared/allscript.php'; ?>