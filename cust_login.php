<!DOCTYPE html>
<html lang="en">

<head>
    <?php session_start(); include("conn_db.php"); include('head.php');?>
    <meta charset="UTF-8">
     
    <link href="css/login.css" rel="stylesheet">

    <title>Log in | WENTWORTH CANTEEN</title>
</head>

<body class="d-flex flex-column h-100">
    <header class="navbar navbar-light fixed-top bg-light shadow-sm mb-auto">
        <div class="container-fluid mx-4">
            <a href="index.php">
                <img src="img/Color logo - no background.png" width="125" class="me-2" alt="WENTWORTH CANTEEN Logo">
            </a>
        </div>
    </header>

    <div class="container form-signin mt-auto">
        <a class="nav nav-item text-decoration-none text-muted" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back 
        </a>
        <form method="POST" action="check_login.php" class="form-floating">
            <h2 class="mt-4 mb-3 fw-normal text-bold"><i class="bi bi-door-open me-2"></i>Log In</h2>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pwd" required>
                <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-success mb-3" type="submit">Log In</button>
            <a class="nav nav-item text-decoration-none text-muted mb-2 small" href="admin/admin_login.php">
                <i class="bi bi-shop me-2"></i>Log in to admin account
            </a>
            <a class="nav nav-item text-decoration-none text-muted mb-2 small" href="cust_forgot_pwd.php">
                <i class="bi bi-key me-2"></i>Forgot your password?
            </a>
            <a class="nav nav-item text-decoration-none text-muted mb-2 small" href="cust_regist.php">
                <i class="bi bi-person-plus me-2"></i>Create your new account
            </a>
        </form>
    </div>
    <?php include('footer.php') ?>
</body>

</html>
