<?php
include_once 'db.php';
?>
<?php
  session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: registration/login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: registration/login.php");
  }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Job Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="registration/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
</head>
<body>
    <div class="header">
        <h2>Home Page</h2>
    </div>
    <div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
            <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            ?>
            </h3>
        </div>
        <?php endif ?>

        <!-- logged in user information -->
        <?php  if (isset($_SESSION['username'])) : ?>
            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>

        <?php endif ?>
    </div>

    <form action = "upload.php" method = "POST" enctype = "multipart/form-data">
        <input type = "file" name = "file"/>
        <input type = "submit" value="upload" name="submit-form"/>
    </form>
    <?php
/*    $sql2 = "Select * FROM users";
   $_SESSION['id'] =
 */
// session_start();
   $id = $_SESSION['id'];
   /* $sql = "Select * FROM userFiles INNER JOIN users ON userFiles.user_id = users.id WHERE username='$username'"; */
   $sql = "SELECT * FROM userFiles WHERE user_id='$id'";
   $result = $conn->query($sql);
   ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th>User Id</th>
                <th>File</th>
                <th>File Name</th>
                <th>File Size</th>
                <th>File Type</th>
            </tr>
        </thead>
        <tbody>
        <?php
         if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
               echo "<tr>";
               echo "<td scope='col'>" . $row["id"] . "</td>";
               echo "<td>" . $row["user_id"] . "</td>";
               echo "<td>" . $row["file"] . "</td>";
               echo "<td>" . $row["file_name"] . "</td>";
               echo "<td>" . $row["file_size"] . "</td>";
               echo "<td>" . $row["file_type"] . "</td>";
                // echo $_FILES['file']['name'];
               ?>
        <?php
         echo "</tr>";
      }
   } else {
      echo "0 results";
   }
   ?>
        </tbody>
    </table>

   </body>
</html>
