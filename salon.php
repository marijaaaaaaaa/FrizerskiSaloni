<?php

include('config/db_connect.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // uzimamo salon iz baze
    $query = "SELECT * FROM salon WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $salon = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    $userid = $salon['userid'];

    // uzimamo korisnika koji je postavio 
    $query = "SELECT * FROM user WHERE id = $userid";
    $result = mysqli_query($conn, $query);
    $creator = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
}

if (isset($_POST['delete'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);

    $query = "DELETE FROM salon WHERE id = $id AND userid = $userid";
    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<?php if ($salon == null) : ?>
    <h1 class="center">There is no such salon!</h1>
    <div class="center">
        <a href="index.php" class="btn center brown darken-2">Return</a>
    </div>

<?php else : ?>
    <div class="container center">
        <div class="card z-depth-0 radius-card" style="padding-bottom: 30px;">
            <img src="photo/hair.png" alt="icon" class="icon-card">
            <h3><?php echo htmlspecialchars($salon['name']); ?></h3>
            <h5><?php echo htmlspecialchars($salon['type']); ?></h5>
            <h5><?php echo htmlspecialchars($salon['address']) .
                    ', ' . htmlspecialchars($salon['city']); ?></h5>

            <?php if ($userid == $loggedId) { ?>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" style="padding-top:20px">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                    <input type="submit" name="delete" value="delete" class="btn center brown darken-2">
                </form>

            <?php } else { ?>

                <h6>Postavio/la: <?php echo $creator['username']; ?></h6>

            <?php }; ?>


        </div>
    </div>

<?php endif; ?>


</html>