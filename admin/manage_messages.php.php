<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) header("Location: login.php");
include("../includes/db.php");

// حذف رسالة
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM messages WHERE id=$id");
}

// جلب كل الرسائل
$messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>

<?php include("../includes/header.php"); ?>

<section style="padding:50px;">
  <h2>الرسائل الواردة</h2>

  <table border="1" cellpadding="10" style="width:100%; margin-top:20px;">
    <tr>
      <th>الاسم</th>
      <th>البريد الإلكتروني</th>
      <th>الرسالة</th>
      <th>تاريخ الإرسال</th>
      <th>الإجراء</th>
    </tr>
    <?php while($row = $messages->fetch_assoc()){ ?>
      <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['message'] ?></td>
        <td><?= $row['created_at'] ?></td>
        <td><a href="?delete=<?= $row['id'] ?>" style="color:red;">حذف</a></td>
      </tr>
    <?php } ?>
  </table>
</section>

<?php include("../includes/footer.php"); ?>
