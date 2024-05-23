<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="estilo_administrador.css" media="screen" />

    <style>
        .nav-pills .nav-link {
            color: white;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }

        .nav-pills .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.7);
            color: white;
        }

        .nav-pills .active {
            background-color: rgba(144, 238, 144, 0.7) !important;
        }

        header {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-danger {
            margin-left: 20px;
        }
    </style>
</head>

<body>

    <header class="d-flex align-items-center py-3 bg-success">
        <div class="d-flex justify-content-center align-items-center flex-grow-1">
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="http://localhost/ConnectingIFES%202.0/app/views/administrador/usuario/UsuarioREAD.php" class="nav-link" aria-current="page">Usuários</a></li>
                <li class="nav-item"><a href="http://localhost/ConnectingIFES%202.0/app/views/administrador/grupo/GrupoREAD.php" class="nav-link" aria-current="page">Grupos</a></li>
            </ul>
        </div>
        <form class="nav navbar-nav navbar-right" method="POST">
            <button type="submit" class="btn btn-danger" name="sair">Sair</button>
        </form>
    </header>

</body>

</html>