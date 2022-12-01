<?php
require_once('includes/config.php');
$queryFilms = "SELECT * FROM Films ORDER BY releaseDate DESC LIMIT 0,4";
$resultFilms = $mysqli->query($queryFilms);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome to SHU Films</title>
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
        <h2>Banner</h2>
      </div>
      <section class="homePage">
        <!-- Featured Films Here -->
        <?php
        while ($obj = $resultFilms->fetch_object()) {
          echo "<div>";
          echo "<div>";
          echo "<img src=\"images/{$obj->filmImage}\" alt=\"{$obj->filmTitle}\">";
          echo "</div>";
          echo "<h3><a href=\"film-details.php?filmID={$obj->filmID}\">{$obj->filmTitle}</a></h3>";
          echo "</div>";
        }
        ?>
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