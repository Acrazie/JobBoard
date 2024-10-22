<?php
session_start();
include "../php/auth.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="scriptJSwitchLoginRegister.js"></script>
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
    <div class="flex justify-center items-center min-h-screen">
      <div class="w-4/5 bg-white p-8 rounded-lg mx-auto">
        <h1 class="text-3xl font-bold text-center mb-8">JobBoard</h1>
        <div class="flex justify-center space-x-6 mb-4">
          <a onclick="toggleForms('signup')" class="hover:font-bold">Create Account</a>
          <a onclick="toggleForms('login')" class="hover:font-bold">Log In</a>
        </div>
        <!-- SignUp Form managed with Js -->
        <form
          id="signup-form"
          class="space-y-6"
          method="POST"
          action="../php/register.php">
          <div class="flex space-x-4">
            <div class="w-1/2">
              <label for="name" class="block font-medium">Name</label>
              <input
                type="text"
                name="name"
                placeholder="Name"
                class="w-full border-2 border-gray-300 p-2 rounded-lg mt-1" />
            </div>
            <div class="w-1/2">
              <label for="surname" class="block font-medium">Surname</label>
              <input
                type="text"
                name="first_name"
                placeholder="Surname"
                class="w-full border-2 border-gray-300 p-2 rounded-lg mt-1" />
            </div>
          </div>
          <div class="flex space-x-4">
            <div class="w-1/2">
              <label for="email" class="block font-medium">Email</label>
              <input
                type="email"
                name="email"
                placeholder="example@mail.com"
                class="w-full border-2 border-gray-300 p-2 rounded-lg mt-1" />
            </div>
          </div>
          <div class="flex space-x-4">
            <div class="w-1/2">
              <label for="phone" class="block font-medium">Phone</label>
              <input
                type="tel"
                name="phone"
                placeholder="06xxxxxxxx"
                class="w-full border-2 border-gray-300 p-2 rounded-lg mt-1" />
            </div>

            <div class="w-1/2">
              <label for="password" class="block font-medium">Password</label>
              <input
                type="password"
                name="password"
                placeholder="Your Password"
                class="w-full border-2 border-gray-300 p-2 rounded-lg mt-1" />
            </div>
          </div>
          <div class="w-full mt-4">
            <label for="job-title" class="block font-medium">Job Title</label>
            <input
              type="text"
              name="job_title"
              placeholder="Your Job Title"
              class="w-full border-2 border-gray-300 p-2 rounded-lg mt-1" />
          </div>
          <div>
            <button
              type="submit"
              class="w-full bg-black text-white py-2 rounded-lg font-bold hover:bg-gray-800 transition duration-300">
              Create Account
            </button>
            <!-- Button to change form to login if already registered -->
            <p class="text-center mt-4">
              Already have an account ?
              <button
                onclick="toggleForms('login')"
                class="text-blue-500"
                type="button">
                Log in
              </button>
            </p>
          </div>
        </form>
        <!-- SignUp Form managed with Js -->
        <!-- Login form if the user is already registered -->
        <form
          id="login-form"
          class="hidden space-y-6"
          action="../php/login.php"
          method="POST">
          <div class="flex space-x-4">
            <div class="w-full">
              <label for="login-email" class="block font-medium">Email</label>
              <input
                type="email"
                name="email"
                placeholder="example@mail.com"
                class="w-full border-2 border-gray-300 p-2 rounded-lg mt-1"
                required />
            </div>
          </div>
          <div class="flex space-x-4">
            <div class="w-full">
              <label for="login-password" class="block font-medium">Password</label>
              <input
                type="password"
                name="password"
                placeholder="Your password"
                required
                class="w-full border-2 border-gray-300 p-2 rounded-lg mt-1" />
            </div>
          </div>
          <button
            type="submit"
            class="w-full bg-black text-white py-2 rounded-lg font-bold hover:bg-gray-800 transition duration-300">
            Log In
          </button>
          <p class="text-center mt-4">
            Don't have an account?
            <button
              type="button"
              onclick="toggleForms('signup')"
              class="text-blue-500">
              Create one
            </button>
          </p>
        </form>
        <!-- Login form if the user is already registered -->
      </div>
    </div>
  </main>
  <script src="./OpenMenuNavbar.js"></script>

</body>

</html>