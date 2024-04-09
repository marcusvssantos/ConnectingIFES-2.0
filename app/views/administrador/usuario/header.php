<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- JavaScript do Bootstrap (Requer jQuery) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                <li class="nav-item"><a href="UsuarioREAD.php" class="nav-link" aria-current="page">Página Inicial</a></li>
                <li class="nav-item"><a href="UsuarioREAD.php" class="nav-link" aria-current="page">Painel de Usuários</a></li>
                <li class="nav-item"><a href="UsuarioREAD.php" class="nav-link" aria-current="page">Grupos</a></li>
            </ul>
        </div>
        <form class="nav navbar-nav navbar-right" method="POST">
            <button type="submit" class="btn btn-danger" name="sair">Sair</button>
        </form>
    </header>

</body>

</html>