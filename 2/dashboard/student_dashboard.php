<?php
    require '../db/action.php';
    session_start();
    if (!isset($_SESSION['userStudent'])){
        header('Location: ../forms/login.php');
    }
    $id = $_SESSION['id'];
    $data = showRecords($conn, 'tbl_students', "id = '$id'");

    if (isset($_POST['logout'])) {
        header("Location: ../forms/logout.php");
        exit();
    }
    if (isset($_POST["c_password"])) {
        header("Location: ../forms/change_password.php");
        exit();
    }
    if (isset($_POST["update"])) {
        header("Location: ../forms/update_profile.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/bootstrap.js"></script>
    <style>
        .container {
            padding-top: 50px;
        }
        .content-box {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php require 'header.php' ?>
    <div class="container mt-5">
        
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="content-box">
                    <h2 class="text-center">Welcome, Student!</h2>
                    <h4 class="text-center pt-2 pb-4">Your Information:</h4>
                    <p><strong>Name: </strong> <?php echo ($data[0][1] ." ". $data[0][2] ." ". $data[0][3]); ?></p>
                    <p><strong>Email: </strong> <?php echo ($data[0][4]); ?></p>
                    <div class="row">
                        <div class="col-6">
                            <form action="" method = "post">
                                <button type="submit" name="c_password" class="btn btn-success btn-block">Change Password</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <form action="" method = "post">
                                <button type="submit" name="update" class="btn btn-primary btn-block float-end">Update</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php' ?>
</body>
</html>