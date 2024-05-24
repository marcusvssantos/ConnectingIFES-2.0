<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connecting IFES</title>
    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/ConnectingIFES%202.0/public/img/Logo ConnectingIFES.png">
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        img {
            display: block;
            margin: 0 auto 20px;
            width: 150px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="email"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .images-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .images-container img {
            max-width: 50%;
            height: auto;
        }

        /* Novos estilos para os links .nav-link */
        .nav-link {
            display: block;
            text-align: left;
            color: #000;
            font-size: 18px;
            padding: 10px 0;
            text-decoration: none;
            transition: color 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.5;
            font-weight: bold;
            font-style: italic;
            vertical-align: middle;
        }

        .nav-link:hover {
            color: #0056b3;
        }
    </style>

</head>

<body>
    <div class="login-container">
        <div class="images-container"> <!-- Div envolvente adicionada aqui -->
            <img src="http://localhost/ConnectingIFES%202.0/public/img/logoIFES.svg">
            <img src="http://localhost/ConnectingIFES%202.0//public/img/Logo ConnectingIFES.png">
        </div>
        <form method="POST" action="../app/controllers/login/ProcessarLogin.php" id="formlogin" name="formlogin">
            <a href="http://localhost/ConnectingIFES%202.0/app/views/administrador/index.php" class="nav-link" aria-current="page"><i class="bi bi-person-fill-gear"></i> Administrador</a>
            <a href="http://localhost/ConnectingIFES%202.0/app/views/aluno/index.php" class="nav-link" aria-current="page"><i class="bi bi-person-vcard-fill"></i> Aluno</a>
            <a href="http://localhost/ConnectingIFES%202.0/app/views/professor/index.php" class="nav-link" aria-current="page"><i class="bi bi-person-lines-fill"></i> Professor</a>
        </form>
    </div>
</body>

</html>

<?php
unset($_SESSION['erro']);
?>