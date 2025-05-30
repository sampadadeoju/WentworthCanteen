<!DOCTYPE html>
<html lang="en">

<head>
    <?php session_start(); include("conn_db.php"); include('head.php');?>
    <meta charset="UTF-8">
     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login.css" rel="stylesheet">

    <title>Failed to Register | Wentworth Canteen</title>
</head>

<body class="d-flex flex-column h-100">
    <header class="navbar navbar-light fixed-top bg-light shadow-sm mb-auto">
        <div class="container-fluid mx-4">
            <a href="index.php">
                <img src="img/Color logo - no background.png" width="125" class="me-2" alt="Wentworth Canteen Logo">
            </a>
        </div>
    </header>
    <div class="mt-5"></div>
    <div class="container form-signin text-center reg-fail mt-auto">
            <i class="mt-4 bi bi-exclamation-circle text-danger h1 display-2"></i>
            <h3 class="mt-2 mb-3 fw-normal text-bold">Unable to Register</h3>
            <p class="mb-3 fw-normal text-bold">Sorry, we encountered an error during registration.<br/>
                <code>
                    <?php
                        $error_code = $_GET["err"];
                        if ($error_code == 1062){
                            echo "An account with the same username or email already exists.";
                        }else{
                            echo "Error Code: {$error_code}";
                        }
                    ?>
                </code>
            </p>
            <a class="btn btn-danger btn-sm w-50" href="index.php">Return to Home</a>
    </div>
    <?php include('footer.php')?>
</body>

</html>
