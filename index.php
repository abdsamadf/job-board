<?php
include_once 'db.php';
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Job Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
</head>
<body>
    <form action = "upload.php" method = "POST" enctype = "multipart/form-data">
        <input type = "file" name = "file"/>
        <input type = "submit" value="upload" name="submit-form"/>
    </form>
    <?php
   $sql = "Select * FROM userFiles";
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