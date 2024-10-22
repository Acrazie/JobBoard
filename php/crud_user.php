<?php
include 'db.php';
include 'auth.php';

// Vérifier si la méthode utilisée est GET ou POST
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Vérifier l'action demandée (lire un utilisateur spécifique ou tous les utilisateurs)
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        // Si un ID est fourni, on le récupère
        $userId = isset($_GET['id']) ? $_GET['id'] : null;

        switch ($action) {
            case 'read': // Lire un utilisateur spécifique
                if ($userId) {
                    echo read_user($userId, $conn);
                } else {
                    die("ID non fourni pour la lecture.");
                }
                break;

            case 'readAll': // Lire tous les utilisateurs
                echo readall($conn);
                break;
            default:
                die("Action non valide.");
        }
    } else {
        die("Aucune action spécifiée.");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier le type d'opération pour les utilisateurs
    $action = $_POST['action'];
    $userId = isset($_POST['userId']) ? $_POST['userId'] : null;

    switch ($action) {
        case 'create':
            // Création d'un nouvel utilisateur
            $name = $_POST['name'];
            $first_name = $_POST['first_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $job_title = $_POST['job_title'];
            $profil = $_POST['profil']; // Profil fourni lors de la création
            echo create_user($name, $first_name, $email, $phone, $password, $job_title, $profil, $conn);
            break;

        case 'update':
            // Mise à jour d'un utilisateur existant
            if ($userId) {
                $name = $_POST['name'];
                $first_name = $_POST['first_name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $password = $_POST['password'];
                $job_title = $_POST['job_title'];
                $profil = $_POST['profil']; // Profil mis à jour
                echo update_user($userId, $name, $first_name, $email, $phone, $password, $job_title, $profil, $conn);
            } else {
                die("ID non fournie pour la mise à jour.");
            }
            break;

        case 'delete':
            // Suppression d'un utilisateur
            if ($userId) {
                echo delete_user($userId, $conn);
            } else {
                die("ID non fournie pour la suppression.");
            }
            break;

        default:
            die("Action invalide demandée.");
    }
} else {
    die("Méthode non supportée.");
}

// Fonction pour créer un nouvel utilisateur
function create_user($name, $first_name, $email, $phone, $password, $job_title, $profil, $conn)
{
    if (empty($name) || empty($first_name) || empty($email)  || empty($phone) || empty($password) || empty($job_title) || empty($profil)) {
        return "Erreur: Les champs sont vides.";
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hacher le mot de passe avant de l'enregistrer

    $sql = "INSERT INTO users (name, first_name, email, phone, password, job_title, profil) VALUES
        ('$name', '$first_name', '$email', '$phone', '$hashed_password', '$job_title', '$profil')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../Front/AdminPage.php");
    } else {
        return "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

// Fonction pour lire un utilisateur spécifique
function read_user($userId, $conn)
{
    $sql = "SELECT * FROM users WHERE id=$userId";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        return "Aucun utilisateur trouvé avec l'ID fourni.";
    } else {
        $user = $result->fetch_assoc();
        return json_encode($user); // Retourner les informations de l'utilisateur en JSON
    }
}

function update_user($userId, $name, $first_name, $email, $phone, $password, $job_title, $profil, $conn)
{
    if ($userId) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hacher le nouveau mot de passe avant de l'enregistrer

        $sql = "UPDATE users SET name='$name', first_name='$first_name', email='$email', phone='$phone', password='$hashed_password', job_title='$job_title', profil='$profil' WHERE id=$userId";

        if ($conn->query($sql) === TRUE) {
            if ($_SESSION['profil'] === 'admin') {
                header('Location: ../Front/AdminPage.php');
            } else {
                header('Location: ../Front/index.php');
            }
        } else {
            return "Erreur: " . $sql . "<br>" . $conn->error;
        }
    } else {
        die("ID non fournie pour la mise à jour.");
    }
}

function delete_user($userId, $conn)
{
    if ($userId) {
        $sql = "DELETE FROM users WHERE id=$userId";
        if ($conn->query($sql) === TRUE) {
            return "Utilisateur supprimé avec succès.";
        } else {
            return "Erreur: " . $sql . "<br>" . $conn->error;
        }
    } else {
        die("ID non fournie pour la suppression.");
    }
}
