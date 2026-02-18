<?php

function getProfile($connect2db, $userId)
{
    $sql = "SELECT firstname, lastname, email FROM accounts WHERE id = $userId";
    $query = mysqli_query($connect2db, $sql);

    return mysqli_fetch_assoc($query);
}

function updateProfile($data, $connect2db, $userId, &$resultClass, &$result)
{
    $firstname = $data['firstname'];
    $lastname  = $data['lastname'];
    $email     = $data['email'];

    $sql = "
        UPDATE accounts
        SET firstname = '$firstname',
            lastname = '$lastname',
            email = '$email'
        WHERE id = $userId
    ";

    if (!mysqli_query($connect2db, $sql)) {
        $resultClass = "error";
        $result = mysqli_error($connect2db);
        return;
    }

    $resultClass = "success";
    $result = "Updated Successfully";

    $_SESSION['user']['firstname'] = $firstname;
    $_SESSION['user']['lastname'] = $lastname;
    $_SESSION['user']['email'] = $email;
}

function createPost($connect2db, $userId, $data, &$resultClass, &$result) //& means use the same original variable from outside
{
    $postContent = $data['postContent'];
    $sql = "
        INSERT INTO posts (postContent, userID)
        VALUES (
            '$postContent',
            '$userId'
        )
    ";

    if (!mysqli_query($connect2db, $sql)) {
        $resultClass = "error";
        $result = mysqli_error($connect2db);
        return;
    }

    $resultClass = "success";
    $result = "Post Created Successfully";
}


function getPosts($connect2db, $userId) 
{
    $sql = "SELECT * FROM posts LEFT JOIN accounts on accounts.id = posts.userID ORDER BY posts.id DESC";
    $query = mysqli_query($connect2db, $sql);

    $posts = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $posts[] = $row;
    }
    return $posts;
}