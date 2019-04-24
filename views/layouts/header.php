<html lang="en">
<head>
    <title>Multiversum</title>
    <link rel="icon" href="/views/images/mvm.png">
    <link rel="stylesheet" href="/views/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif !important;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body class="bg-white">
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white bg-3 shadow-sm">
        <a class="navbar-brand" href="/"><img src="/views/images/mvm.png" alt="Logo" width="80"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active mr-5">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item mr-5">
                    <a class="nav-link" href="/producten">Producten</a>
                </li>
                <li class="nav-item mr-5">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>
                <?php
                if (isset($_SESSION['auth'])) {
                    echo '
                <li class="nav-item dropdown mr-5">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    ';
                    if (isset($_SESSION['role'])) {
                        echo $_SESSION['role'] >= 5 ? '<a class="dropdown-item" href="/admin/dashboard">Admin Dashboard</a>                        <div class="dropdown-divider"></div>
' : '';
                    }
                    echo '
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); $(`#logout`).submit()">Afmelden</a>
                    </div>
                </li>
                <form action="/afmelden" method="POST" id="logout"></form>
                ';
                } else {
//                    echo '<li class="nav-item mr-5">
//                    <a class="nav-link" href="/inloggen">Inloggen</a>
//                </li>
//                <li class="nav-item mr-5">
//                    <a class="nav-link" href="/registreren">Registreren</a>
//                </li>
//                ';
                }
                ?>
                <li class="nav-item mr-5 pt-1">
                    <a href="/winkelmand" class="nav-link"><i class="fas fa-shopping-basket"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="/search" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Zoeken" name="search" aria-label="Zoeken..." required>
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Zoeken</button>
            </form>
        </div>
    </nav>
</header>