<?php
session_start();

// Jika sudah login sebagai admin, redirect ke dashboard
if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit();
}

// Jika sudah login sebagai user dengan level 1, redirect ke ecommerce
if (isset($_SESSION['level']) && $_SESSION['level'] == 1) {
    header("Location: ecommerce_web/muka.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Administrator</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/all.min.css">
    <style>
        .col-centered {
            float: none;
            margin: 50px auto;
        }
        .login-container {
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            border-radius: 10px;
            background: white;
        }
        body {
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 col-centered login-container">
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'invalid') {
                        echo '<div class="alert alert-danger">Email atau password salah.</div>';
                    } elseif ($_GET['error'] == 'level') {
                        echo '<div class="alert alert-warning">Level user tidak dikenal.</div>';
                    } else {
                        echo '<div class="alert alert-danger">Login gagal. Silakan coba lagi.</div>';
                    }
                }
                ?>
                <form action="proses-login.php" method="post">
                    <h3 class="text-center mb-4">Login Admin</h3>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="login" class="btn btn-primary">
                            <i class="fa fa-user-lock"></i> Login
                        </button>
                        <button type="reset" class="btn btn-warning">
                            <i class="fa fa-rotate-left"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.4.1.slim.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
