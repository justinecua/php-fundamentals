<?php
include '../db/connect.php';

function register($data, $connect2db, &$result, &$resultClass)
{
    $firstname = $data['firstname'];
    $lastname  = $data['lastname'];
    $email     = $data['email'];
    $password  = $data['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "
        INSERT INTO accounts (firstname, lastname, email, password)
        VALUES (
            '$firstname',
            '$lastname',
            '$email',
            '$hashedPassword'
        )
    ";

    if (!mysqli_query($connect2db, $sql)) {
        $resultClass = "error";
        $result = mysqli_error($connect2db);
        return;
    }

    $resultClass = "success";
    $result = "Registered Successfully";

}

function login($data, $connect2db, &$result, &$resultClass)
{
    $email    = $data['email'];
    $password = $data['password'];

    $sql = "
        SELECT id, firstname, lastname, email, password
        FROM accounts
        WHERE email = '$email'
        LIMIT 1
    ";

    $query = mysqli_query($connect2db, $sql);

    if (!$query) {
        $resultClass = "error";
        $result = mysqli_error($connect2db);
        return;
    }

    if (mysqli_num_rows($query) === 0) {
        $resultClass = "error";
        $result = "Account not found";
        return;
    }

    $row = mysqli_fetch_assoc($query);

    if (!password_verify($password, $row['password'])) {
        $resultClass = "error";
        $result = "Invalid password";
        return;
    }

    // $resultClass = "success";
    // $result = "Login successful";


    $_SESSION['user'] = [
        'id' => $row['id'],
        'firstname' => $row['firstname'],
        'lastname' => $row['lastname'],
        'email' => $row['email']
    ];

    header("Location: dashboard.php");
}