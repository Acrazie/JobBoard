<?php
session_start();
include '../php/db.php';
include "../php/auth.php";

if (isset($_GET['id'])) {
  $ad_id = intval($_GET['id']);

  $stmt = $conn->prepare("SELECT id, title, description, salaries, location, date, type, email, working_hours FROM advertisements WHERE id = ?");
  $stmt->bind_param("i", $ad_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $ad = $result->fetch_assoc();
  } else {
    echo "No advertisement found.";
    exit;
  }

  $allAdsResult = $conn->prepare("SELECT userId, name, email, phone, message FROM jobsforusers WHERE advertisementId = ?");
  $allAdsResult->bind_param("i", $ad_id);
  $allAdsResult->execute();
  $candidatesResult = $allAdsResult->get_result();
} else {
  echo "No advertisement selected.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($ad['title']); ?> - Job Advertisement</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body class="bg-gray-100">
  <div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <div class="flex justify-between items-center mb-6">
      <a href="index.php" class="text-gray-500 hover:text-black">
        <i class="fas fa-arrow-left text-2xl"></i>
      </a>
      <div class="flex space-x-4">
        <a href="#" class="text-gray-500 hover:text-red-500">
          <i class="far fa-heart text-2xl"></i>
        </a>
        <a href="#" class="text-gray-500 hover:text-yellow-500">
          <i class="far fa-bell text-2xl"></i>
        </a>
      </div>
    </div>

    <div class="flex justify-between">
      <div class="w-2/3">
        <h1 class="text-3xl font-bold text-purple-600 mb-2">
          <?php echo htmlspecialchars($ad['title']); ?> - <?php echo htmlspecialchars($ad['location']); ?>
        </h1>

        <h2 class="text-xl font-semibold mb-4">Job's missions</h2>
        <p class="text-gray-700 leading-relaxed mb-4"><?php echo nl2br(htmlspecialchars($ad['description'])); ?></p>

        <h2 class="text-xl font-semibold mb-4">Salaries</h2>
        <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($ad['salaries']); ?></p>
        <p class="text-gray-600 text-lg mb-6">Published on : <?php echo htmlspecialchars($ad['date']); ?></p>
      </div>

      <div class="w-1/3 p-6 bg-white rounded-md shadow-lg">
        <h1 class="text-3xl font-bold text-purple-600 mb-2">
          <?php echo htmlspecialchars($ad['title']); ?> - <?php echo htmlspecialchars($ad['location']); ?>
        </h1>

        <h2 class="text-xl font-semibold mb-4">Type of Contract</h2>
        <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($ad['type']); ?></p>

        <a href="mailto:<?php echo htmlspecialchars($ad['email']); ?>">
          <button class="w-full bg-purple-600 text-white font-bold py-2 px-4 rounded hover:bg-purple-700">
            Contact Us: <?php echo htmlspecialchars($ad['email']); ?>
          </button>
        </a>
      </div>
    </div>

    <div class="mt-12 p-6 bg-gray-50 rounded-md">
      <h2 class="text-2xl font-bold mb-4">Send your application now!</h2>
      <form id="applicationForm" action="../php/apply.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="advertisementId" value="<?php echo htmlspecialchars($ad['id']); ?>"> <!-- Remplace '1' par l'ID dynamique de l'annonce -->

        <div class="grid grid-cols-2 gap-4 mb-6">
          <div>
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" value="<?php echo htmlspecialchars($_SESSION['name']); ?>" id="name" name="name" placeholder="Your name" class="w-full p-2 border border-gray-300 rounded-md" required />
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
          <div>
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" placeholder="Your email" class="w-full p-2 border border-gray-300 rounded-md" required />
          </div>
          <div>
            <label for="phone" class="block text-gray-700">Phone</label>
            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($_SESSION['phone']); ?>" placeholder="+33" class="w-full p-2 border border-gray-300 rounded-md" required />
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
          <div>
            <label for="message" class="block text-gray-700">Message</label>
            <textarea id="message" name="message" placeholder="Send your message.." class="w-full p-2 border border-gray-300 rounded-md" required value="<?php echo htmlspecialchars($_SESSION['phone']); ?>"></textarea>
          </div>
        </div>


        <button type="submit" class="w-full bg-purple-600 text-white py-2 px-4 rounded-md font-bold hover:bg-purple-700">
          Apply
        </button>
      </form>
    </div>
  </div>
  <script src="./JobAdvertisements.js"></script>
  <script src="./OpenMenuNavbar.js"></script>

</body>

</html>