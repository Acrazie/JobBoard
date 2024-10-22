<?php
session_start();
include '../php/db.php';
include '../php/auth.php';

if (!is_admin()) {
    die("Unauthorized access");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM companies WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $company = $result->fetch_assoc();
    } else {
        die("Company not found.");
    }
} else {
    die("Company Id not provided.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Edit Company</h2>
            <form method="POST" action="../php/crud_company.php">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?php echo $company['id']; ?>">

                <label class="block mb-2">Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($company['name']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Siren:</label>
                <input type="number" name="sirene" value="<?php echo htmlspecialchars($company['sirene']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">Update</button>
                    <a href="./AdminPage.php" class="bg-gray-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>