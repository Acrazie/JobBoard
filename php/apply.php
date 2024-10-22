<?php
session_start();
include 'db.php';  
include 'auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $advertisementId = $_POST['advertisementId']; 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    if (empty($name) || empty($email) || empty($phone) || empty($message) || empty($advertisementId)) {
        exit("Tous les champs sont requis.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Format de l'email invalide.");
    }

    if (!preg_match("/^\+?[0-9]{9,15}$/", $phone)) {  
        exit("Numéro de téléphone invalide.");
    }

    // Vérifie si l'user est connecté
    if (!isset($_SESSION['id'])) {
        exit("Utilisateur non authentifié.");
    }
    
    $userId = $_SESSION['id'];

    // Préparation de la requête
    $stmt = $conn->prepare("INSERT INTO jobsforusers (userId, advertisementId, name, email, phone, message) VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        exit("Erreur lors de la préparation de la requête : " . $conn->error);
    }

    // Lier les paramètres à la requête
    $stmt->bind_param("iissss", $userId, $advertisementId, $name, $email, $phone, $message);

    if ($stmt->execute()) {
        header("Location: ../Front/index.php");
    } else {
        exit("Erreur lors de la soumission de la candidature : " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    exit("Méthode de requête invalide.");
}
?>

