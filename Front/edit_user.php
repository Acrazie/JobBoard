<?php
session_start();
include '../php/db.php';
include '../php/auth.php';

if (!is_admin()) {
    die("Unauthorized access");
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id=$userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found.");
    }
} else {
    die("User ID not provided.");
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
            <form method="POST" action="../php/crud_user.php">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">

                <label class="block mb-2">Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">First Name:</label>
                <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Phone:</label>
                <input type="tel" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">

                <label class="block mb-2">Password:</label>
                <input type="password" name="password" class="block w-full p-2 mb-4 border border-gray-300 rounded" placeholder="Leave blank to keep current password">
                
                <label class="block mb-2">Job Title:</label>
                <input type="text" name="job_title" value="<?php echo htmlspecialchars($user['job_title']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded">


                <label class="block mb-2">Profile:</label>
                <input type="text" name="profil" value="<?php echo htmlspecialchars($user['profil']); ?>" class="block w-full p-2 mb-4 border border-gray-300 rounded" placeholder="'admin', 'recruteur', 'user'">

                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">Update</button>
                    <a href="./AdminPage.php" class="bg-gray-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
