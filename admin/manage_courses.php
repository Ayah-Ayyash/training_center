
<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) header("Location: login.php");
include("../includes/db.php");

if(isset($_POST['add_course'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $trainer = $_POST['trainer'];

    $stmt = $conn->prepare("INSERT INTO courses (title, description, duration, trainer) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $duration, $trainer);
    $stmt->execute();
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM courses WHERE id=$id");
}

$courses = $conn->query("SELECT * FROM courses");
?>

<?php include("../includes/header.php"); ?>

<section style="padding:50px;">
  <h2>إدارة الدورات</h2>

  <h3>إضافة دورة جديدة</h3>
  <form method="post">
    <input type="text" name="title" placeholder="عنوان الدورة" required>
    <input type="text" name="duration" placeholder="مدة الدورة" required>
    <input type="text" name="trainer" placeholder="المدرب" required>
    <textarea name="description" placeholder="وصف الدورة"></textarea>
    <button type="submit" name="add_course" class="btn">إضافة</button>
  </form>

  <h3>الدورات الحالية</h3>
  <table border="1" cellpadding="10" style="width:100%; margin-top:20px;">
    <tr>
      <th>عنوان الدورة</th>
      <th>المدة</th>
      <th>المدرب</th>
      <th>الإجراء</th>
    </tr>
    <?php while($row = $courses->fetch_assoc()){ ?>
      <tr >
        <td><?= $row['title'] ?></td>
        <td><?= $row['duration'] ?></td>
        <td><?= $row['trainer'] ?></td>
        <td><a href="?delete=<?= $row['id'] ?>" style="color:red;">حذف</a></td>
      </tr>
    <?php } ?>
  </table>
</section>

<?php include("../includes/footer.php"); ?>
