<?php
include(ROOT_PATH . "/helpers/validateEncrypt.php");

$errors = array();
$table = 'cipher_keys';


if(isset($_POST['encrypt-submit'])) {
    $errors = validateEncrypt($_POST);

    if(count($errors) === 0) {
        // Get text from file
        $filename = $_SESSION['document_destination'];
        $textFile = fopen($filename, "r") or die("unable to open file!");
        $fileContents = fread($textFile, filesize($filename));
        fclose($textFile);

        // Encrypt text content of the file
        $key = $_POST['cipher'];
        $plainText = strtolower($fileContents);
        $cipherText = '';
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';

        for($i = 0; $i < strlen($plainText); $i++) {
            $currentLetter = $plainText[$i];

            // if current letter is a whitespace
            if($currentLetter === ' ') {
                $cipherText .= $currentLetter;
                continue;
            }

            if($currentLetter === '.') {
                $cipherText .= $currentLetter;
                continue;
            }

            if($currentLetter === ',') {
                $cipherText .= $currentLetter;
                continue;
            }

            // find index of current letter in the alphabet
            $currentIndex = strpos($alphabet, $currentLetter);

            // Encryption algorithm - C = (p + k) mod 26
            $newIndex = ($currentIndex + $key) % 26;
            $cipherText .= strtoupper($alphabet[$newIndex]);
        }

        // Write new encrypted text to file
        $textFile = fopen($filename, 'w') or die("unable to open file!");
        fwrite($textFile, $cipherText);
        fclose($textFile);

        // Store the filename with the cipher used
        $cipher_data['cipher_key'] = $key;
        $cipher_data['document_id'] = $_SESSION['document_id'];
        $cipher_key_id = create($table, $cipher_data);

        // Redirect to the download page
        $_SESSION['message'] = 'Encryption Was Successful';
        $_SESSION['type'] = 'success'; 
        header('location: ' .BASE_URL . '\download.php');
        exit();
    }

}
