<?php
session_start();
include '../php/db.php';
include '../php/auth.php';

if (!is_admin()) {
    die("Unauthorized access");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM advertisements WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $ad = $result->fetch_assoc();
    } else {
        die("Ad not found.");
    }
} else {
    die("Ad Id not provided.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Edit User</h2>
            <form method="POST" action="../php/crud_advertisement.php">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?php echo $ad['id']; ?>">

                <label class="block mb-2">Title:</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($ad['title']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Description:</label>
                <textarea type="text" name="description" class="block w-full p-2 mb-4 border border-gray-300 rounded"><?php echo htmlspecialchars($ad['description']); ?></textarea>

                <label class="block mb-2">Salaries:</label>
                <input type="number" name="salaries" value="<?php echo htmlspecialchars($ad['salaries']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Location:</label>
                <input type="text" name="location" value="<?php echo htmlspecialchars($ad['location']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Working Hours:</label>
                <input type="number" name="working_hours" value="<?php echo htmlspecialchars($ad['working_hours']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Status:</label>
                <input type="text" name="status" value="<?php echo htmlspecialchars($ad['status']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Type:</label>
                <input type="text" name="type" value="<?php echo htmlspecialchars($ad['type']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($ad['email']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <!-- <label class="block mb-2">Date:</label>
                <input type="date" name="date" value="<?php echo htmlspecialchars($ad['date']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded"> -->

                <label class="block mb-2">Company_id:</label>
                <input type="number" name="company_id" value="<?php echo htmlspecialchars($ad['company_id']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">Update</button>
                    <a href="./AdminPage.php" class="bg-gray-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>