<?php
include '../php/db.php';
include '../php/auth.php';
// include '../php/crud_advertisement.php';

// if (is_admin() || (is_recruteur())) {
//     die("Unauthorized access");
// }
// Récupérer toutes les entreprises pour la liste déroulante
// function get_companies($conn)
// {
//     $sql = "SELECT id, name FROM companies";
//     $result = $conn->query($sql);
//     $companies = [];

//     if ($result->num_rows > 0) {
//         while ($row = $result->fetch_assoc()) {
//             $companies[] = $row;
//         }
//     }
//     return $companies;
// }

// $companies = get_companies($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ads</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Add Company</h2>
            <form method="POST" action="../php/crud_company.php">
                <input type="hidden" name="action" value="create">
                <input type="hidden" name="id" value="<?php echo $company['id']; ?>">

                <label class="block mb-2">Name:</label>
                <input type="text" name="name" value="" placeholder="Entreprise C" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Siren:</label>
                <input type="number" name="sirene" value="" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">Add</button>
                    <a href="./AdminPage.php" class="bg-gray-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>