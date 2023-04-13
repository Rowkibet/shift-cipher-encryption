<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/controllers/uploadfile.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Upload File</title>
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

    <div class="page-wrapper">
        <!-- form errors -->
        <?php include(ROOT_PATH . "/helpers/formErrors.php"); ?>

        <div class="container">
            <h2>Encrypt or Decrypt File</h2>
            <p>Protect Your Text File Using Shift Cipher Encryption</p>
            <button class="btn" id="upload-btn">Upload Text File</button>
            <div class="upload-popup">
                <div class="float-header">
                    <h2>File Upload</h2>
                    <button class="close-button upl-btn">&times;</button>
                </div>
                <div class="float-body">
                    <form action="index.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="document" value= "<?php echo $document; ?>">
                        <button class="small-btn" type="submit" name="file-upload">Submit</button>
                    </form>
                </div>
            </div>
            <div id="overlay"></div>
        </div> 
    </div>

    <script src="upload.js"></script>
</body>
</html>