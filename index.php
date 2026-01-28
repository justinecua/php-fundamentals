<?php
$firstError = "";
$lastError  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstname = $_POST["firstname"];
  $lastname  = $_POST["lastname"];

  if ($firstname == "") {
    $firstError = "First name is required.";
  }

  if ($lastname == "") {
    $lastError = "Last name is required.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Registration</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
  <div class="card">

    <h2>Registration Form</h2>

    <form method="POST">

      <div class="form-group">
        <label>First Name</label>
        <input type="text" name="firstname">
        <small><?php echo $firstError; ?></small>
      </div>

      <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="lastname">
        <small><?php echo $lastError; ?></small>
      </div>

      <button type="submit">Register</button>
    </form>

  </div>
</div>

</body>
</html>
