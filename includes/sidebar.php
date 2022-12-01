<?php 
    require_once("includes/config.php");
    $query = "SELECT * FROM Films ORDER BY RAND() LIMIT 1";
    $result = $mysqli->query($query);
    $obj = $result->fetch_object();
?>
<div class="sideBar">
    <h3><?php echo "<h3><a href=\"film-details.php?filmID={$obj->filmID}\">{$obj->filmTitle}</a></h3>"; ?></h3>
    <div><?php echo "<img src=\"images/{$obj->filmImage}\" alt=\"{$obj->filmTitle}\" />" ?></div>
    <p><?php echo "{$obj->filmDescription}"; ?></p>
</div>