<?php
include '../db/connect.php';
include '../functions/auth_guard.php';
include '../functions/user_functions.php';

$user = $_SESSION['user'];
//print_r($user); 
$profile = getProfile($connect2db, $user['id']);

if (isset($_POST['update'])) {
    updateProfile($_POST, $connect2db, $user['id'],  $resultClass, $result);
 
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div class="dashboard-card">
        <h1>
            Welcome,
            <span><?php echo $user['firstname'] ?></span>
        </h1>

        <p class="subtitle">Personal Information</p>

        <form method="POST" class="profile-form">
            <label>
                First Name
                <input type="text" name="firstname" value="<?= $profile['firstname'] ?>" required>
            </label>

            <label>
                Last Name
                <input type="text" name="lastname" value="<?= $profile['lastname'] ?>" required>
            </label>

            <label>
                Email
                <input type="email" name="email" value="<?= $profile['email'] ?>" required>
            </label>

            <button type="submit" name="update">Update Profile</button>

            <?php include '../components/authDialogBox.php'?>
        </form>

        <div class="dashboard-footer">
            <a href="logout.php" class="logout-link">Logout</a>
            <span class="user-id">ID: <?= $user['id'] ?></span>
        </div>
    </div>

</body>


</html>