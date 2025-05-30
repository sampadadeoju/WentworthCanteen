<!DOCTYPE html>
<html lang="en">

<head>
    <?php session_start(); include("conn_db.php"); include('head.php');?>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login.css" rel="stylesheet">

    <title>Restricted Access | Wentworth Canteen</title> <!-- Updated title to reflect Wentworth context -->
</head>

<body class="d-flex flex-column h-100">
    <header class="navbar navbar-expand-md navbar-light fixed-top bg-light shadow-sm mb-auto">
        <div class="container-fluid mx-4">
            <a href="index.php">
                <img src="img/Color logo - no background.png" width="125" class="me-2" alt="Wentworth Canteen Logo"> <!-- Updated alt text -->
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarCollapse">
                <div class="d-flex text-end"></div>
            </div>
        </div>
    </header>
    <div class="mt-5"></div>
    <div class="container form-signin text-center restricted mt-auto">
        <i class="mt-4 bi bi-exclamation-octagon-fill text-danger h1 display-2"></i>
        <h3 class="mt-2 mb-3 fw-normal text-bold">Restricted Access</h3>
        <p class="mb-3 fw-normal text-bold text-wrap">You don't have permission to access this page.</p>
        <a class="btn btn-danger btn-sm w-50" href="index.php">Return to Home</a> <!-- Button redirects to homepage -->
    </div>

    <?php include('footer.php')?>
</body>

</html>
