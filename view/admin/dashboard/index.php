<?php

include "../../../settings/core.php";

check_session();

if ($_SESSION['role_id'] == 3) {
  header("Location: ../../dashboard");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Chore Management System</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="../../../assets/css/styles.css" rel="stylesheet" />
  <link href="../../../assets/css/output.css" rel="stylesheet" />
</head>

<body>
  <div class="flex">
    <!-- Side navigation -->
    <div class="text-center w-1/6 py-4 px-5">
      <a href="/" class="font-semibold text-2xl">ChoreFlow</a>
      <div class="flex flex-col h-[89vh] justify-between">
        <div class="flex flex-col grow mt-8">
          <a href="./" class="py-2 bg-gray-50 mb-2 rounded">Home</a>
          <a href="../add-chore/" class="py-2 bg-gray-50 mb-2 rounded">Add Chore</a>
          <a href="../assign-chore/" class="py-2 bg-gray-50 mb-2 rounded">Assign Chore</a>
        </div>
        <a class="bg-blue-200 px-5 py-1 rounded-md" href="../../../logout">Logout</a>
      </div>
    </div>

    <!-- Dashboard -->
    <div class="grow">
      <div class="flex py-6 px-6 border-b-4 border-l-4 border-blue-500 rounded items-center justify-between">
        <div>
          <h1 class="font-semibold text-4xl text-left">Dashboard</h1>
          <p class="font-semibold text-red-700">Admin</p>
        </div>
        <?php
        echo "<p>" . $_SESSION['username'] . "</p>";
        ?>
      </div>
      <main class="bg-gray-100 h-[89vh] px-8">
        <h2 class="py-10 font-semibold text-gray-900 text-3xl">Tasks</h2>
        <div class="flex justify-around">
          <a href="../add-chore/" class="px-5 gap-y-8 pt-5 pb-3 rounded-lg drop-shadow-md bg-white w-1/5 flex flex-col justify-between">
            <div class="flex items-center">
              <div class="w-[12px] h-[12px] rounded-xl bg-purple-400 mr-3"></div>
              All Chores
            </div>

            <div class="font-bold text-2xl">
              <?php
              include './../../../settings/connection.php';

              $sql = "SELECT count(*) as value FROM Chores";
              $result = $conn->query($sql)->fetch_assoc();

              echo $result['value'];
              ?>
            </div>
          </a>
          <a href="../add-chore/" class="px-5 gap-y-8 pt-5 pb-3 rounded-lg drop-shadow-md bg-white w-1/5 flex flex-col justify-between">
            <div class="flex items-center">
              <div class="w-[12px] h-[12px] rounded-xl bg-yellow-400 mr-3"></div>
              In Progress
            </div>
            <div class="font-bold text-2xl">
              <?php
              include './../../../settings/connection.php';

              $sql = "SELECT count(*) as value FROM Assignment WHERE sid=2";
              $result = $conn->query($sql)->fetch_assoc();

              echo $result['value'];
              ?>
            </div>
          </a>
          <a href="../add-chore/" class="px-5 gap-y-8 pt-5 pb-3 rounded-lg drop-shadow-md bg-white w-1/5 flex flex-col justify-between">
            <div class="flex items-center">
              <div class="w-[12px] h-[12px] rounded-xl bg-red-600 mr-3"></div>
              Incomplete
            </div>
            <div class="font-bold text-2xl">
              <?php
              include './../../../settings/connection.php';

              $sql = "SELECT count(*) as value FROM Assignment WHERE sid=4";
              $result = $conn->query($sql)->fetch_assoc();

              echo $result['value'];
              ?>
            </div>
          </a>
          <a href="../add-chore/" class="px-5 gap-y-8 pt-5 pb-3 rounded-lg drop-shadow-md bg-white w-1/5 flex flex-col justify-between">
            <div class="flex items-center">
              <div class="w-[12px] h-[12px] rounded-xl bg-green-600 mr-3"></div>
              Completed
            </div>
            <div class="font-bold text-2xl">
              <?php
              include './../../../settings/connection.php';

              $sql = "SELECT count(*) as value FROM Assignment WHERE sid=3";
              $result = $conn->query($sql)->fetch_assoc();

              echo $result['value'];
              ?>
            </div>
          </a>
        </div>

        <!-- Assigned Tasks -->
        <h2 class="py-10 font-semibold text-gray-900 text-3xl">
          Completed Chores
        </h2>

        <div class=" table w-full">
          <div class="table-header-group">
            <div class="table-row">
              <div class="table-cell bg-gray-300 py-2 pl-3">Chore name</div>
              <div class="table-cell bg-gray-300 py-2 pl-3">Assigned by</div>
              <div class="table-cell bg-gray-300 py-2 pl-3">Date Assigned</div>
              <div class="table-cell bg-gray-300 py-2 pl-3">Date Completed</div>
              <div class="table-cell bg-gray-300 py-2 pl-3">Details</div>
            </div>
          </div>
          <?php
          include "../../../settings/connection.php";
          $sql = "SELECT chorename, who_assigned, date_assign, date_completed FROM Assignment INNER JOIN Chores where Chores.cid = Assignment.cid";
          $result = $conn->query($sql);

          foreach ($result as $row) {
            $chorename = $row['chorename'];
            $who_assigned = $row['who_assigned'];
            $date_assign = $row['date_assign'];
            $date_completed = $row['date_completed'];
            echo "<div class='table-row-group'>
            <div class='table-row'>
              <div class='table-cell border py-2 pl-3'>$chorename</div>
              <div class='table-cell border py-2 pl-3'>$who_assigned</div>
              <div class='table-cell border py-2 pl-3'>$date_assign</div>
              <div class='table-cell border py-2 pl-3'>$date_completed</div>
              <div class='table-cell border py-2 pl-3'>Do something</div>
            </div>
          </div>";
          }
          ?>
        </div>
      </main>
    </div>
  </div>
</body>

</html>
