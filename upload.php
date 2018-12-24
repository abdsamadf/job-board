<?php
    include_once 'db.php';
?>

<?php

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}


if (isset($_POST['submit-form'])) {
    if (isset($_FILES['file'])) {
        $errors = array();
        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $tmp = explode('.', $file_name);
        $file_ext = strtolower(end($tmp));
        $file_name_new = uniqid() . '.' . $file_ext;
        $file_destination = 'uploads/' . $file_name_new;

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        // Check if file already exists
        if (file_exists($file_destination)) {
            $errors[] =  "Sorry, file already exists";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be exactly 2 MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, $file_destination);
            session_start();
            $id = $_SESSION['id'];
            $file_size_new = formatSizeUnits($file_size);
            $sql = "INSERT INTO userFiles (user_id, file, file_name, file_size, file_type)
            VALUES ('$id', '$file_name_new', '$file_name', '$file_size_new', '$file_type')";

            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error:" . $sql . "<br>" . mysqli_error($conn);
            }

            echo "Success";
            header('Location: index.php');
        } else {
            print_r($errors);
        }


    }
}
?>
