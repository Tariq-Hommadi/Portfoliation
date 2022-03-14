<?php
if (!(isset($_SESSION['accountID'])))
    session_start();
if (isset($_POST['signup-submit'])) {
    require 'dbh.inc.php';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT email FROM account WHERE email=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../register.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
            header("Location: ../register.php?emailTaken=" . $username);
            exit();
        } else {
            $sql = "INSERT INTO account (username,email,password) VALUES(?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../register.php?error=sqlerror");
                exit();
            } else {
                $_SESSION['email'] = $email;
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                mysqli_stmt_execute($stmt);
                header("Location: ../login.php");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../register.php");
    exit();
}
