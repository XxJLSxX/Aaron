<?php 
require '../db/action.php';
$id = $_GET['id'] ?? NULL;

if($id==NULL)
    header("Location: ../index.php");

$data = showRecords($conn,'tbl_students', "id=$id");

if(isset($_POST['delete_student'])){
    try{
        $action = deleteQuery($conn,'tbl_students',['id'=>$id]);
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
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Are you sure you want to delete this student?</h5>
            <h5 class="card-text">Name: <?= $data[0][1]." ".$data[0][2]." ".$data[0][3]?></h5>
            <div class="row">
                <div class="col-1">
                    <a class="btn btn-secondary" href="../index.php">Cancel</a>
                </div>
                <div class="col-1">
                    <form action="" method="post">
                        <button type="submit" name="delete_student" class="btn btn-danger w-100" >OK</button>
                    </form>
            </div>
        </div>
    </div>
</body>
</html>