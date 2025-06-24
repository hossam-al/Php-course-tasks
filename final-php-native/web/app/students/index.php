<?php
include_once '../../shared/allhead.php';
auth('student');
$count = 1;
$admins = "SELECT * FROM `students_data`";
$allAdmins = mysqli_query($conn, $admins);


// Delete
if ($_GET['delete']) {
    $id =  $_GET['delete'];

    $admin = "SELECT * FROM `students_data` where student_id = $id";
    $OneAdmin = mysqli_query($conn, $admin);
    $admin_Data = mysqli_fetch_assoc($OneAdmin);
    $image_name =  $admin_Data['image'];
    $user_id =  $admin_Data['user_id'];
    unlink("../../upload/users/$image_name");

    $adminDelete = "DELETE FROM students where id =$id ";
    mysqli_query($conn, $adminDelete);
    $UserDelete = "DELETE FROM users where id =$user_id ";
    mysqli_query($conn, $UserDelete);
    $_SESSION['success'] = "Delete Admin successfully";
    redirect('app/students/');    
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
                        <h5 class="card-title">List All students
                            <a href="./add.php" class="btn btn-info float-end"> Add New </a>
                        </h5>

                
<table class="table table-striped table-bordered text-center align-middle">
    <thead class="table-info">
      
        <tr>
            <th scope="col">#NO</th>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col">group_name</th>
            <th scope="col">round_name</th>
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
                <td><?= $item['group_name'] ?></td>
                <td><?= $item['rounds_name'] ?></td>
                <td><?= $item['department_name'] ?></td>
                <td>
                    <a class="btn btn-sm btn-info px-3" href="<?= url("app/students/view.php?view=") . $item['student_id'] ?>">View</a>
                </td>
                <td>
                    <a class="btn btn-sm btn-warning px-3" href="<?= url("app/students/edit.php?edit=") . $item['student_id'] ?>">Edit</a>
                </td>
                <td>
                    <a class="btn btn-sm btn-danger px-3" href="<?= url("app/students/index.php?delete=") . $item['student_id'] ?>">Delete</a>
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