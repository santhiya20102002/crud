<?php
if(isset($_GET["id"])){
    $id=$_GET["id"];
    $servername="localhost";
    $username= "root";
    $password= "";
    $database= "crudoperation";
    $connection = new mysqli($servername, $username, $password,$database);
    $sql="DELETE FROM student where id=$id";
    $result = $connection->query($sql);
    
}
header("location:/crud/user.php");
exit;
?>