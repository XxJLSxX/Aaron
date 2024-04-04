<?php 
require '../db/action.php';
$id = $_GET['id'] ?? NULL;

if($id==NULL)
    header("Location: ../employee.php");

$data = showRecords($conn,'tbl_employee', "id=$id");

if(isset($_POST['delete_employee'])){
    try{
        $action = deleteQuery($conn,'tbl_employee',['id'=>$id]);
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
    <title>PHP CRUDE</title>
</head>
<body class="container mt-5" style="background-color: #EDFCED;">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Are you sure you want to delete this employee?</h5>
            <h5 class="card-text">Name: <?= $data[0][1]." ".$data[0][2]." ".$data[0][3]?></h5>
            <div class="row">
                <div class="col-1">
                    <a class="btn btn-secondary" href="../employee.php">Cancel</a>
                </div>
                <div class="col-1">
                    <form action="" method="post">
                        <button type="submit" name="delete_employee" class="btn btn-danger w-100" >OK</button>
                    </form>
            </div>
        </div>
    </div>
</body>
</html>