<?php
session_start();
include "../php/auth.php";
include '../php/db.php';


if (isset($_GET['id'])) {
    global $userId;
    $userId = $_GET['id'];
} else {
    die('User Id not provided');
}

function read_user($userId, $conn)
{
    $sql = "SELECT * FROM users WHERE id=$userId";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        return "Aucun utilisateur trouvé avec l'ID fourni.";
    } else {
        $user = $result->fetch_assoc();
        return $user;
    }
}
$user = read_user($userId, $conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <nav class="bg-white border-gray-200 dark:bg-gray-900 mx-40 rounded-lg">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a class="flex items-center space-x-3 rtl:space-x-reverse" href="index.php">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">JobBoard</span>
            </a>
            <button
                id="navbar-toggle"
                data-collapse-toggle="navbar-default"
                type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default"
                aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <?php if (isset($_SESSION['profil']) && $_SESSION['profil'] === 'admin') { ?>
                        <li>
                            <a href="./AdminPage.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-gray-400 md:p-0 dark:text-white md:dark:hover:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Admin</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="AccountPage.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-gray-400 md:p-0 dark:text-white md:dark:hover:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Account</a>
                    </li>
                    <?php if (isset($_SESSION['profil']) && $_SESSION['profil'] !== '') { ?>
                        <li>
                            <a href="../php/auth.php?action=logout" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-gray-400 md:p-0 dark:text-white md:dark:hover:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Logout</a>
                        </li>
                    <?php } ?>
                    <?php if (isset($_SESSION['profil']) && isset($_SESSION['id'])) { ?>
                        <li>
                            <a href="./ProfilPage.php?id=<?php echo $_SESSION['id']; ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-gray-400 md:p-0 dark:text-white md:dark:hover:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Profil Page</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="w-full h-screen flex justify-center items-center">
        <div class="bg-white overflow-hidden shadow rounded-lg border max-w-4xl flex justify-center flex-col">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    User Profile
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    This is some information about the user.
                </p>
            </div>
            <form method="POST" action="../php/crud_user.php" class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
                        <dt class="text-sm font-medium text-gray-500 flex justify-start items-center">
                            Name:
                        </dt>
                        <input type="text" name="name" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 block w-full p-1 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['name']); ?>">
                        </input>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 flex justify-start items-center">
                            First Name:
                        </dt>
                        <input type="text" name="first_name" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 block w-full p-1 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['first_name']); ?>">
                        </input>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 flex justify-start items-center">
                            Email:
                        </dt>
                        <input type="email" name="email" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 block w-full p-1 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['email']); ?>">
                        </input>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 flex justify-start items-center">
                            Phone number
                        </dt>
                        <input type="number" name="phone" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 block w-full p-1 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['phone']); ?>">
                        </input>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 flex justify-start items-center">
                            Password
                        </dt>
                        <input type="password" name="password" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 block w-full p-1 border border-gray-300 rounded" placeholder="Leave blank to keep current password">
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 flex justify-start items-center">
                            Job Title
                        </dt>
                        <input type="text" name="job_title" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 block w-full p-1 border border-gray-300 rounded" value="<?php echo htmlspecialchars($user['job_title']); ?>">
                        </input>
                    </div>
                    <div>
                        <input type="hidden" name="profil" value="<?php echo $user['profil']; ?>">
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 flex justify-start items-center">
                            Submit:
                        </dt>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">Update</button>
                        <a href="./index.php" class="bg-gray-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded">Cancel</a>
                    </div>
                </dl>
            </form>
        </div>

    </main>
    <script src="./OpenMenuNavbar.js"></script>

</body>

</html>