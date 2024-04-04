<?php 
require 'connection.php';

function sqlExecute($conn,$sql){
    $result = mysqli_query($conn,$sql);
    $data = array();
        if(mysqli_num_rows($result)>0){
           while($row = mysqli_fetch_assoc($result)){
                $data_row = array();
                foreach($row as $r){
                    array_push($data_row,$r);
                }
                array_push($data,$data_row);
           }
        }
    return $data;
}


function showRecords($conn,$tbl,$where=null){
    $sql = "SELECT * from $tbl";
    if($where!=null){
        $sql.=" WHERE $where";
    }
    return sqlExecute($conn,$sql);
}

function showAll($conn,$tbl){
    $sql = "Select * from $tbl";
    return sqlExecute($conn,$sql);
}

function addQuery($conn,$data,$tbl){
    $tbl_columns = implode(",",array_keys($data));
    $tbl_values = implode("','",$data);
    $sql = "INSERT INTO $tbl($tbl_columns) VALUES ('$tbl_values')";
    return mysqli_query($conn,$sql);
}

function updateQuery($conn,$data,$tbl,$id){
    $update="";
    foreach($data as $key => $value){
        $update.=" $key='$value' ,";
    }
    $update = substr($update,0,-1);
    $primary_key = array_keys($id)[0];
    $key_value = $id[$primary_key];
    $sql = "UPDATE $tbl SET {$update} WHERE $primary_key=$key_value";
    return mysqli_query($conn,$sql);
}

function deleteQuery($conn,$tbl,$id){
    $primary_key = array_keys($id)[0];
    $key_value = $id[$primary_key];
    $sql = "DELETE FROM $tbl WHERE $primary_key=$key_value";
    return mysqli_query($conn,$sql);
}
?>
