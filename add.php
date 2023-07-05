<?php
include('config/db_connect.php');
include('models/Salon.php');

$name = $city = $type = $address = '';

$errors = [
    'name' => '', 'city' => '', 'type' => '',
    'address' => ''
];

if (isset($_POST['add'])) {

    if (empty($_POST['name'])) {
        $errors['name'] = 'Name is required!';
    } else {
        $name = $_POST['name'];
    }

    if (empty($_POST['city'])) {
        $errors['city'] = 'City is required!';
    } else {
        $city = $_POST['city'];
    }

    if (empty($_POST['type'])) {
        $errors['type'] = 'Type of salon is required!';
    } else {
        $type = $_POST['type'];
    }

    if (empty($_POST['address'])) {
        $errors['address'] = 'Address is required!';
    } else {
        $address = $_POST['address'];
    }

    if (!array_filter($errors)) {
        $name = $_POST['name'];
        $city = $_POST['city'];
        $type = $_POST['type'];
        $address = $_POST['address'];
        $userid = $_POST['userid'];

        $newSalon = new Salon(
            null,
            $userid,
            $name,
            $city,
            $type,
            $address,
        );

        $newSalon->createSalon();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

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
        flex-basis: 100%; 
    }

    .form {
        max-width: 100%;
    }


  </style>
</head>
    <h4 class="center italic"></h4>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="white form" method="POST">
        <label for="name"><em>Ime salona</em></label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
        <div class="red-text"><?php echo $errors['name']; ?></div>

        <label for="city"><em>Grad</em></label>
        <input type="text" name="city" value="<?php echo htmlspecialchars($city) ?>" onkeyup="suggestCity(this.value)">
        <div class="red-text"><?php echo $errors['city']; ?></div>
        <p><span id="citySuggest"></span></p>

        <label for="type"><em>Tip salona</em></label>
        <input type="text" name="type" value="<?php echo htmlspecialchars($type) ?>" onkeyup="suggestType(this.value)">
        <div class="red-text"><?php echo $errors['type']; ?></div>
        <p><span id="typeSuggest"></span></p>

        <label for="address"><em>Adresa</em></label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($address) ?>">
        <div class="red-text"><?php echo $errors['address']; ?></div>

        <input type="hidden" name="userid" value="<?php echo $loggedId; ?>">

        <div class="center">
            <input type="submit" name="add" value="Postavite salon" class="btn brown darken-2 z-depth-0">
        </div>
    </form>

</section>


<script>
    function suggestCity(str = "") {
        if (str.length == 0) {
            document.getElementById("citySuggest").innerHTML = "";
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("citySuggest").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/cities.php?query=" + str, true);
            xmlhttp.send();
        }
    }
</script>

<script>
    function suggestType(str = "") {
        if (str.length == 0) {
            document.getElementById("typeSuggest").innerHTML = "";
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("typeSuggest").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/types.php?query=" + str, true);
            xmlhttp.send();
        }
    }
</script>

</html>