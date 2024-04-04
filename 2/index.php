<?php 
    session_start();

    if(!isset($_SESSION['userAdmin'])){
        header("Location: forms/login.php");
    }

    require 'db/action.php';

    if(isset($_POST['logout'])){
        header("Location: forms/logout.php");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.js"></script>
    <title>PHP CRUD</title>
</head>
<body class="container" style="margin-top: 13vh;">
    <div class="row">
        <div class="col-10">
                <h1>Students</h1>
        </div>
        <div class="col-2">
            <form action="" method="post">
                <button type="submit" name="logout" class="btn btn-danger btn-block float-end">Logout</button>
            </form>
        </div>
    </div>
    <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Middle</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $students = showAll($conn,'tbl_students');
                    $student_count = 0;
                    if(count($students)>0){
                        foreach($students as $student){
                            echo "<tr>";
                                echo "<td>". ++$student_count. "</td>";
                                echo "<td>$student[1]</td>";
                                echo "<td>$student[2]</td>";
                                echo "<td>$student[3]</td>";
                                echo "<td>$student[4]</td>";
                                echo "<td>
                                    <a class='btn btn-warning' href='forms/student_update.php?id=$student[0]'>Update</a>
                                    <a class='btn btn-danger' href='forms/student_delete.php?id=$student[0]'>Delete</a>
                                    </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan = '6'> No record found. </td></tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Middle</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
    </table>
    <div class="row">
        <div class="col-6">
            <a href="employee.php"><button class="btn btn-success float-start">Employee</button></a>
        </div>
        <div class="col-6">
            <a href="forms/student_add.php"><button class="btn btn-success float-end">Add</button></a>
        </div>
    </div>
</body>
</html>