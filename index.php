<?php

include('config/db_connect.php');

$query = "SELECT * FROM salon ORDER BY name ASC";
$result = mysqli_query($conn, $query);
$salons = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div class="container">
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

</html>