<?php
include('config/db_connect.php');

session_unset();

$username = $password = '';
$errors = ['username' => '', 'password' => ''];

if (isset($_POST['login'])) {

    if (empty($_POST['username'])) {
        $errors['username'] = 'Username is required!';
    } else {
        $username = $_POST['username'];

        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        if ($user == null) {
            $errors['username'] = "User with this username does not exist!";
        } elseif (empty($_POST['password'])) {
            $errors['password'] = "Password is required!";
        } else {
            $password = $_POST['password'];

            if (strcmp($password, $user['password'])) {
                $errors['password'] = "Wrong password!";
            } else {

                session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['id'] = $user['id'];

                header('Location: index.php');
            }
        }
    }
}




?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php') ?>


<style>
    .container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    .form-container {
        width: 100%;
         flex-basis: 80%; 
    }

    .form {
        max-width: 100%;
    }

    .image-container {
        width: 75%;
        flex-basis: 30%;
    }

    .image-text {
        text-align: left;
    }
</style>

<section class="container">

    <div class="form-container">
        

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="white form" method="POST">
            <label for="username"><em>Korisničko ime</em></label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>">
            <div class="red-text"><?php echo $errors['username']; ?></div>

            <label for="password"><em>Lozinka</em></label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
            <div class="red-text" style="padding-bottom:10px;"><?php echo $errors['password']; ?></div>

            <div class="center">
                <input type="submit" name="login" value="Prijavi se" class="btn brown darken-2 z-depth-0">
            </div>
        </form>
    </div>

    <div class="image-container">
        <p class="image-text"><em>Ovaj sajt je jedinstven koncept koji okuplja najbolje frizerske salone za Vas. Prijavite se na naš sajt i oplemenite našu zajednicu.</em></p>
    </div>

</section>

</html>
