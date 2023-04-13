<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/database/db.php"); ?>
<?php include(ROOT_PATH . "/controllers/encryptfile.php") ?>
<?php include(ROOT_PATH . "/controllers/decryptfile.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Encrypt File</title>
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
        <!-- form errors -->
        <?php include(ROOT_PATH . "/helpers/formErrors.php"); ?>

        <div class="enc-container">
            <div class="encrypt">
                <h2 style="font-size: 35px; margin-bottom: 10px;">Encrypt Page</h2>

                <!-- Encrypt or Decrypt File -->
                <p>File Uploaded: <?php echo $_SESSION['timestamp_document_name'] ? $_SESSION['timestamp_document_name'] : 'example.txt'; ?></p>
                <p>File ready to encrypt/decrypt</p>

                <button class="small-btn" id="encrypt-btn">Encrypt</button>
                <button class="small-btn" id="decrypt-btn">Decrypt</button>
            </div>
            <div class="float-encrypt">
                <div class="float-header">
                    <h2>Encrypt File</h2>
                    <button class="close-button enc-btn">&times;</button>
                </div>
                <div class="float-body">
                    <form action="encrypt.php" method="post">
                        <label>Select Key for cipher</label>
                        <select name="cipher" id="">
                            <option value=""></option>
                            <?php for($i=1; $i <= 26; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                        <button type="submit" class="small-btn" name="encrypt-submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="float-decrypt">
                <div class="float-header">
                    <h2>Decrypt File</h2>
                    <button class="close-button dec-btn">&times;</button>
                </div>
                <div class="float-body">
                    <form action="encrypt.php" method="post">
                        <label>Select Key for cipher</label>
                        <select name="cipher" id="">
                            <option value=""></option>
                            <?php for($i=1; $i <= 26; $i++): ?>
                                <?php if(!empty($cipher_key)): ?>
                                    <option selected value="<?php echo $cipher_key; ?>"><?php echo $cipher_key; ?></option>
                                <?php else : ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </select>
                        <button type="submit" class="small-btn" name="decrypt-submit">Submit</button>
                    </form>
                </div>
            </div>
            <div id="overlay"></div>
        </div>  
    </div>

    <script src="script.js"></script>
</body>
</html>