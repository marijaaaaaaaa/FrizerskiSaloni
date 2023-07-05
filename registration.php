<?php

include('config/db_connect.php');
include('models/User.php');

$email = $username = $password = $confirmPassword = $nationality =  '';

$errors = [
    'email' => '', 'username' => '', 'password' => '',
    'confirmPassword' => '', 'nationality' => ''
];

if (isset($_POST['registration'])) {

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required!';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email address!';
        }
    }

    if (empty($_POST['username'])) {
        $errors['username'] = 'Username is required!';
    } else {
        $username = $_POST['username'];

        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $userWithSameUsername = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        if ($userWithSameUsername != null) {
            $errors['username'] = "User with username $username already exists!";
        }
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required!';
    } else {
        $password = $_POST['password'];
        if (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters long!';
        }
    }

    if (empty($_POST['confirmPassword'])) {
        $errors['confirmPassword'] = 'Password confirmation is required!';
    } else {
        $confirmPassword = $_POST['confirmPassword'];
        if ($confirmPassword != $password) {
            $errors['confirmPassword'] = 'Passwords do not match!';
            $confirmPassword = '';
            $password = '';
        }
    }

    if (!array_filter($errors)) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nationality = $_POST['nationality'];

        $newUser = new User(null, $email, $username, $password, $nationality);
        $newUser->createUser();
    }
}


?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php') ?>

<section class="container">
<div class="form-container">
<head>
  <style>
    .italic {
      font-style: italic;
    }
    .container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    .form-container {
        width: 100%;
        flex-basis: 70%; 
    }

    .form {
        max-width: 100%;
    }

    .image-container {
        width: 100%;
        flex-basis: 50%;
    }

    .image {
        max-width: 100%;
        height: auto;
    }

  </style>
</head>

    <h4 class="center italic"></h4>

    <!-- FORM -->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="white form" method="POST">
        <label for="email"><em>Email adresa</em></label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>

        <label for="username"><em>Korisničko ime</em></label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
        <div class="red-text"><?php echo $errors['username']; ?></div>

        <label for="password"><em>Lozinka</em></label>
        <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
        <div class="red-text"><?php echo $errors['password']; ?></div>

        <label for="confirmPassword"><em>Potvrdite lozinku</em></label>
        <input type="password" name="confirmPassword" value="<?php echo htmlspecialchars($confirmPassword); ?>">
        <div class="red-text"><?php echo $errors['confirmPassword']; ?></div>

        <label for="nationality"><em>Nacionalnost</em></label>
        <input type="text" name="nationality" value="<?php echo htmlspecialchars($nationality) ?>" onkeyup="suggestNationality(this.value)">
        <div class="red-text"><?php echo $errors['nationality']; ?></div>
        <p><span id="natioanalitySuggest"></span></p>

        <div class="center">
            <input type="submit" name="registration" value="Kreirajte nalog" class="btn brown darken-2 z-depth-0">
        </div>
    </form>
    </div>
    <div class="image-container">
        <img src="photo/salon.jpg" alt="Slika salona" class="image">
    </div>
</section>


<script>
    function suggestNationality(str = "") {
        if (str.length == 0) {
            document.getElementById("natioanalitySuggest").innerHTML = "";
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("natioanalitySuggest").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/countries.php?query=" + str, true);
            xmlhttp.send();
        }
    }
</script>

</html>