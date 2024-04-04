<?php
session_start();
require "../db/action.php";

if(isset($_SESSION['userStudent'])){
    header("Location: ../dashboard/student_dashboard.php");
}
if(isset($_SESSION['userEmployee'])){
    header("Location: ../dashboard/employee_dashboard.php");
}
if(isset($_SESSION['userAdmin'])){
    header("Location: ../employee.php");
}
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $data = showRecords($conn,'tbl_students',"email = '$email'");
    //checks if email is in students
    if(!count($data) > 0){
        //checks if email is in employee
        $data = showRecords($conn,'tbl_employee',"email = '$email'");
        if(count($data)>0){
            if ($data[0][5] == "Admin"){
                if(password_verify($password,$data[0][6])){
                    $_SESSION['userAdmin'] = true;
                    $_SESSION['id'] = $data[0][0];
                    header("Location: ../employee.php");
                }else{
                    echo "Incorrect Username or Password";
                }
            } 
            else if(password_verify($password,$data[0][6])){
                $_SESSION['userEmployee'] = true;
                $_SESSION['id'] = $data[0][0];
                header("Location: ../dashboard/employee_dashboard.php");
            }else{
                echo "Incorrect Username or Password";
            }
        }else{
            echo "Incorrect Username or Password";
        }
    }else if(count($data)>0){
        if(password_verify($password,$data[0][5])){
            $_SESSION['userStudent'] = true;
            $_SESSION['id'] = $data[0][0];
            header("Location: ../dashboard/student_dashboard.php");
        }else{
            echo "Incorrect Username or Password";
        }
    }else{
        echo "Incorrect Username or Password";
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/bootstrap.js"></script>
    <title>LOGIN</title>
</head>
<body class="container mt-5">
    <h1>LOGIN</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-25">LOGIN</button>
    </form>
</body>
</html>