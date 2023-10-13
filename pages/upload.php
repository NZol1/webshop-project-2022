<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/includes/header.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/includes/navigation.php");





    
    $target_directory ="../images/products/";
    $target_file =$target_directory.basename($_FILES["imgUpload"]["name"]);
    $uploadOk=1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(isset($_POST["img-upload"])&& unserialize($_SESSION["user"])->isAdmin==1){
        $check =getimagesize($_FILES["imgUpload"]["tmp_name"]);
        if($check!==false){
            $uploadOk=1;
        }
        else {
            $uploadOk=0;
        }
        if(file_exists($target_file)){
            SetMessage("A fájl már létezik") ;
            $uploadOk=0;
        }
        if($_FILES["imgUpload"]["size"] > 500000){
            SetMessage("A fájl túl nagy a feltöltéshez");
            $uploadOk=0;
        }
        if($imageFileType!= "jpg" && $imageFileType!= "png"&&$imageFileType!= "jpeg"&&$imageFileType!= "gif"){
        SetMessage("Csak JPG, JPEG, PNG és GIF fájlokat tölthetsz fel");
            $uploadOk=0;
        }

        if($uploadOk==0){
            SetMessage("A fájlt nem sikerült feltölteni");

        }
        else {
            if(move_uploaded_file($_FILES["imgUpload"]["tmp_name"],$target_file)){
                SetMessage("A fájl: ".htmlspecialchars(basename($_FILES["imgUpload"]["name"])). " sikeresen feltöltve");
            }
            else {
                SetMessage("Valami furcsaság történt a feltöltéskor...");
            }
        }
    }
    Redirect("pages/admin.php");


require_once($_SERVER['DOCUMENT_ROOT']."/Webshop/scripts/includes/footer.php");?>