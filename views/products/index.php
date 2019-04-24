<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header.php"; ?>
<?php $request = $data[0];
$products = $data[1];
$count = $data[2] ?? null;
?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-3 d-none d-lg-block">
                <div class="row">
                    <div class="card shadow-sm w-100">
                        <div class="card-body">
                            <form action="" method="POST">
                                <h4>Filter</h4>
                                <hr>
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <span>Prijs</span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-5">
                                        <input type="number" name="price-start" id="price-start" required
                                               value="<?php echo isset($_GET['price-start']) ? $_GET['price-start'] : '0' ?>"
                                               min="0" step="0.01" class="form-control">
                                    </div>
                                    <div class="col-2">
                                        tot
                                    </div>
                                    <div class="col-5">
                                        <input type="text" name="price-end" id="price-end" required
                                               value="<?php echo isset($_GET['price-start']) ? $_GET['price-start'] : '1000' ?>"
                                               min="0" step="0.01" class="form-control">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row mb-3">
                                    <!--                                    <div class="col">-->
                                    <!--                                        <label for="brand">Merk</label>-->
                                    <!--                                        <select name="brand" id="brand"-->
                                    <!--                                                class="form-control">-->
                                    <!--                                            <option value="htc">HTC</option>-->
                                    <!--                                        </select>-->
                                    <!--                                    </div>-->
                                </div>
                                <button class="btn btn-secondary">Filteren</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row">
                    <?php
                    if ($products) {
                        foreach ($products as $product) {
                            echo '<div class="col-md-6 mb-4"><div class="card shadow-sm">';
                            if ($product['image']) {
                                echo "<img src='$product[image]' class='card-img-top' style='max-height: 200px'>";
                            }
                            echo '<div class="card-body">' . $product['name'] . '<br><br>';
                            if ($product['sale']) {
                                echo "<del class='text-danger'>&euro;$product[price]</del> &euro;" . strtolower($product['price'] - ($product['price'] / 100 * $product['sale_percentage']));
                            } else {
                                echo '&euro;' . $product['price'];
                            }
                            echo '<br><br><a href="/' . $product['sku'] . '">Product Specificaties</a><br><br><a href="#" onclick="event.preventDefault(); ajaxCall(' . $product['id'] . ')" data-toggle="modal" data-target="#modal-' . $product['id'] . '" class="btn btn-outline-secondary">Toevoegen aan winkelmand</a></div></div></div>';
                            echo '<div class="modal fade" id="modal-' . $product['id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-black" id="exampleModalLabel">Product toegevoegd aan winkelmand</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Doorgaan met winkelen</button>
                                        <a class="btn btn-info text-white" href="/winkelmand">Naar winkelmand</a>
                                  </div>
                            </div>
                        </div>
                    </div>';
                        }
                    } else {
                        echo '<div class="container"><p>Er zijn geen producten met deze filter</p></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row text-center justify-content-center">
            <?php if ($count) {
                $request->paginate($count, 6);
            } ?>
        </div>
    </div>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php"; ?>