<?php
require_once "../../utils/autoload.php";

try {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    Auth::signup($username, $email, $password);

    header('Location: ../../../index.php?page=signin');
} catch (Exception $error) {
    $_SESSION["signupError"] = $error->getMessage();

    header('Location: ../../../index.php?page=signup');
}
