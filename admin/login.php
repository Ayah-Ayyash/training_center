<?php
session_start();
include("../includes/db.php"); // تأكد أن هذا المسار صحيح

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = hash('sha256', $password);

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password_hash);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "اسم المستخدم أو كلمة المرور غير صحيحة";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>تسجيل الدخول - لوحة التحكم</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<section style="padding:100px; text-align:center;">
  <h2>تسجيل الدخول</h2>
  <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <form method="post">
    <input type="text" name="username" placeholder="اسم المستخدم" required>
    <input type="password" name="password" placeholder="كلمة المرور" required>
    <button type="submit" name="login" class="btn">دخول</button>
  </form>
</section>
</body>
</html>
