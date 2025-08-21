<?php
include("includes/db.php");

if(isset($_POST['submit'])){
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
    if($conn->query($sql)){
        echo "<script>alert('تم إرسال رسالتك بنجاح!'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('حدث خطأ، حاول مرة أخرى.'); window.location.href='contact.php';</script>";
    }
} else {
    header("Location: contact.php");
}
?>
