<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD OPERATION</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head> 
<body>
    <div class="container my-5">
     <h2>List of Students</h2>
     <a class="btn btn-primary" href="/crud/create.php" role="button">New student</a>
     <br>
     <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>PHONE</th>
                <th>PLACE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername= "localhost";
            $username= "root";
            $password= "";
            $database= "crudoperation";
         $connection = new mysqli($servername, $username, $password,$database);
         if ($connection->connect_error) {
            die("Connection failed". $connection->connect_error);
         }
         $sql = "SELECT * FROM student";
         $result = $connection->query($sql);
         if (!$result) {
            die("Invalid query". $connection->error);
         }
         while($row = $result->fetch_assoc()){
            echo "
              <tr>
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[place]</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='/crud/edit.php?id=$row[id]'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='/crud/delete.php?id=$row[id]'>Delete</a>
                </td>
            </tr>
            ";
         }
            ?>
            <!-- <tr>
                <td>1</td>
                <td>Santhiya</td>
                <td>santhiya6277@gamil.com</td>
                <td>9994067710</td>
                <td>Coimbatore</td>
                <td>
                    <a class='btn btn-primary btn-sm' href="/crud/edit.php">Edit</a>
                    <a class='btn btn-danger btn-sm' href="/crud/delete.php">Delete</a>
                </td>
            </tr> -->
        </tbody>
     </table>
    </div>
    
</body>
</html>