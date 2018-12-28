<?php include('upload.php') ?>
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

    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/solid.min.css">
    <link rel="stylesheet" type="text/css" href="css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="registration/style.css">
</head>

<body>
    <div class="container">
        <div class="columns is-centered">
            <main class="column is-three-quarters">
                <div class="header has-background-grey-dark">
                    <h2 class="title is-2 has-text-white-ter">Job Board</h2>
                </div>
                <div class="content">
                    <!-- notification message -->
                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="notification is-primary has-text-centered is-vertical-center" >
                            <h3 class="is-4 has-text-white-ter">
                                <?php
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                ?>
                            </h3>
                        </div>
                    <?php endif ?>

                    <!-- logged in user information -->
                    <?php  if (isset($_SESSION['username'])) : ?>
                        <p class="title is-3">Welcome <?php echo $_SESSION['username']; ?></p>
                        <a class="button is-medium is-danger " href="index.php?logout='1'" >logout</a>
                    <?php endif ?>
                </div>

                <form action = "" method = "POST" enctype = "multipart/form-data">
                    <?php
                        if (empty($errors) != true) {
                            include('registration/errors.php');
                        }
                    ?>
                    <div class="control">
                        <div class="field">
                            <div class="file is-medium is-dark is-centered is-boxed">
                                <label class="file-label">
                                    <input class="file-input" id="file" type="file" name="file" accept=".pdf" required/>
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-upload"></i>
                                        </span>
                                        <span class="file-label">
                                            Choose a file
                                        </span>
                                    </span>
                                    <span class="file-name" id="filename">
                                        No File Chosen
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="control has-text-centered">
                    <input class="button is-medium is-info" type="submit" value="upload" name="submit-form"/>
                    </div>
                </form>
            </main>
        </div>
        <?php

            // Select userFiles table data
            $id = $_SESSION['id'];
            $sql = "SELECT F.user_id, F.file, F.file_name, F.file_size, F.file_type, U.username FROM userFiles F INNER JOIN users U ON F.user_id = U.id WHERE user_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        ?>

        <table class="table is-striped is-bordered is-narrow">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th>User Id</th>
                    <th>Username</th>
                    <th>Resume</th>
                    <th>Resume Name</th>
                    <th>Resume Size</th>
                    <th>Resume Type</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($result->num_rows > 0) {
                    // output data of each row
                    $i = 0;
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                        echo "<tr>";
                        echo "<td scope='col'>" . $i . "</td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["file"] . "</td>";
                        echo "<td>" . $row["file_name"] . "</td>";
                        echo "<td>" . $row["file_size"] . "</td>";
                        echo "<td>" . $row["file_type"] . "</td>";
            ?>
            <?php
                        echo "</tr>";
                    }
                } else {
                    echo '<tr><td colspan="6">No Results</td></tr>';
                }
            ?>
            </tbody>
        </table>

    </div>

    <script src="js/main.js"></script>
</body>
</html>
