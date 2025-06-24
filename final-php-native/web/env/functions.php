<?php

session_start();
include_once 'C:\xampp\htdocs\web/env/db.php';
define("Base_url", "http://localhost/web/");


function url($var = null)
{
    return Base_url . $var;
}


function redirect($var = null)
{
    echo "<script>
    window.location.replace('http://localhost/web/$var')
</script>";
}




if (isset($_POST['closeSession'])) {
    unset($_SESSION['success']);
    unset($_SESSION['error']);

    $fullPath =    $_POST['fullpath'];
    echo "<script>
    window.location.replace('$fullPath')
</script>";
}

function guest()
{
    if (!isset($_SESSION['auth'])) {
    } else {
        redirect('index.php');
    }
}
function filter_validation($input)
{
    $input = rtrim($input);
    $input = ltrim($input);
    $input = strip_tags($input);
    $input = htmlspecialchars($input);
    $input = stripslashes($input);

    return $input;
}

function string_validation($input, $min =  3, $max = 20)
{

    $isEmpty = empty($input);
    $minSizeError = strlen($input) < $min;
    $maxSizeError = strlen($input) > $max;

    if ($isEmpty || $minSizeError || $maxSizeError) {
        return true;
    } else {
        return false;
    }
}



function email_validation($input)
{
    $isEmpty = empty($input);
    $isNotEmail = !filter_var($input, FILTER_VALIDATE_EMAIL);
    if ($isEmpty || $isNotEmail) {
        return true;
    } else {
        return false;
    }
}

function phone_number_validation($input)
{
    if (empty($input)) {
        return false;
    }

    $filtered = preg_replace('/[^0-9+]/', '', $input);

    // فحص الرقم
    if (preg_match('/^\+?\d{10,15}$/', $filtered)) {
        return $filtered;
    } else {
        return false;
    }
}





function url_validation($input)
{
    $isEmpty = empty($input);
    $isNotUrl = !filter_var($input, FILTER_VALIDATE_URL);
    if ($isEmpty || $isNotUrl) {
        return true;
    } else {
        return false;
    }
}
// ----------------------  

function file_size_validation($file_size, $size_with_miga = 2)
{
    $file_size = ($file_size / 1024) / 1024;
    $size_error = $file_size > $size_with_miga;

    if ($size_error) {
        return true;
    } else {
        return false;
    }
}


function file_type_validation($file_type, $type0 = null, $type1 = null, $type2 = null, $type3 = null, $type4 = null)
{

    $is_file_type_Error = $file_type == $type0 ||
        $file_type == $type1 ||
        $file_type == $type2 ||
        $file_type == $type3 ||
        $file_type == $type4;
    if ($is_file_type_Error) {
        return false;
    } else {
        return true;
    }
}

function auth($type1 = null, $type2 = null)
{
    if (isset($_SESSION['auth'])) {

        if (
            $_SESSION['auth']['type'] == 'admin' ||
            $_SESSION['auth']['type'] == $type1 ||
            $_SESSION['auth']['type'] ==  $type2
        ) {
        } else {
            redirect('error404.php');
        }
    } else {
        redirect('login.php');
    }
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    redirect('login.php');
}


if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    redirect('login.php');
}
