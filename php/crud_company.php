<?php
include 'db.php';
include 'auth.php';

// Vérifier si la méthode utilisée est GET ou POST
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Vérifier l'action demandée (lire une entreprise spécifique ou toutes les entreprises)
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        $companyId = isset($_GET['id']) ? $_GET['id'] : null;

        switch ($action) {
            case 'read': // Lire une entreprise spécifique
                if ($companyId) {
                    echo read_company($companyId, $conn);
                } else {
                    die("ID non fourni pour la lecture.");
                }
                break;

            default:
                die("Action non valide.");
        }
    } else {
        die("Aucune action spécifiée.");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier le type d'opération pour les entreprises
    $action = $_POST['action'];
    $companyId = isset($_POST['id']) ? $_POST['id'] : null;

    switch ($action) {
        case 'create':
            // Création d'une nouvelle entreprise
            $name = $_POST['name'];
            $sirene = $_POST['sirene'];
            $sql = "INSERT INTO companies (name, sirene) VALUES ('$name', '$sirene')";

            if ($conn->query($sql) === TRUE) {
                header("Location: ../Front/AdminPage.php");
            } else {
                echo "Erreur: " . $sql . "<br>" . $conn->error;
            }
            break;

        case 'update':
            // Mise à jour d'une entreprise existante
            if ($companyId) {
                $name = $_POST['name'];
                $sirene = $_POST['sirene'];
                $sql = "UPDATE companies SET name='$name', sirene='$sirene' WHERE id=$companyId";

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
            // Suppression d'une entreprise
            if ($companyId) {
                $sql = "DELETE FROM companies WHERE id=$companyId";
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

// Fonction pour lire une entreprise spécifique
function read_company($companyId, $conn)
{
    $sql = "SELECT * FROM companies WHERE id=$companyId";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        return "Aucune entreprise trouvée avec l'ID fourni.";
    } else {
        $company = $result->fetch_assoc();
        return json_encode($company); // Retourner les informations de l'entreprise en JSON
    }
}
