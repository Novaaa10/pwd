<?php


session_start();

require_once __DIR__.'/../model/Auth.php';

$auth = new Auth();

// Ambil data dari form POST
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

try {
    $user = $auth->login($email, $password);
    
    if ($user) {
        // Set session sesuai level
        if ($user['level'] == 0) {
            $_SESSION['admin'] = [
                'id' => $user['id_pengguna'],
                'email' => $user['email']
            ];
            header("Location: dashboard.php");
        } else {
            $_SESSION['user'] = [
                'id' => $user['id_pengguna'],
                'email' => $user['email'],
                'level' => $user['level']
            ];
            header("Location: ../ecommerce_web/muka.php");
        }
        exit();
    }
    
    header("Location: login.php?error=invalid");
    exit();
    
} catch (Exception $e) {
    error_log("Login error: ".$e->getMessage());
    header("Location: login.php?error=system");
    exit();
}

header("Location: ../index.php");
exit();