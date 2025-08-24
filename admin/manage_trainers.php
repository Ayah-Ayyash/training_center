<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) header("Location: login.php");
include("../includes/db.php");

if(isset($_POST['add_trainer'])){
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];

    $stmt = $conn->prepare("INSERT INTO trainers (name, specialty) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $specialty);
    $stmt->execute();
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM trainers WHERE id=$id");
}

$trainers = $conn->query("SELECT * FROM trainers");
?>

<?php include("../includes/header.php"); ?>

<section style="padding:50px;">
  <h2>إدارة المدربين</h2>

  <h3>إضافة مدرب جديد</h3>
  <form method="post">
    <input type="text" name="name" placeholder="اسم المدرب" required>
    <input type="text" name="specialty" placeholder="تخصص المدرب" required>
    <button type="submit" name="add_trainer" class="btn">إضافة</button>
  </form>

  <h3>المدربون الحاليون</h3>
  <table border="1" cellpadding="10" style="width:100%; margin-top:20px;">
    <tr>
      <th>اسم المدرب</th>
      <th>التخصص</th>
      <th>الإجراء</th>
    </tr>
    <?php while($row = $trainers->fetch_assoc()){ ?>
      <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['specialty'] ?></td>
        <td><a href="?delete=<?= $row['id'] ?>" style="color:red;">حذف</a></td>
      </tr>
    <?php } ?>
  </table>
</section>

<?php include("../includes/footer.php"); ?>
