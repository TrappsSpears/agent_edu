<?php
if (isset($_POST["submitButton"])) {
    
    $post = nl2br(htmlspecialchars($_POST['other_dat']));
    $passport = $_FILES['passport'];
    $certificate = $_FILES['certificate'];
    $medical_cond = $_POST['medical_cond'];
    $intake = $_POST['intake'];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $surname = $_POST["surname"];
    $sec_name = $_POST["sec_name"];
    $first_name = $_POST["first_name"];
    $date = date('Y-m-d H:i:s');
    $prog_choice = $_POST['prog_choice'];
    
    include_once('dbh.php');
    $dbh = new Dbh();

   

    // Upload the image if it's set
    if (isset($_FILES["passport"]) && $_FILES["passport"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "assets/userpics/";

        $uniqueFilename = uniqid() . '_' . $_FILES["passport"]["name"];
        $targetFile = $targetDir . $uniqueFilename;

        // Validate file type
        $imageFileType = strtolower(pathinfo($_FILES["passport"]["name"], PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            echo "Invalid_Image_Format";
            header("location: index.html");
        } else {
            if (move_uploaded_file($_FILES["passport"]["tmp_name"], $targetFile)) {
                // Successfully uploaded the file
                $passport = $uniqueFilename; // Set the file path
            } else {
                // Error while moving the uploaded file
                echo  "Error_MovingFile";
                header("location: index.html");
            }
        }
    }

    if (isset($_FILES["certificate"]) && $_FILES["certificate"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "assets/userpics/";

        $uniqueFilename_ = uniqid() . '_' . $_FILES["certificate"]["name"];
        $targetFile_ = $targetDir . $uniqueFilename_;

        // Validate file type
        $imageFileType = strtolower(pathinfo($_FILES["certificate"]["name"], PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            echo "Invalid_Image_Format";
            header("location: index.html");
        } else {
            if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $targetFile_)) {
                // Successfully uploaded the file
                $certificate = $uniqueFilename_; // Set the file path
            } else {
                // Error while moving the uploaded file
                echo  "Error_MovingFile";
                header("location: index.html");
            }
        }
    }

    // Prepare and execute the post insertion query
    $sql = "INSERT INTO users(name,mid_name,surname,email,phone,prog_choice,intake,med_conditional,passport,certificate,add_info) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?,?)";
    $result = $dbh->connect()->prepare($sql);

    if (!$result->execute([$first_name,$sec_name,$surname,$email,$phone_number,$prog_choice,$intake,$medical_cond,$passport,$certificate,$post])) {
        echo "Error_Query";
        header("location: index.html");
        
    } else {
   
        echo  "Post successfully created!";
        header("location: index.html");
    }


} else {
    // Form not submitted or invalid request
    echo "error";
}
