<?php
$servername="localhost";
$username= "root";
$password= "";
$database= "crudoperation";
$connection = new mysqli($servername, $username, $password,$database);
$id="";
$name="";
$email="";
$phone="";
$place="";
$successMessage="";
$errorMessage="";
if($_SERVER["REQUEST_METHOD"]== "GET"){
if(!isset($_GET["id"])){
    header("location:/crud/user.php");
    exit;
}
$id=$_GET["id"];
$sql="SELECT *FROM student where id=$id";
$result = $connection->query($sql);
$row=$result->fetch_assoc();
if(!$row){
    header("location:/crud/user.php");
    exit;
}
    $name=$row["name"];
    $email=$row["email"];
    $phone=$row["phone"];
    $place=$row["place"];
}
else{
    $id=$_POST["id"];
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $place=$_POST["place"];
    do{
        if( empty($id) || empty($name) || empty($email) || empty($phone) || empty($place) ){
            $errorMessage ="All the fields are required";
            break;
        }
        $sql= "UPDATE student ".
              "SET name='$name',email='$email',phone='$phone',place='$place'".
              "WHERE id=$id";
        $result = $connection->query($sql);
        if(!$result){
            $errorMessage = "Invalid query: ".$connection->error;
            break;
         }
        $successMessage="Client updated correctly";
        header("location:/crud/user.php");
        exit;
    }while(true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
   <div class="container my-5">
    <h2>New Students</h2>
    <?php
    if(!empty($errorMessage)){
        echo " 
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
    ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Place</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="place" value="<?php echo $place;?>">
            </div>
        </div>
        <?php
        if(!empty($successMessage)){
            echo "
            <div class='row mb-3'>
            <div class='offset-sm-3 col-sm-3'>
            <strong>$successMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert'>close</button>
            </div>
            </div>";
        }
        ?>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
            <a class="btn btn-outline-primary" href="/crud/user.php">Cancel</a>
            </div>
        </div>

    </form>
   </div> 
</body>
</html>