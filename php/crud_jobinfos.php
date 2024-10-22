<?php
include 'db.php';
include 'auth.php';

// Vérifier si l'utilisateur est un administrateur ou recruteur
if (!is_admin() && !is_recruteur()) {
    die("Accès refusé. Vous devez être connecté en tant qu'administrateur ou recruteur.");
}

function create_jobinfo($status, $type, $email, $date, $company_id, $conn)
{
    if (empty($status) || empty($type) || empty($email) || empty($date) || empty($company_id)) {
        return "Erreur: Les champs sont vides.";
    }

    $sql = "INSERT INTO jobinfos (status, type, email, date, company_id)
    VALUES ('$status', '$type', '$email', '$date', '$company_id')";

    if ($conn->query($sql) === TRUE) {
        return "Jobinfo créée avec succès.";
    } else {
        return "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

function read_jobinfos($conn)
{
    $sql = "SELECT * FROM jobinfos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $output = "";
        while ($row = $result->fetch_assoc()) {
            $output .= "ID: " . $row['id'] . " - Statut: " . $row['status'] . " - Type: " . $row['type'] . " - Email: " . $row['email'] . " - Date: " . $row['date'];
            $output .= "<br>";
        }
        return $output;
    } else {
        return "Aucune jobinfo trouvée.";
    }
}

function update_jobinfo($id, $status, $type, $email, $date, $company_id, $conn)
{
    if (empty($status) || empty($type) || empty($email) || empty($date) || empty($company_id)) {
        return "Erreur: Les champs sont vides.";
    }

    $sql = "UPDATE jobinfos SET status='$status', type='$type', email='$email', date='$date', company_id='$company_id'
    WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        return "Jobinfo mise à jour avec succès.";
    } else {
        return "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

function delete_jobinfo($id, $conn)
{
    if ($id) {
        $sql = "DELETE FROM jobinfos WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            return "Jobinfo supprimée avec succès.";
        } else {
            return "Erreur: " . $sql . "<br>" . $conn->error;
        }
    } else {
        die("ID non fournie pour la suppression.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        echo read_jobinfos($conn);
    } else {
        die("ID non fourni pour la lecture.");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $type = isset($_POST['type']) ? $_POST['type'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $company_id = isset($_POST['company_id']) ? $_POST['company_id'] : '';

        switch ($action) {
            case 'create':
                echo create_jobinfo($status, $type, $email, $date, $company_id, $conn);
                break;
            case 'read':
                echo read_jobinfos($conn);
                break;
            case 'update':
                echo update_jobinfo($id, $status, $type, $email, $date, $company_id, $conn);
                break;
            case 'delete':
                echo delete_jobinfo($id, $conn);
                break;
            default:
                die("Action invalide demandée.");
        }
    } else {
        die("Aucune action spécifiée.");
    }
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo read_jobinfos($conn);
}
