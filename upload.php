<?php
// If they DID upload a file...
if(isset($_FILES['file']['name'])) {
    $isSucceed = false;
    // If no errors...
    if(! $_FILES['file']['error']) {
        $isValidFile = true;
        // Now is the time to modify the future file name and validate the file
        $newFileName = 'api.yaml'; // Rename file
        if($_FILES['file']['size'] > (1024000)) {  // Can't be larger than 1 MB
            $isValidFile = false;
            $message = 'Oops!  Your file\'s size is to large.';
        }
        
        // If the file has passed the test
        if ($isValidFile) {
            // Move it to where we want it to be
            move_uploaded_file($_FILES['file']['tmp_name'], __DIR__ . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . $newFileName);
            $isSucceed = true;
            $message = 'Congratulations!  Your file was accepted.';
        }
    } else {
        // If there is an error...
        //set that to be the returned message
        $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
    }
}
?>
<!-- HTML for static distribution bundle build -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload file</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="assets/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="assets/favicon-16x16.png" sizes="16x16" />
</head>

<body>
    <div class="container">
        <h1>File uploader</h1>
        <?php if (isset($message)): ?>
            <div class="alert <?php echo $isSucceed ? 'alert-success' : 'alert-danger' ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Yaml file</label>
                <input type="file" class="form-control" id="file" name="file">
            </div>
            <button type="submit" class="btn btn-primary">Upload file</button>
        </form>
    </div>
</body>
</html>