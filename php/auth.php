<?php
session_start();
include 'db.php';

function login($email, $password) {

    global $conn;

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['profil'] = $user['profil'];
            $_SESSION['email'] = $user['email'];
            return true;
        }
    }
    return false;
}


function is_admin() {
    return isset($_SESSION['profil']) && $_SESSION['profil'] === 'admin';
}

function is_recruteur() {
    return isset($_SESSION['profil']) && $_SESSION['profil'] === 'recruteur';
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    logout();
}

function logout() {
    session_destroy();
    header('Location: ../Front/AccountPage.php');
    exit();
}

?>