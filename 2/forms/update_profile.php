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
        $form_data=[];
        foreach($_POST as $name => $val){
            if($name!="update_employee")
                $form_data[$name] = $val;
        }
        try{
            if ($userType == 'employee') {
                $action = updateQuery($conn,$form_data,'tbl_employee',['id'=>$id]);
                header("Location: ../dashboard/employee_dashboard.php");
            } elseif ($userType == 'student') {
                $action = updateQuery($conn,$form_data,'tbl_students',['id'=>$id]);
                header("Location: ../dashboard/student_dashboard.php");
            }
            exit; // Exit to prevent further execution
        }catch(Exception $e){
            echo "Error: $e";
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../css/design_employee.css">
    <title>PHP CRUD</title>
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
        <h1>Update Employee</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="fname" class="form-control" value="<?=$data[0][1] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Middle Name</label>
                <input type="text" name="mname" class="form-control" value="<?=$data[0][2] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-control" value="<?=$data[0][3] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?=$data[0][4] ?>" required>
            </div>
            <button type="submit" name="update_employee" class="btn btn-success w-100">Submit</button>
        </form>
        <a href="../dashboard/<?= ($userType == 'employee') ? 'employee_dashboard.php' : 'student_dashboard.php' ?>"><button class="btn btn-secondary w-100">Cancel</button></a>
    </div>
</body>
</html>
