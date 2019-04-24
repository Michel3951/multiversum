<?php include $_SERVER["DOCUMENT_ROOT"] . '/views/layouts/header.php' ?>
    <div class="container py-5">
        <div class="card shadow-sm border-radius-5">
            <div class="card-header">Registreren</div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-row">
                        <div class="col">
                            <label for="username">Gebruikersnaam <span class="text-danger">*</span></label>
                            <input type="text" id="username" name="username"
                                   class="form-control form-control-dark borderless"
                                   required>
                            <?php
                            if ($data->query('username')) {
                                echo "<div class='text-danger'>" . $data->query('username') . "</div>";
                            }
                            ?>
                        </div>
                        <div class="col">

                            <label for="password">Wachtwoord <span class="text-danger">*</span></label>
                            <input type="password" id="password" name="password"
                                   class="form-control form-control-dark borderless"
                                   required>
                        </div>
                        <div class="col">
                            <label for="password-verify">Herhaal Wachtwoord <span class="text-danger">*</span></label>
                            <input type="password" id="password-verify" name="password-verify"
                                   class="form-control form-control-dark borderless"
                                   required>
                            <?php
                            if ($data->query('password-verify')) {
                                echo "<div class='text-danger'>" . $data->query('password-verify') . "</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="first-name">Voornaam <span class="text-danger">*</span></label>
                            <input type="text" id="first-name" name="first-name"
                                   class="form-control form-control-dark borderless"
                                   required>
                        </div>
                        <div class="col">

                            <label for="middle-name">Tussenvoegsel(s)</label>
                            <input type="text" id="middle-name" name="middle-name"
                                   class="form-control form-control-dark borderless">
                        </div>
                        <div class="col">
                            <label for="last-name">Achternaam <span class="text-danger">*</span></label>
                            <input type="text" id="last-name" name="last-name"
                                   class="form-control form-control-dark borderless"
                                   required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="email">Email Adres <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control form-control-dark borderless" required>
                            <?php
                            if ($data->query('email')) {
                                echo "<div class='text-danger'>" . $data->query('email') . "</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <p>Heeft u al een account? Klik <a href="/inloggen">hier</a> om in te loggen.</p>
                        <p><span class="text-danger">*</span> Verplicht veld.</p>
                        <button class="btn btn-primary">Registreren</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include $_SERVER["DOCUMENT_ROOT"] . './views/layouts/footer.php' ?>