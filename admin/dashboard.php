<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: login.php");
    exit;
}
?>
<?php include("../includes/header.php"); ?>

<section style="padding:50px;">
  <h2>لوحة التحكم الرئيسية</h2>
  <ul>
    <li><a href="manage_courses.php">إدارة الدورات</a></li>
    <li><a href="manage_trainers.php">إدارة المدربين</a></li>
    <li><a href="manage_messages.php">إدارة الرسائل</a></li>
    <li><a href="logout.php">تسجيل الخروج</a></li>
  </ul>
</section>

<?php include("../includes/footer.php"); ?>
