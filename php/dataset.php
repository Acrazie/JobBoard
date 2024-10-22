<?php
include 'db.php';

// Insérer des données dans la table 'companies'
$sql = "INSERT INTO companies (name, sirene) VALUES 
    ('Entreprise A', '123456789'),
    ('Entreprise B', '987654321')";
if ($conn->query($sql) === TRUE) {
    echo "Données insérées dans la table 'companies'.<br>";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

// Insérer des données dans la table 'users'
$sql = "INSERT INTO users (name, first_name, email, phone, password, job_title, profil) VALUES 
    ('u1', 'admin', 'admin@test.com','0606060606', '" . password_hash('mdp1', PASSWORD_DEFAULT) . "', 'Développeur', 'admin'),
    ('Lucie', 'User', 'user@test.com','0714212835', '" . password_hash('mdp2', PASSWORD_DEFAULT) . "', 'Manager', 'recruteur')";
if ($conn->query($sql) === TRUE) {
    echo "Données insérées dans la table 'users'.<br>";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

// Insérer des données dans la table 'advertisements'
$sql = "INSERT INTO advertisements (title, description, salaries, location, working_hours, status, type, email, date, company_id)
VALUES
('Développeur Web', 'Poste de développeur web full-stack.', '45000', 'Paris', '35h/semaine', 'Ouvert', 'CDI', 'contact@entreprisea.com', NOW(), 1),
('Manager Projet', 'Gestion de projet dans une équipe dynamique.', '55000', 'Lyon', '40h/semaine', 'Fermé', 'CDD', 'contact@entrepriseb.com', NOW(), 2)";
if ($conn->query($sql) === TRUE) {
    echo "Données insérées dans la table 'advertisements'.<br>";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}
// Insérer des données dans la table 'jobinfos'
$sql = "INSERT INTO jobinfos (status, type, email, date, company_id) VALUES 
    ('Ouvert', 'CDI', 'contact@entreprisea.com', NOW(), 1),
    ('Fermé', 'CDD', 'contact@entrepriseb.com', NOW(), 2)";
if ($conn->query($sql) === TRUE) {
    echo "Données insérées dans la table 'jobinfos'.<br>";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

// Lier des utilisateurs à des annonces (Table jobsforusers)
$sql = "INSERT INTO jobsforusers (userId, advertisementId, name, email, phone, message) VALUES 
    (1, 1, 'user1', 'user1@test.com', '0712345678' 'Hello, I am a student at Epitech, and I am interested in your company. I am available for an apprenticeship during the following period: January 2025 to August 2027.'),
    (2, 2, 'user2', 'user2@test.com', '0798765432', 'Hello, I am a student at Epitech, and I am interested in your company. I am available for an apprenticeship during the following period: January 2025 to August 2027.')";
if ($conn->query($sql) === TRUE) {
    echo "Données insérées dans la table 'jobsforusers'.<br>";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
