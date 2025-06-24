<?php
require_once "../../utils/autoload.php";

try {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $session = Auth::signin($email, $password);

    if ($session['role'] == 'user')
        header('Location: ../../../index.php?page=home');
    else {
        header('Location: ../../../admin/index.php');
    }
} catch (Exception $error) {
    $_SESSION["signinError"] = $error->getMessage();

    header('Location: ../../../index.php?page=signin');
}
