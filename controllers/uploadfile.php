<?php
include(ROOT_PATH . "/database/db.php");

$errors = array();
$table = 'documents';
$_SESSION['current_document_name'] = '';

$document = '';

if(isset($_POST['file-upload'])) {
    $errors = array();

    if(!empty($_FILES['document']['name'])) {
        $document = selectOne($table, ['name' => $_FILES['document']['name']]);
        if(!empty($document)) {
            $file_name = $_FILES['document']['name'];
        } else {
            $file_name = time() . '_' . $_FILES['document']['name'];
        }

        // Check for file extension
        $fileExt = explode('.', $file_name);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExtensions = array('txt');
            // if ext of file is one of the allowed extension
        if(in_array($fileActualExt, $allowedExtensions)) {
            $destination = ROOT_PATH . "/assets/files/" . $file_name;
            $result = move_uploaded_file($_FILES['document']['tmp_name'], $destination);
    
            if($result) {
                $_POST['name'] = $file_name;
            } else {
                array_push($errors, "Failed to upload document");
            }
        } else {
            array_push($errors, "You cannot upload file of this type");
        }

    } else {
        array_push($errors, "file required");
    }

    if(count($errors) === 0) {
        unset($_POST['file-upload']);
        if(empty($document)) {
            $document_id = create($table, $_POST);
        }

        $_SESSION['message'] = 'File Uploaded Successfully';
        $_SESSION['type'] = 'success';  
        $_SESSION['current_document_name'] = $_FILES['document']['name'];
        $_SESSION['document_id'] = $document_id;
        $_SESSION['document_destination'] = $destination;
        $_SESSION['timestamp_document_name'] = $file_name;
        header('location: ' .BASE_URL . '\encrypt.php');
        exit();
    } else {
        //$document = $_POST['name'];
    }
}