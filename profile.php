<?php

include('config/db_connect.php');

if (isset($_GET['id'])) {
    $userid = mysqli_real_escape_string($conn, $_GET['id']);
}

$query = "SELECT * FROM salon WHERE userid='$userid'";
$result = mysqli_query($conn, $query);
$salons = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<?php if ($userid != $loggedId) : ?>

    <h1 class="center">You have no permission to view this profile!</h1>
    <div class="center">
        <a href="index.php" class="btn center brown darken-2">Return</a>
    </div>

<?php elseif ($salons != null) : ?>
    <head>
        <style>
        .italic {
        font-style: italic;
        }
        </style>
    </head>
    <div class="container">
        <h2 class="center italic">Saloni koje ste postavili</h2>
        <div class="column">
            <?php foreach ($salons as $salon) : ?>
                <div class="col s12 m6 l4 xl3">
                    <div class="card z-depth-0 radius-card">
                        <img src="photo/hair.png" alt="icon" class="icon-card">
                        <div class="card-content center">
                            <h5><?php echo htmlspecialchars($salon['name']); ?></h5>
                        </div>
                        <div class="card-action right-align radius-card">
                            <a href="salon.php?id=<?php echo $salon['id']; ?>" class="brown-text text-darken-2">
                            <em>Saznajte malo više o salonu...</em>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php else : ?>

    <h1 class="center">Niste postavili nijedan salon!</h1>
    <div class="center">
        <a href="add.php" class="btn center brown darken-2">Add one</a>
    </div>

<?php endif; ?>



</html>