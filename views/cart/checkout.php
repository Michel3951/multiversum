<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header.php"; ?>
    <section class="my-4">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h1>Persoonsgegevens</h1>
                            <form action="">
                                <div class="form-row">
                                    <div class="col-md">
                                        <label for="gender">Aanhef</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="0">De Heer</option>
                                            <option value="1">Mevrouw</option>
                                        </select>
                                    </div>
                                    <div class="col-md">
                                        <label for="first-name">Voornaam <span class="text-danger">*</span></label>
                                        <input type="text" name="first-name" id="first-name" class="form-control" required>
                                    </div>
                                    <div class="col-md">
                                        <label for="middle-name">Tussenvoegsel</label>
                                        <input type="text" name="middle-name" id="middle-name" class="form-control" required>
                                    </div>
                                    <div class="col-md">
                                        <label for="last-name">Achternaam <span class="text-danger">*</span></label>
                                        <input type="text" name="last-name" id="last-name" class="form-control" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="col-md">
                                        <label for="street-name">Straatnaam <span class="text-danger">*</span></label>
                                        <input type="text" name="street-name" id="street-name" class="form-control" required>
                                    </div>
                                    <div class="col-md">
                                        <label for="house-number">Huisnummer <span class="text-danger">*</span></label>
                                        <input type="text" name="house-number" id="house-number" class="form-control" required>
                                    </div>
                                    <div class="col-md">
                                        <label for="middle-name">Toevoeging</label>
                                        <input type="text" name="middle-name" id="middle-name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md">
                                        <label for="city">Woonplaats <span class="text-danger">*</span></label>
                                        <input type="text" name="city" id="city" class="form-control" required>
                                    </div>
                                    <div class="col-md">
                                        <label for="zip-code">Postcode <span class="text-danger">*</span></label>
                                        <input type="text" name="house-number" id="house-number" class="form-control" pattern="[0-9]{4}[a-zA-Z]{2}" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="col-md">
                                        <label for="email">E-Mail Adres <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control" required>
                                    </div>
                                    <div class="col-md">
                                        <label for="phone">Telefoonnummer <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" id="phone" class="form-control" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4>Winkelmand</h4>
                            <table class="table">
                                <?php
                                $cart = $data[0];
                                $total = 0;
                                if ($cart == null) {
                                    echo 'Geen producten';
                                } else {
                                    echo '                                <thead>
                                    <tr>
                                        <th style="border: none !important;">Aantal</th>
                                        <th style="border: none !important;">Product</th>
                                        <th class="text-right" style="border: none !important;">Prijs per stuk</th>
                                        <th class="text-right" style="border: none !important;">Acties</th>
                                    </tr>
                                </thead>';
                                    foreach ($cart as $key) {
                                        $item = $key[0];
                                        if (isset($item['sale']) && $item['sale']) {
                                            $total += floatval($item['price'] - ($item['price'] / 100 * $item['sale_percentage'])) * $key['count'];
                                        } else {
                                            $total += floatval($item['price']) * $key['count'];
                                        }
                                        echo '<tr>';
                                        echo '<td><a href="#" onclick="event.preventDefault(); plus(' . $item['id'] . ')"><i class="far fa-plus-square"></i></a> ' . $key['count'] . ' <a href="#" onclick="event.preventDefault(); minus(' . $item['id'] . ')"><i class="far fa-minus-square"></i></a></td>';
                                        echo "<td>$item[name]</td>";
                                        echo "<td class='text-right'>&euro;" . number_format($item['sale'] ? ($item['price'] - ($item['price'] / 100 * $item['sale_percentage'])) : $item['price'], 2) . "</td>";
                                        echo '<td class="text-right"><a href="#" onclick="event.preventDefault(); remove(' . $item['id'] . ')"><i class="fas fa-trash-alt"></i></a></td>';
                                        echo '<tr>';
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card w-100">
                        <div class="card-body shadow-sm">
                            <h4>Afrekenen</h4>
                            <table class="table">
                                <tr>
                                    <td>Subtotaal</td>
                                    <td>&euro;<?php echo number_format($total, 2, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td>BTW 21%</td>
                                    <td>&euro;<?php echo number_format($total / 100 * 21, 2, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td>Totaal</td>
                                    <td>
                                        &euro;<?php echo number_format(($total / 100 * 21) + $total, 2, ',', '.') ?></td>
                                </tr>
                            </table>
                            <hr>
                            <a href="#" class="btn btn-success w-100 text-white">Naar betaling</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function plus(id) {
            $.post(`/cart?update=${id}&amount=1`, function (res) {
                location.reload();
            });
        }

        function minus(id) {
            $.post(`/cart?update=${id}&amount=-1`, function (res) {
                location.reload();
            });
        }

        function remove(id) {
            $.post(`/cart?remove=${id}`, function (res) {
                location.reload();
            });
        }
    </script>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php"; ?>