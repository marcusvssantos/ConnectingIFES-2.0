<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/33da7e24d8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="http://localhost/ConnectingIFES%202.0/app/views/administrador/estilo_administrador.css" media="screen" />


</head>

<body>

    <nav class="sidebar">
        <ul>
            <li>
                <a href="http://localhost/ConnectingIFES%202.0/app/views/administrador/usuario/UsuarioREAD.php" class="nav-link" aria-current="page">
                    <i class="fa fa-solid fa-users"></i>
                    <span class="nav-text">
                        Usuarios
                    </span>
                </a>
            </li>

            <li>
                <a href="http://localhost/ConnectingIFES%202.0/app/views/administrador/grupo/GrupoREAD.php">
                    <i class="fa fa-solid fa-group-arrows-rotate"></i>
                    <span class="nav-text">
                        Grupos
                    </span>
                </a>
            </li>


        </ul>
        <ul class="logout">
            <li>
                <a>
                    <form class="nav navbar-nav navbar-right" method="POST">
                        <button type="submit" class="btn btn-secondary" name="sair" id="btn-sair">
                            <i class="bi bi-power bi-2x"></i>
                            <span class="nav-text">
                                Sair
                            </span>
                        </button>
                    </form>

            </li>
        </ul>

    </nav>



</body>

</html>