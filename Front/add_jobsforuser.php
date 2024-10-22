<?php
session_start();
include '../php/db.php';
include '../php/auth.php';

if (!is_admin()) {
    die("Unauthorized access");
}

// Get user data based on userId passed in the query string
// if (isset($_GET['id'])) {
//     $id = $_GET['id'];

//     // Fetch the user's current details from the database
//     $sql = "SELECT * FROM jobsforusers WHERE id=$id";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         $jobsforusers = $result->fetch_assoc();
//     } else {
//         die("Jobsforuser not found.");
//     }
// } else {
//     die("Jobforuser Id not provided.");
// }
function get_user($conn)
{
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    $users = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    return $users;
}

$users = get_user($conn);

function get_advertisement($conn)
{
    $sql = "SELECT * FROM advertisements";
    $result = $conn->query($sql);
    $ads = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ads[] = $row;
        }
    }
    return $ads;
}

$ads = get_advertisement($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Jobsforusers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Edit JobforUser</h2>
            <form method="POST" action="../php/crud_jobs_for_users.php">
                <input type="hidden" name="action" value="create">
                <input type="hidden" name="id" value="<?php echo $jobsforusers['id']; ?>">

                <label class="block mb-2">userId:</label>
                <select name="userId" id="user_id" required class="block w-full p-2 mb-4 border border-gray-300 rounded">
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                    <?php endforeach; ?>
                </select><br>

                <label class="block mb-2">Name:</label>
                <select name="name" id="name" required class="block w-full p-2 mb-4 border border-gray-300 rounded">
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['name']; ?>"><?php echo $user['name']; ?></option>
                    <?php endforeach; ?>
                </select><br>

                <label class="block mb-2">Email:</label>
                <select name="email" id="email" required class="block w-full p-2 mb-4 border border-gray-300 rounded">
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['email']; ?>"><?php echo $user['email']; ?></option>
                    <?php endforeach; ?>
                </select><br>

                <label class="block mb-2">Phone:</label>
                <select name="phone" id="phone" required class="block w-full p-2 mb-4 border border-gray-300 rounded">
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['phone']; ?>"><?php echo $user['phone']; ?></option>
                    <?php endforeach; ?>
                </select><br>

                <label class="block mb-2">Message:</label>
                <textarea name="message" id="message" required class="block w-full p-2 mb-4 border border-gray-300 rounded"></textarea><br>

                <label class="block mb-2">advertisementId:</label>
                <select name="advertisementId" required class="block w-full p-2 mb-4 border border-gray-300 rounded">
                    <?php foreach ($ads as $ad): ?>
                        <option value="<?php echo $ad['id']; ?>"><?php echo $ad['title']; ?></option>
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