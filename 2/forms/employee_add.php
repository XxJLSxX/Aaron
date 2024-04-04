<?php 
    require '../db/action.php';

    if(isset($_POST['add_employee'])){
            $data = [];
            foreach($_POST as $name => $val){
                if($name!="add_employee")
                    $data[$name] = ($name=="password") ? password_hash($val,PASSWORD_BCRYPT): $val;
            }
        try{
            $action = addQuery($conn,$data,'tbl_employee');
            header("Location: ../employee.php");
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
    <title>Add Employee</title>
</head>
<body class="container mt-5" style="background-color: #EDFCED;">
    <h1>Add Employee</h1>
    <form action="" method="get">
        <input type="hidden" name="employee_stat">
    </form>
    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="fname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Middle Name</label>
            <input type="text" name="mname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="lname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Position Title</label>
            <input type="text" name="position_title" class="form-control" required>
        </div>
        <button type="submit" name="add_employee" class="btn btn-success w-100">Submit</button>
       
    </form>
    <a href="../employee.php"><button class="btn btn-secondary w-100">Cancel</button></a>
</body>
</html>