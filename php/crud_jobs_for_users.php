<?php
include 'db.php';
include 'auth.php';

// Vérifier si la méthode utilisée est GET ou POST
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        $jobUserId = isset($_GET['id']) ? $_GET['id'] : null;

        switch ($action) {
            case 'read':
                if ($jobUserId) {
                    echo read_job_user($jobUserId, $conn);
                } else {
                    die("ID non fourni pour la lecture.");
                }
                break;

            case 'read_all':
                echo read_all_job_users($conn);
                break;

            default:
                die("Action non valide.");
        }
    } else {
        die("Aucune action spécifiée.");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $jobUserId = isset($_POST['id']) ? $_POST['id'] : null;

    switch ($action) {
        case 'create':
            $userId = $_POST['userId'];
            $advertisementId = $_POST['advertisementId'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $message = $_POST['message'];

            $sql = "INSERT INTO jobsforusers (userId, advertisementId, name, email, phone, message) VALUES
                ('$userId', '$advertisementId', '$name', '$email', '$phone', '$message')";

            if ($conn->query($sql) === TRUE) {
                header("Location: ../Front/AdminPage.php");
            } else {
                echo "Erreur: " . $sql . "<br>" . $conn->error;
            }
            break;

        case 'update':
            if ($jobUserId) {
                $userId = $_POST['userId'];
                $advertisementId = $_POST['advertisementId'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $message = $_POST['message'];

                $sql = "UPDATE jobsforusers SET 
                    userId='$userId', 
                    advertisementId='$advertisementId', 
                    name='$name', 
                    email='$email', 
                    phone='$phone',
                    message = '$message'
                    WHERE id=$jobUserId";

                if ($conn->query($sql) === TRUE) {
                    header("Location: ../Front/AdminPage.php");
                } else {
                    echo "Erreur: " . $sql . "<br>" . $conn->error;
                }
            } else {
                die("ID non fourni pour la mise à jour.");
            }
            break;

        case 'delete':
            if ($jobUserId) {
                $sql = "DELETE FROM jobsforusers WHERE id=$jobUserId";
                if ($conn->query($sql) === TRUE) {
                    header("Location: ../Front/AdminPage.php");
                } else {
                    echo "Erreur: " . $sql . "<br>" . $conn->error;
                }
            } else {
                die("ID non fourni pour la suppression.");
            }
            break;

        default:
            die("Action invalide demandée.");
    }
} else {
    die("Méthode non supportée.");
}

function read_job_user($jobUserId, $conn) {
    $sql = "SELECT * FROM jobsforusers WHERE id=$jobUserId";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        return "Aucun lien trouvé avec l'ID fourni.";
    } else {
        $jobUser = $result->fetch_assoc();
        return json_encode($jobUser); // Retourner les informations en JSON
    }
}

function read_all_job_users($conn) {
    $sql = "SELECT * FROM jobsforusers";
    $result = $conn->query($sql);

    $jobUsers = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $jobUsers[] = $row;
        }
    }

    return ($jobUsers); // Retourner tous les enregistrements en JSON
}
?>