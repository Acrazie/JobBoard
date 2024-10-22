<?php
include 'db.php';
include 'auth.php';

$current_date = date('Y-m-d H:i:s');


function create_advertisement($title, $description, $salaries, $location, $working_hours, $status, $type, $email, $current_date, $company_id, $conn)
{
    if (empty($title) || empty($description) || empty($salaries) || empty($location) || empty($working_hours) || empty($status) || empty($type) || empty($email) || empty($company_id)) {
        echo "Error: One or more fields are empty.";
        echo "<br>Type: $type";
        echo "<br>Data Received:";
        echo "<br>Title: $title";
        echo "<br>Description: $description";
        echo "<br>Salaries: $salaries";
        echo "<br>Location: $location";
        echo "<br>Working Hours: $working_hours";
        echo "<br>Status: $status";
        echo "<br>Type: $type";
        echo "<br>Date: $current_date";
        echo "<br>Email: $email";
        
        echo "<br>Company ID: $company_id";
        return;
    }
    global $current_date;

    $sql = "INSERT INTO advertisements (title, description, salaries, location, working_hours, status, type, email, date, company_id)
            VALUES ('$title', '$description', '$salaries', '$location', '$working_hours', '$status', '$type', '$email', '$current_date', '$company_id')";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../Front/AdminPage.php');
    } else {
        return "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

function read_advertisement($id, $conn)
{
    $sql = "SELECT * FROM advertisements WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $output = "";
        while ($row = $result->fetch_assoc()) {
            $output .= "Titre: " . $row['title'] . " - Description: " . $row['description'] . " - Salaire: " . $row['salaries'] . " - Lieu: " . $row['location'] . " - Heures de travail: " . $row['working_hours'] . "<br>";
        }
        return $output;
    } else {
        return "Aucune annonce trouvée.";
    }
}

function read_all_advertisements($conn)
{
    $sql = "SELECT * FROM advertisements";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $output = "";
        while ($row = $result->fetch_assoc()) {
            $output .= "Titre: " . $row['title'] . " - Description: " . $row['description'] . " - Salaire: " . $row['salaries'] . " - Lieu: " . $row['location'] . " - Heures de travail: " . $row['working_hours'] . "<br>";
        }
        return $output;
    } else {
        return "Aucune annonce disponible.";
    }
}

function update_advertisement($id, $title, $description, $salaries, $location, $working_hours, $status, $type, $email, $company_id, $conn)
{
    if (empty($title) || empty($description) || empty($salaries) || empty($location) || empty($working_hours) || empty($status) || empty($type) || empty($email) || empty($company_id)) {
        return "Erreur: Les champs sont vides.";
    }

    $sql = "UPDATE advertisements SET title='$title', description='$description', salaries='$salaries', location='$location', working_hours='$working_hours', status='$status', type='$type', email='$email', company_id='$company_id' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../Front/AdminPage.php');
    } else {
        return "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

function delete_advertisement($id, $conn)
{
    $sql = "DELETE FROM advertisements WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../Front/AdminPage.php');
    } else {
        return "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $salaries = isset($_POST['salaries']) ? $_POST['salaries'] : '';
        $location = isset($_POST['location']) ? $_POST['location'] : '';
        $working_hours = isset($_POST['working_hours']) ? $_POST['working_hours'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $type = isset($_POST['type']) ? $_POST['type'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $company_id = isset($_POST['company_id']) ? $_POST['company_id'] : null;

        switch ($action) {
            case 'create':
                echo create_advertisement($title, $description, $salaries, $location, $working_hours, $status, $type, $email, $date, $company_id, $conn);
                break;
            case 'update':
                echo update_advertisement($id, $title, $description, $salaries, $location, $working_hours, $status, $type, $email, $company_id, $conn);
                break;
            case 'delete':
                echo delete_advertisement($id, $conn);
                break;
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo read_advertisement($id, $conn);
}

if (isset($_GET['action']) && $_GET['action'] === 'read_all') {
    echo read_all_advertisements($conn);
}
