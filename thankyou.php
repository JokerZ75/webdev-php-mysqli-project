<?php
require_once("includes/config.php");
$validQuery = true;
$additionalData = "";
foreach ($_POST as $key => $value) {
  if (is_null($value) || empty($value)) {
    $validQuery = false;
  } else {
    $additionalData = $additionalData . "'$value',";
  }
}
if ($validQuery) {
  $email = "{$_POST['Email']}";
  $query = "SELECT * FROM Contacts WHERE Email = ?";
  $stmt = $mysqli->prepare($query);
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows == 0) {
    $additionalData = substr($additionalData, 0, -1);
    // $mysqli->query("INSERT INTO Contacts (Firstname,Surname,Email,Tele,HearFrom) VALUES ({$additionalData});");
    $stmt = $mysqli->prepare("INSERT INTO Contacts (Firstname,Surname,Email,Tele,HearFrom) VALUES ( {$additionalData} )");
    // $stmt->bind_param('s',$additionalData);
    $stmt->execute();
    $result = $stmt->get_result();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Thank You</title>
  <link rel="stylesheet" href="css/mobile.css" />
  <link rel="stylesheet" href="css/desktop.css" media="only screen and (min-width : 720px)" />
</head>

<body>
  <?php
  include("includes/header.php");
  ?>
  <div class="mainContainer">
    <main>
      <div class="banner">
        <h2>Thank You</h2>
      </div>
      <section class="twoColumn">
        <?php
        echo "<table>";
        foreach ($_POST as $key => $value) {
          echo "<tr>";
          echo "<td class = \"uc\">";
          echo $key;
          echo "</td>";
          echo "<td>";
          echo $value;
          echo "</td>";
          echo "</tr>";
        }
        echo "</table>";
        ?>
        <?php include("includes/sidebar.php"); ?>
      </section>
    </main>
  </div>
  <?php
  // add Footer
  include("includes/footer.php");
  ?>
  <script src="js/main.js"></script>
</body>

</html>