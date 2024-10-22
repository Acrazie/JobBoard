<?php
session_start();
include '../php/db.php';
include '../php/auth.php';

if (!is_admin()) {
  die('not admin');
}

function readall($conn)
{
  $sql = "SELECT id, name, first_name, email, phone, job_title, profil FROM users";
  $result = $conn->query($sql);

  $users = [];
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $users[] = $row;
    }
    return $users;
  } else {
    return "Aucun utilisateur trouvé.";
  }
}
$users = readall($conn);

function read_all_advertisements($conn)
{
  $sql = "SELECT * FROM advertisements";
  $result = $conn->query($sql);

  $advertisements = [];
  if ($result->num_rows > 0) {
    while ($rowads = $result->fetch_assoc()) {
      $advertisements[] = $rowads;
    }
    return $advertisements;
  } else {
    return "Aucune annonce disponible.";
  }
}
$ads = read_all_advertisements($conn);

function read_all_company($conn)
{
  $sql = "SELECT * FROM companies";
  $result = $conn->query($sql);

  $companies = [];
  if ($result->num_rows > 0) {
    while ($rowcomps = $result->fetch_assoc()) {
      $companies[] = $rowcomps;
    }
    return $companies;
  } else {
    return "Aucune companies gars !";
  }
}
$companies = read_all_company($conn);

function read_all_job_users($conn)
{
  $sql = "SELECT * FROM jobsforusers";
  $result = $conn->query($sql);

  $jobUsers = [];
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $jobUsers[] = $row;
    }
  }
  return ($jobUsers);
}
$jobsforusers = read_all_job_users($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Page</title>
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
  <main>
    <!-- ========================================================================== -->
    <div class="flex flex-col justify-center items-center min-h-screen gap-14">
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-5xl">
        <h1 class="flex justify-center my-4">Users</h1>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-base text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-4">Role</th>
              <th scope="col" class="px-6 py-4">Name</th>
              <th scope="col" class="px-6 py-4">First Name</th>
              <th scope="col" class="px-6 py-4">Email</th>
              <th scope="col" class="px-6 py-4">Phone</th>
              <th scope="col" class="px-6 py-4">Job Title</th>
              <th scope="col" class="px-6 py-4">Edit</th>
              <th scope="col" class="px-6 py-4">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($users)): ?>
              <?php foreach ($users as $user): ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?php echo htmlspecialchars($user['profil']); ?>
                  </th>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($user['name']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($user['first_name']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($user['email']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($user['phone']); ?>
                  </td>
                  <td class="px-6 py-4 text-right">
                    <?php echo htmlspecialchars($user['job_title']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="font-medium text-green-600 dark:text-green-500">Edit</a>

                  </td>
                  <td class="px-6 py-4">
                    <form method="POST" action="../php/crud_user.php" onsubmit="return confirm('Are you sure you want to delete this user?');">
                      <input type="hidden" name="action" value="delete">
                      <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
                      <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="px-6 py-4 text-center">No users found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="flex justify-center py-2 bg-gray-800">
          <a href="./add_user.php" class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-4 rounded flex justify-center">
            Add
          </a>
        </div>
      </div>
      <!-- ========================================================================== -->
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-8xl">
        <h1 class="flex justify-center my-4">Advertisements</h1>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-base text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-4">Title</th>
              <th scope="col" class="px-6 py-4">Salaries</th>
              <th scope="col" class="px-6 py-4">Location</th>
              <th scope="col" class="px-6 py-4">Working hours</th>
              <th scope="col" class="px-6 py-4">Status</th>
              <th scope="col" class="px-6 py-4">Type</th>
              <th scope="col" class="px-6 py-4">Email</th>
              <th scope="col" class="px-6 py-4">Date</th>
              <th scope="col" class="px-6 py-4">Company Id</th>
              <th scope="col" class="px-6 py-4">Edit</th>
              <th scope="col" class="px-6 py-4">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($ads)): ?>
              <?php foreach ($ads as $ad): ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?php echo htmlspecialchars($ad['title']); ?>
                  </th>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($ad['salaries']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($ad['location']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($ad['working_hours']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($ad['status']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($ad['type']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($ad['email']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($ad['date']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($ad['company_id']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <a href="edit_ad.php?id=<?php echo $ad['id']; ?>" class="font-medium text-green-600 dark:text-green-500">Edit</a>

                  </td>
                  <td class="px-6 py-4">
                    <form method="POST" action="../php/crud_advertisement.php" onsubmit="return confirm('Are you sure you want to delete this ad?');">
                      <input type="hidden" name="action" value="delete">
                      <input type="hidden" name="id" value="<?php echo $ad['id']; ?>">
                      <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="px-6 py-4 text-center">No users found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="flex justify-center py-2 bg-gray-800">
          <a href="./add_company.php" class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-4 rounded flex justify-center">
            Add
          </a>
        </div>
      </div>
      <!-- ========================================================================== -->
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-8xl">
        <h1 class="flex justify-center my-4">Companies</h1>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-base text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-4">Id</th>
              <th scope="col" class="px-6 py-4">Name</th>
              <th scope="col" class="px-6 py-4">Siren</th>
              <th scope="col" class="px-6 py-4">Edit</th>
              <th scope="col" class="px-6 py-4">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($companies)): ?>
              <?php foreach ($companies as $company): ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?php echo htmlspecialchars($company['id']); ?>
                  </th>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($company['name']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($company['sirene']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <a href="edit_company.php?id=<?php echo $company['id']; ?>" class="font-medium text-green-600 dark:text-green-500">Edit</a>

                  </td>
                  <td class="px-6 py-4">
                    <form method="POST" action="../php/crud_company.php" onsubmit="return confirm('Are you sure you want to delete this company?');">
                      <input type="hidden" name="action" value="delete">
                      <input type="hidden" name="id" value="<?php echo $company['id']; ?>">
                      <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="px-6 py-4 text-center">No companies found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="flex justify-center py-2 bg-gray-800">
          <a href="./add_ad.php" class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-4 rounded flex justify-center">
            Add
          </a>
        </div>
      </div>
      <!-- ========================================================================== -->
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-8xl">
        <h1 class="flex justify-center my-4">JobForUsers</h1>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-base text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-4">Id</th>
              <th scope="col" class="px-6 py-4">User Id</th>
              <th scope="col" class="px-6 py-4">Name</th>
              <th scope="col" class="px-6 py-4">Email</th>
              <th scope="col" class="px-6 py-4">Phone</th>
              <th scope="col" class="px-6 py-4">Message</th>
              <th scope="col" class="px-6 py-4">Advertisement Id</th>
              <th scope="col" class="px-6 py-4">Edit</th>
              <th scope="col" class="px-6 py-4">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($jobsforusers)): ?>
              <?php foreach ($jobsforusers as $jobsforuser): ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?php echo htmlspecialchars($jobsforuser['id']); ?>
                  </th>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($jobsforuser['userId']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($jobsforuser['name']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($jobsforuser['email']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($jobsforuser['phone']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($jobsforuser['message']); ?>
                  </td>

                  <td class="px-6 py-4">
                    <?php echo htmlspecialchars($jobsforuser['advertisementId']); ?>
                  </td>
                  <td class="px-6 py-4">
                    <a href="edit_jobsforuser.php?id=<?php echo $jobsforuser['id']; ?>" class="font-medium text-green-600 dark:text-green-500">Edit</a>

                  </td>
                  <td class="px-6 py-4">
                    <form method="POST" action="../php/crud_jobs_for_users.php" onsubmit="return confirm('Are you sure you want to delete this company?');">
                      <input type="hidden" name="action" value="delete">
                      <input type="hidden" name="id" value="<?php echo $jobsforuser['id']; ?>">
                      <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="px-6 py-4 text-center">No companies found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="flex justify-center py-2 bg-gray-800">
          <a href="./add_jobsforuser.php" class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-4 rounded flex justify-center">
            Add
          </a>
        </div>
      </div>
    </div>
  </main>
  <script src="./OpenMenuNavbar.js"></script>

</body>

</html>