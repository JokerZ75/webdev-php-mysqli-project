<?php
require_once("includes/config.php");
// query to get film by filmID
$getFilmID = $_GET[ 'filmID' ] ?? null;
$stmt = $mysqli->prepare("SELECT * FROM Films WHERE filmID = ?");
$stmt->bind_param('i', $getFilmID);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows <= 0){
  header("Location: catalogue.php");
}
$obj = $result->fetch_object();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> <?php
          echo "{$obj->filmTitle}";
          ?></title>
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
        <h2>
          <?php
          echo "{$obj->filmTitle}";
          ?>
        </h2>
      </div>
      <section class="twoColumn">
        <div>
          <?php
          echo "<div class=\"filmDetails\">";
          echo "<div>";
          echo "<img src=\"images/{$obj->filmImage}\" alt=\"{$obj->filmTitle}\">";
          echo "</div>";
          echo "<div>";
          echo "<p>{$obj->filmDescription}</p>";
          echo "<p>{$obj->filmCertificate}</p>";
          echo "</div>";
          echo "</div>";
          ?>
        </div>
        <div class="sideBar">
          <h3>Featured Film</h3>
          <div> <img src="images/babadook.jpg" alt="Babadook" /> </div>
          <p>Info Here</p>
        </div>
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