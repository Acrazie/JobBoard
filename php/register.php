<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_SERVER['REQUEST_METHOD']);
    $name = $_POST['name'];
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $job_title = $_POST['job_title'];

    $sql_check = "SELECT * FROM users WHERE email = '$email'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "Erreur: Un utilisateur avec cet e-mail existe déjà.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $profil = 'user';
        $sql = "INSERT INTO users (name, first_name, email, phone, password, job_title, profil) 
                VALUES ('$name', '$first_name', '$email', '$phone, '$hashed_password', '$job_title', '$profil')";

        if ($conn->query($sql) === TRUE) {
            header('Location: /JobBoard/Front');
            exit();
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>