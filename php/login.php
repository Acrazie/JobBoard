<?php
// session_start();
include 'db.php';
include 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (login($email, $password)) {
        // Récupérer le profil de l'utilisateur de la session
        $profil = $_SESSION['profil'];

        switch ($profil) {
            case 'admin':
                header('Location: ../Front/AdminPage.php');
                break;
            case 'recruteur':
                header('Location: ../Front/index.php');
                break;
            case 'user':
                header('Location: ../Front/index.php');
                break;
            default:
                header('Location: ../Front/index.php');
                break;
        }
    } else {
        echo "Identifiants incorrects.";
    }
}
