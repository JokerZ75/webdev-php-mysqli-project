<?php
require_once("includes/config.php");
$validQuery = true;
foreach ($_POST as $key => $value) {
  if (is_null($value) || empty($value)) {
    $validQuery = false;
  }
}
if ($validQuery) {
  $email = "{$_POST['Email']}";
  $query = "SELECT * FROM Contacts WHERE Email = ? OR Tele = ?";
  $stmt = $mysqli->prepare($query);
  $stmt->bind_param('ss', $email, $_POST['Tel']);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows == 0) {
    $stmt = $mysqli->prepare("INSERT INTO Contacts (Firstname,Surname,Email,Tele,HearFrom) VALUES ( ? , ? , ? , ? , ? )");
    $stmt->bind_param('sssss',$_POST['firstname'], $_POST['surname'], $_POST['Email'], $_POST['Tel'], $_POST['marketing']);
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