<?php
$servername="localhost";
$username= "root";
$password= "";
$database= "crudoperation";

$connection = new mysqli($servername, $username, $password,$database);
$name="";
$email="";
$phone="";
$place="";
$successMessage="";
$errorMessage="";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $place = $_POST['place'];

    do{
        if( empty($name) || empty($email) || empty($phone) || empty($place) ){
            $errorMessage ="All the fields are required";
            break;
        }
        // add new client to db
        $sql="INSERT INTO student(name,email,phone,place)".
        "VALUES('$name','$email','$phone','$place')";
        $result = $connection->query($sql);
        if(!$result){
           $errorMessage = "Invalid query: ".$connection->error;
           break;
        }
        $name="";
        $email="";
        $phone="";
        $place="";
        $successMessage="Client added correctly";
        header("location:/crud/user.php");
        exit;
    }while(false);
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
            </div>
            ";
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