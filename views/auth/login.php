<?php include $_SERVER["DOCUMENT_ROOT"] . '/views/layouts/header.php' ?>
<div class="container py-5">
    <div class="card shadow-sm border-radius-5">
        <div class="card-header">Inloggen</div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Gebruikersnaam</label>
                    <input type="text" id="username" name="username" class="form-control form-control-dark borderless"
                           required>
                    <?php
                    if ($data->query('username')) {
                        echo "<div class='text-danger'>" . $data->query('username') . "</div>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" id="password" name="password" class="form-control form-control-dark borderless"
                           required>
                    <?php
                    if ($data->query('password')) {
                        echo "<div class='text-danger'>" . $data->query('password') . "</div>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <p>Nog geen account? Klik <a href="/registreren">hier</a> om te registreren.</p>
                    <button class="btn btn-primary">Inloggen</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include $_SERVER["DOCUMENT_ROOT"] . './views/layouts/footer.php' ?>