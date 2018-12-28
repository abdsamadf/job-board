<?php
    include_once 'db.php';
?>

<?php

/*
    Format file size
    @return file size in bytes
*/
function formatSizeUnits($bytes)
{
    if ($bytes >= 1048576) {
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

        $extensions = array("pdf");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a PDF file.";
        }

        if ($file_size > 52428800) {
            $errors[] = 'File size must be exactly 50 MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, $file_destination);
            session_start();
            $id = $_SESSION['id'];
            $file_size_new = formatSizeUnits($file_size);

            $stmt = $conn->prepare('INSERT INTO userFiles (user_id, file, file_name, file_size, file_type)
            VALUES (?, ?, ?, ?, ?)');
            $stmt->bind_param('issss', $id, $file_name_new, $file_name, $file_size_new, $file_type); // 's' specifies the variable type => 'string'
            $stmt->execute();
            session_abort();
        }
    }
}
?>
