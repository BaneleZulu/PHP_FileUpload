<?php
$target_dir = 'uploads/';
$target_file = $target_dir . basename($_FILES['img']['name']);
$imagetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$uploadOK = 1;

//?CHECKING IF IMAGE IS REAL OR FAKE.
if (isset($_POST['submit'])) {
    $check = getimagesize($_FILES['img']['tmp_name']);
    if ($check !== false) {
        echo "File " . $check['mime'] . " is an image..<br>";
        $uploadOK = 1;
    } else {
        echo "File is not an image..<br>";
        $uploadOK = 0;
    }
}
//?CHECKING IF FILE ALREADY EXISTSi
if (file_exists($target_file)) {
    echo "File already exists<br>";
    $uploadOK = 0;
}
//? LIMITING FILE SIZE
if ($_FILES['img']['size'] > 500_000) {
    echo "File to large. Must be <5KB<br>";
    $uploadOK = 0;
}
//?LIMITING TYPE OF IMAGES ALLOWED
if ($imagetype !== 'jpg' && $imagetype !== 'png' && $imagetype !== 'jpeg' && $imagetype !== 'gif') {
    echo "Image not supported. Extensions allowed[jpg, png, jpeg, gif]<br>";
    $uploadOK = 0;
}
//?UPLOADING IMAGE
if ($uploadOK == 0) {
    echo "<p style='color:red';>FETAL ERROR::::>:could'nt upload image.</p><br>";
} else {
    if (move_uploaded_file($_FILES['img']['tmp_name'], $target_dir)) {
        echo "<h1 style='color:green';>Image Uploaded Successfully.</h1><br>";
    } else {
        echo "<p style='color:orange';>Error uploading image.</p><br>";
    }
}