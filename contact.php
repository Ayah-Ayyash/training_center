<?php include("includes/header.php"); ?>

<section class="page-header">
  <h1>تواصل معنا</h1>
</section>

<section class="contact-form" data-aos="fade-up">
  <form action="process_contact.php" method="POST">
    <input type="text" name="name" placeholder="الاسم الكامل" required>
    <input type="email" name="email" placeholder="البريد الإلكتروني" required>
    <textarea name="message" placeholder="رسالتك" rows="6" required></textarea>
    <button type="submit" name="submit" class="btn">إرسال</button>
  </form>
</section>

<?php include("includes/footer.php"); ?>
