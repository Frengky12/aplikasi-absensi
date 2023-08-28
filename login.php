<?php 

require 'config/session.php';

// Check session jika sudah login lempar ke dashboard kembali
if (isset($_SESSION["login"])) {
    echo "<script>
            alert('Anda sudah Login!');
            document.location.href = 'admin/index.php';
        </script>";
    exit;
}



if(isset($_POST['submit'])){

    $username = $_POST["username"];
    $password = $_POST["password"];


    $result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' AND password = '$password'" );
    

    if(mysqli_num_rows($result) === 1){

        $row = mysqli_fetch_assoc($result);
            header("Location: admin/index.php");
            $_SESSION["login"]      = true;
            $_SESSION["id"]         = $row["id"];
            $_SESSION["nama"]       = $row["nama"];
            $_SESSION["username"]   = $row["username"];
            $_SESSION["level"]   = $row["level"];

    }else{
        $error= true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/img/kominfo.png">


</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-8 col-lg-9 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="p-5">
                                    <div class="text-center">
                                        <img src="./assets/img/kominfo.png" alt="" width="35%" srcset="">
                                        <h1 class="h4 text-gray-900 mb-4 mt-4">Welcome Back!</h1>
                                    </div>

                                    <!-- pesan error -->
                        <?php if (isset($error)) : ?>
                            <div class="mb-2 alert alert-danger alert-dismissible fade show" role="alert">
                                <i>Username dan Password Salah!</i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                                    
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input name="username" type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" autocomplete="off"
                                                placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./assets/js/sb-admin-2.min.js"></script>

</body>

</html>