
<?php
$fileName = $_FILES['file']['name'];
$fileType = $_POST['filetype'];
if($fileType == 'image'){
  $validExtension = array('png','jpeg','jpg');
}
$uploadDir = "upload/".$fileName;
$fileExtension = pathinfo($uploadDir, PATHINFO_EXTENSION);
$fileExtension = strtolower($fileExtension);
if(in_array($fileExtension, $validExtension)){
   if(move_uploaded_file($_FILES['file']['tmp_name'],$uploadDir)){
    echo $fileName;
  }
}
?>
