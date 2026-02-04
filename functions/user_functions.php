<?php

function getProfile($connect2db, $userId)
{
    $sql = "SELECT firstname, lastname, email FROM accounts WHERE id = $userId";
    $query = mysqli_query($connect2db, $sql);

    return mysqli_fetch_assoc($query);
}

function updateProfile($data, $connect2db, $userId)
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

    mysqli_query($connect2db, $sql);

    $_SESSION['user']['firstname'] = $firstname;
    $_SESSION['user']['lastname'] = $lastname;
    $_SESSION['user']['email'] = $email;
}