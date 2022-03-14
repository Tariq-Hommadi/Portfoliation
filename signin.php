<?php
require 'header.php';

if (!(isset($_SESSION['accountID'])))
    session_start();
if (isset($_POST['email'])) {
    require 'dbh.inc.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email) || empty($password)) {
        header("Location: ../login.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM account WHERE email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $passCheck = password_verify($password, $row['password']);
                if ($passCheck == false) {
                    header("Location: ../login.php?mismatch");
                    exit();
                } else if ($passCheck == true) {
                    $_SESSION['accountID'] = $row['accountID'];
                    $_SESSION['username'] = $row['username'];
                    if (in_array(!$_SESSION['accountID'], $admin))
                        header("Location: ../account.php?sucsses");
                    header("Location:../admin.php");
                    exit();
                } else {
                    header("Location: ../login.php?mismatch");
                    exit();
                }
            } else {
                header("Location: ../login.php?error=nouser");
            }
        }
    }
} else {
    header("Location: ../login.php");
}
