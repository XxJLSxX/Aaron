<?php 
require '../db/action.php';
$id = $_GET['id'] ?? NULL;

if($id==NULL)
    header("Location: ../index.php");

$data = showRecords($conn,'tbl_students', "id=$id");

if(isset($_POST['update_student'])){
    $data=[];
    foreach($_POST as $name => $val){
        if($name!="update_student")
            $data[$name] = $val;
    }
    try{
        $action = updateQuery($conn,$data,'tbl_students',['id'=>$id]);
        header("Location: ../index.php");
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
    <title>PHP CRUDE</title>
</head>
<body class="container mt-5">
    <h1>Update Student</h1>
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
        <button type="submit" name="update_student" class="btn btn-primary w-100">Submit</button>
        </div>
    </form>
</body>
</html>