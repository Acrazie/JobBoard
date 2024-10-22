<?php
session_start();
include '../php/db.php';
include "../php/auth.php";

if (isset($_GET['id'])) {
  $ad_id = intval($_GET['id']);

  $stmt = $conn->prepare("SELECT title, description, salaries, location, working_hours FROM advertisements WHERE id = ?");
  $stmt->bind_param("i", $ad_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $ad = $result->fetch_assoc();
  } else {
    echo "No advertisement found.";
    exit;
  }
} else {
  echo "No advertisement selected.";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($ad['title']); ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
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
      </ul>
    </div>
  </div>
</nav>

<body>
  <div class="max-w-4xl mx-auto p-10 mt-10 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-bold text-gray-900 mb-6 border-b-2 border-gray-200 pb-3">
      <?php echo htmlspecialchars($ad['title']); ?>
    </h1>

    <p class="text-gray-700 text-lg leading-relaxed mb-8">
      <?php echo htmlspecialchars($ad['description']); ?>
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-10">
      <div class="bg-gray-50 p-6 rounded-lg shadow-md flex flex-col items-center">
        <h2 class="text-xl font-semibold text-gray-900 mb-2">Salary</h2>
        <p class="text-gray-600 text-lg">
          <?php echo htmlspecialchars($ad['salaries']); ?> $
        </p>
      </div>
      <div class="bg-gray-50 p-6 rounded-lg shadow-md flex flex-col items-center">
        <h2 class="text-xl font-semibold text-gray-900 mb-2">Location</h2>
        <p class="text-gray-600 text-lg">
          <?php echo htmlspecialchars($ad['location']); ?>
        </p>
      </div>
      <div class="bg-gray-50 p-6 rounded-lg shadow-md flex flex-col items-center">
        <h2 class="text-xl font-semibold text-gray-900 mb-2">Working Hours</h2>
        <p class="text-gray-600 text-lg">
          <?php echo htmlspecialchars($ad['working_hours']); ?>
        </p>
      </div>
    </div>

    <div class="flex justify-end">
      <a href="index.php" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-6 rounded-lg">
        Back to Jobs
      </a>
    </div>
  </div>
  <div class="absolute grid grid-cols-12 gap-0 border border-gray-300 rounded-lg bg-white inset-x-0 -bottom-12 w-3/4 left-1/2 transform -translate-x-1/2">
    <div class="col-span-11 grid grid-cols-2 divide-x divide-gray-300 border border-gray-300 rounded-lg">
      <div class="flex flex-col justify-center px-4">
        <input type="text" class="placeholder:text-slate-400 text-slate-700 text-sm rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:bg-gray-100 hover:bg-gray-100" placeholder="Jobs..." />
      </div>
      <div class="flex flex-col justify-center px-4">
        <input type="text" class="placeholder:text-slate-400 text-slate-700 text-sm rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:bg-gray-100 hover:bg-gray-100" placeholder="Location" />
      </div>
    </div>
    <div class="col-span-1 flex items-center justify-center">
      <button class="m-3">
        <img src="../Assets/icons8-chercher.svg" alt="Search" class="cursor-pointer transform transition duration-500 hover:scale-75 w-14 h-14">
      </button>
    </div>
  </div>
</body>

</html>