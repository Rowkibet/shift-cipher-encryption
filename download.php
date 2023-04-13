<?php 
include("path.php");
include(ROOT_PATH . "/database/db.php");
?>
<?php include(ROOT_PATH . "/controllers/downloadfile.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Download File</title>
</head>
<body>
    <header>
        <a href="index.php" class="logo">
            <h1 class="logo-text">Logo</h1>
        </a>

        <ul class="nav">
            <li><a href="#">Sign Up</a></li>
            <li><a href="#">Login</a></li> 
        </ul>
    </header> 

    <!-- Notification Message -->
    <?php include(ROOT_PATH . "/includes/messages.php"); ?>

    <div class="wrapper">
        <div class="container">
            <h2 style="font-size: 40px; margin-bottom: 10px;">Download Page</h2>

            <!-- download file after encryption/decryption -->
            <p>File name: <?php echo $_SESSION['timestamp_document_name'] ? $_SESSION['timestamp_document_name'] : 'example.txt'; ?></p>
            <p>File ready to download</p>
            <!-- <button type="submit" class="small-btn" name="download-btn">Download</button> -->
            <a style="font-size: 22px;" class="small-btn" href="download.php?file=<?php echo $_SESSION['timestamp_document_name']?>">Download File</a>
            <a style="font-size: 22px;" class="small-btn" href="index.php">Start Over</a>
        </div>
    </div>
</body>
</html>