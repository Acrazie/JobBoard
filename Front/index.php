<?php
include "../php/auth.php";
include '../php/db.php';

function readallads($conn, $job = '', $location = '')
{
  $sql = "SELECT id, title, description, salaries, location, working_hours, status, type, email, date, company_id FROM advertisements WHERE 1";

  if (!empty($job)) {
    $sql .= " AND title LIKE '%" . $conn->real_escape_string($job) . "%'";
  }

  if (!empty($location)) {
    $sql .= " AND location LIKE '%" . $conn->real_escape_string($location) . "%'";
  }

  $result = $conn->query($sql);

  $ads = [];
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $ads[] = $row;
    }
    return $ads;
  } else {
    return [];
  }
}

// Récupération des valeurs soumises par le formulaire
$job = isset($_POST['job']) ? $_POST['job'] : '';
$location = isset($_POST['location']) ? $_POST['location'] : '';

$ads = readallads($conn, $job, $location);
$job = '';
$location = '';
$numcharacters = 100;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JobBoard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="">
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
  <main>
    <div class="mx-40 relative mb-20">
      <div class="w-full h-96">
        <img src="../Assets/Sunrise.jpg" alt="JobBoard" class="rounded-lg h-full w-full object-cover">
      </div>
      <div class="absolute grid grid-cols-12 gap-0 border border-gray-300 rounded-lg bg-white inset-x-0 -bottom-12 w-3/4 left-1/2 transform -translate-x-1/2">
        <form id="searchForm" action="index.php" method="POST" class="col-span-12 grid grid-cols-12 gap-0">
          <div class="col-span-11 grid grid-cols-2 divide-x divide-gray-300 border border-gray-300 rounded-lg">
            <div class="flex flex-col justify-center px-4">
              <input type="text" name="job" class="placeholder:text-slate-400 text-slate-700 text-sm rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:bg-gray-100 hover:bg-gray-100" placeholder="Jobs..." />
            </div>
            <div class="flex flex-col justify-center px-4">
              <input type="text" name="location" class="placeholder:text-slate-400 text-slate-700 text-sm rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:bg-gray-100 hover:bg-gray-100" placeholder="Location" />
            </div>
          </div>
          <div class="col-span-1 flex items-center justify-center">
            <button class="m-3">
              <img src="../Assets/icons8-chercher.svg" alt="Search" class="cursor-pointer transform transition duration-500 hover:scale-75 w-14 h-14">
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="mx-60">
      <div class="flex flex-1 justify-between items-center mb-10">
        <h1 class="text-xl"><span class="font-medium">Number of Jobs Annonces:</span> <?php echo count($ads); ?></h1>
      </div>
      <div class="grid grid-cols-1">
        <ul class="col-span-1 gap-6 mb-6">
          <?php foreach ($ads as $ad) : ?>
            <li class="mb-6">
              <div class="border border-gray-100 hover:border-gray-300 bg-white hover:bg-gray-200 transform transition duration-300 hover:scale-105 flex flex-col rounded-lg p-8 transform transition duration-100 hover:cursor-pointer">
                <div class="my-2 flex">
                  <h1 class="mr-2"><?php echo htmlspecialchars($ad['title']); ?></h1> -
                  <p class="ml-2"><?php echo htmlspecialchars($ad['location']); ?></p>
                </div>
                <div class="my-2">
                  <p><?php echo substr(htmlspecialchars($ad['description']), 0, $numcharacters) . '..'; ?></p>
                </div>
                <div class="flex justify-center mt-8">
                  <button onclick="toggleLearnMore(<?php echo $ad['id']; ?>)" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded mx-2 flex w-1/6 justify-center">
                    Learn more
                  </button>
                  <?php if (isset($_SESSION['profil']) && $_SESSION['profil'] !== '') { ?>
                    <button onclick="window.open('JobAdvertisements.php?id=<?php echo $ad['id']; ?>', '_blank')" class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-4 rounded mx-2">
                      Apply
                    </button>
                  <?php } ?>
                </div>
              </div>
              <div id="details-<?php echo $ad['id']; ?>" class="hidden mt-4 p-4 bg-gray-100 rounded-lg">
                <h2 class="font-bold text-lg">More information</h2>
                <p><?php echo htmlspecialchars($ad['description']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($ad['location']); ?></p>
                <p><strong>Salaries:</strong> <?php echo htmlspecialchars($ad['salaries']); ?></p>
                <p><strong>Working Hours:</strong> <?php echo htmlspecialchars($ad['working_hours']); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($ad['status']); ?></p>
                <p><strong>Type:</strong> <?php echo htmlspecialchars($ad['type']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($ad['email']); ?></p>
                <p><strong>Company Name:</strong> <?php echo htmlspecialchars($ad['company_id']); ?></p>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </main>
  <script src="./LearnMoreAnimation.js"></script>
  <script src="./OpenMenuNavbar.js"></script>
</body>

</html>