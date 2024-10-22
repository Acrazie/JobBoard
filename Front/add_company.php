<?php
include '../php/db.php';
include '../php/auth.php';
// include '../php/crud_advertisement.php';

// if (is_admin() || (is_recruteur())) {
//     die("Unauthorized access");
// }
// Récupérer toutes les entreprises pour la liste déroulante
function get_companies($conn)
{
    $sql = "SELECT id, name FROM companies";
    $result = $conn->query($sql);
    $companies = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $companies[] = $row;
        }
    }
    return $companies;
}

$companies = get_companies($conn);
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
            <h2 class="text-2xl font-bold mb-4">Add Ads</h2>
            <form method="POST" action="../php/crud_advertisement.php">
                <input type="hidden" name="action" value="create">
                <input type="hidden" name="id" value="<?php echo $ad['id']; ?>">

                <label class="block mb-2">Title:</label>
                <input type="text" name="title" value="" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Description:</label>
                <textarea type="text" name="description" value="" class="block w-full p-2 mb-4 border border-gray-300 rounded"></textarea>

                <label class="block mb-2">Annual salaries:</label>
                <input type="number" name="salaries" value="" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Location:</label>
                <input type="text" name="location" value="" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Weekly Working Hours:</label>
                <input type="text" name="working_hours" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Status:</label>
                <input type="text" name="status" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Type:</label>
                <input type="text" name="type" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Email:</label>
                <input type="text" name="email" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label for="company_id" class="block mb-2">Company Name:</label>
                <select name="company_id" id="company_id" required class="block w-full p-2 mb-4 border border-gray-300 rounded">
                    <?php foreach ($companies as $company): ?>
                        <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
                    <?php endforeach; ?>
                </select><br>

                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">Add</button>
                    <a href="./AdminPage.php" class="bg-gray-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>