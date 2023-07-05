<?php

include('config/session.php');

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: login.php');
}

?>

<head>
    <title>Frizerski saloni</title>
    <link rel="icon" href="photo/hair.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .title-text {
            font-size: xx-large;
            font-style: italic;
            font-family: sans-serif;
        }

        .nav-text {
            font-size: small;
            font-weight: 500;
            font-style: italic;
            font-family: sans-serif;
        }

        .icon-card {
            width: 100px;
            margin: 40px auto -30px;
            display: block;
            position: relative;
            top: -30px;
        }

        .radius-card {
            border-radius: 0px;
        }

        .form {
            padding: 50px;
            margin-left: 25%;
            width: 50%;
            text-align: left;
            border-radius: 0px;
        }
    </style>
</head>

<body class="red lighten-4">
    <nav class="red darken-3">
        <div class="container">
            <a href="index.php" class="title-text">Frizerski saloni</a>

            <?php if ($loggedId != 0) : ?>
                <ul class="right hide-on-small-and-down navul">
                    <li>
                        <a href="profile.php?id=<?php echo $loggedId ?>" class="btn brown darken-3 white-text nav-text z-depth-0">
                            Vaš profil
                        </a>
                    </li>
                    <li>
                        <a href="add.php" class="btn brown darken-3 white-text nav-text z-depth-0">
                            Dodajte frizerski salon
                        </a>
                    </li>
                    <li style="padding-left:15px;">
                        <form action="" method="POST">
                            <input type="submit" name="logout" value="Odjavite se" class="btn brown darken-3 white-text nav-text z-depth-0">
                        </form>
                    </li>
                </ul>
            <?php else : ?>
                <ul class="right hide-on-small-and-down navul">
                    <li>
                        <a href="registration.php" class="btn brown darken-3 white-text nav-text z-depth-0">
                            Registruj se
                        </a>
                    </li>
                    <li>
                        <a href="login.php" class="btn brown darken-3 white-text nav-text z-depth-0">
                            Prijavi se
                        </a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </nav>
</body>