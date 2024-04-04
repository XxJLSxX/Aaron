<?php
    require '../db/action.php';
    session_start();
    if (!isset($_SESSION['id'])){
        header('Location: login.php');
    }
    $id = $_SESSION['id'] ?? NULL;

    if (isset($_SESSION['userEmployee'])){
        $userType = 'employee';
    } elseif (isset($_SESSION['userStudent'])){
        $userType = 'student';
    } else {
        header('Location: login.php');
    }
   
    if($id == NULL){
        header("Location: login.php");
    }

    // Redirect based on user type
    if ($userType == 'employee') {
        $data = showRecords($conn,'tbl_employee', "id=$id");
    } elseif ($userType == 'student') {
        $data = showRecords($conn,'tbl_students', "id=$id"); 
    }
        
    if(isset($_POST['update_employee'])){
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Fetch the old password from the database
        if ($userType == 'employee') {
            $old_db_password = $data[0][6]; 
        } elseif ($userType == 'student') {
            $old_db_password = $data[0][5]; 
        }
        
        
        if(password_verify($old_password, $old_db_password)){
            if($new_password === $confirm_password){
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                try{
                    if ($userType == 'employee') {
                        $action = updateQuery($conn,['password'=>$hashed_password],'tbl_employee',['id'=>$id]);
                        echo '<script>alert("Password changed successfully!");</script>';
                        header("Location: ../dashboard/employee_dashboard.php");
                    }elseif ($userType == 'student') {
                        $action = updateQuery($conn,['password'=>$hashed_password],'tbl_students',['id'=>$id]);
                        echo '<script>alert("Password changed successfully!");</script>';
                        header("Location: ../dashboard/student_dashboard.php");
                    }
                }catch(Exception $e){
                    echo "Error: $e";
                }
            } else 
                echo "Passwords do not match.";
        } else 
            echo "Wrong password.";
    }
?>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
        <script src="../bootstrap/js/bootstrap.js"></script>
        <link rel="stylesheet" href="../css/design_employee.css">
        <title>PHP CRUDE</title>
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
    <body class="container mt-5" style="background-color: #ffe7e5;">
        <div class="content-box">
            <h1>Change Password</h1>
            <form action="" method="post">
                <div class="mb-3">
                    <label class="form-label">Old Password</label>
                    <input type="password" name="old_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control"  required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>
                <button type="submit" name="update_employee" class="btn btn-success w-100">Submit</button>
            </form>
            <a href="../dashboard/employee_dashboard.php"><button class="btn btn-secondary w-100">Cancel</button></a>
        </div>
    </body>
    </html>
