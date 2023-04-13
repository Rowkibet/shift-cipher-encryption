<?php
include(ROOT_PATH . "/helpers/validateDecrypt.php");

$errors = array();
$table = 'cipher_keys';
$document = '';
$document_record = '';
$cipher_key = '';
$document_name = '';

// Check if document is in the cipher key table
$document_name = $_SESSION['current_document_name'];
$document_record = selectOne('documents', ['name' => $document_name]);

if(!empty($document_record)) {
    $sql = "SELECT d.*, ck.cipher_key FROM documents AS d 
    JOIN cipher_keys AS ck ON d.id=ck.document_id
    WHERE d.id={$document_record['id']}";
    $document = executeJoinQuery($sql);
    
    if(!empty($document)) {
        $cipher_key = $document['0']['cipher_key'];
    }
}

if(isset($_POST['decrypt-submit'])) {
    $errors = validateDecrypt($_POST);

    if(count($errors) === 0) {
        // Get text from file
        $filename = $_SESSION['document_destination'];
        $textFile = fopen($filename, "r") or die("unable to open file!");
        $fileContents = fread($textFile, filesize($filename));
        fclose($textFile);

        // Encrypt text content of the file
        $key = $_POST['cipher'];
        $cipherText = strtolower($fileContents);
        $plainText = '';
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';

        for($i = 0; $i < strlen($cipherText); $i++) {
            $currentLetter = $cipherText[$i];

            // if current letter is a whitespace
            if($currentLetter === ' ') {
                $plainText .= $currentLetter;
                continue;
            }

            if($currentLetter === '.') {
                $plainText .= $currentLetter;
                continue;
            }

            if($currentLetter === ',') {
                $plainText .= $currentLetter;
                continue;
            }

            // find index of current letter in the alphabet
            $currentIndex = strpos($alphabet, $currentLetter);

            // Decryption algorithm - p = (C - k) mod 26
            $newIndex = $currentIndex - $key;

            // if newIndex is a negative number, add 26
            if($newIndex < 0) {
                $newIndex = ($newIndex + 26) % 26;
            } else {
                $newIndex = $newIndex % 26;
            }


            if($i === 0) {
                $plainText .= strtoupper($alphabet[$newIndex]);
            } else if($plainText[strlen($plainText) - 2] === '.' && $plainText[strlen($plainText) - 1] === ' ') {
                $plainText .= strtoupper($alphabet[$newIndex]);
            } else {
                $plainText .= strtolower($alphabet[$newIndex]);
            }
        }

        // Write new encrypted text to file
        $textFile = fopen($filename, 'w') or die("unable to open file!");
        fwrite($textFile, $plainText);
        fclose($textFile);

        // Delete the document's cipher_key record
        //$count = delete($table, $_SESSION['document_id']);

        // Redirect to the download page
        $_SESSION['message'] = 'Decryption Was Successful';
        $_SESSION['type'] = 'success'; 
        header('location: ' .BASE_URL . '\download.php');
        exit();
    }
}