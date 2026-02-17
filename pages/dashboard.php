<?php
include '../db/connect.php';
include '../functions/auth_guard.php';
include '../functions/user_functions.php';

$user = $_SESSION['user'];
$userIDPost = "";
//print_r($user); 
$profile = getProfile($connect2db, $user['id']);

if (isset($_POST['update'])) {
    updateProfile($_POST, $connect2db, $user['id'],  $resultClass, $result);
}

if (isset($_POST['create'])) {
    $userIDPost = createPost($connect2db, $user['id'], $_POST, $resultClass, $result);
}
$posts = getPosts($connect2db, $user['id']);


?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div class="dashboard-card">
        <div class="dashboard-header">
            <p>Welcome, <?php echo $user['firstname'] ?></p>
            <a href="logout.php" class="logout-link">Logout</a>
        </div>

        <form method="POST" action="">
            <div class="create-post-container">
                <input class="post-input" type="text" name="postContent" placeholder="Type something">
                <button class="post-button" name="create" type="submit">
                    Create Post
                </button>
            </div>
        </form>

        <p class="subtitle">Posts</p>

        <?php foreach ($posts as $post): ?>
        <div class="post-container">
            <p><?php echo $post['firstname'] . " " .$post['lastname']; ?>&nbsp; </p>
            <p class="subtitle"><?php echo $post['postContent']; ?></p>
        </div>

        <?php endforeach; ?>
    </div>


</body>


</html>