<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header.php";
$product = $data[0];
$details = $data[1];
?>
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="<?php echo isset($product['image']) ? 'col-md-8' : 'col'?>">
                        <?php
                        echo "<a href='#' onclick='ajaxCall($product[id])' class='btn btn-outline-secondary float-right' data-toggle='modal' data-target='#modal-$product[id]'>Toevoegen aan
                            winkelmand</a>"
                        ?>
                        <h1><?php echo $product['name']; ?></h1>
                        <hr>
                        <span>Voorraad: <?php echo $product['stock']; ?></span><br>
                        <span>Prijs: <?php
                            if ($product['sale']) {
                                echo "<del class='text-danger'>&euro;$product[price]</del> &euro;" . strtolower($product['price'] - ($product['price'] / 100 * $product['sale_percentage']));
                            } else {
                                echo '&euro;' . $product['price'];
                            }
                            ?></span><br>
                        <hr>
                        <span>Beschrijving:</span>
                        <?php echo $product['description'] ? $product['description'] : 'Er is nog geen beschrijving voor dit product'; ?>
                        <hr>
                        <table class="table table-borderless" style="max-width: 50%">
                            <?php
                            if (isset($data[1])) {
                                if (isset($details['color']) && $details['color']) {
                                    echo "<tr><td class='pl-0 pt-0'>Kleur</td><td class='pl-0 pt-0'>$details[color]</td></tr>";
                                }
                                if (isset($details['connection']) && $details['connection']) {
                                    echo "<tr><td class='pl-0 pt-0'>Aansluiting(en)</td><td class='pl-0 pt-0'>$details[connections]</td></tr>";
                                }
                                if (isset($details['audio']) && $details['audio']) {
                                    echo "<tr><td class='pl-0 pt-0'>Audio</td><td class='pl-0 pt-0'>$details[audio]</td></tr>";
                                }
                                if (isset($details['platform']) && $details['platform']) {
                                    echo "<tr><td class='pl-0 pt-0'>Platform(s)</td><td class='pl-0 pt-0'>$details[platform]</td></tr>";
                                }
                                if (isset($details['refresh_rate']) && $details['refresh_rate']) {
                                    echo "<tr><td class='pl-0 pt-0'>Verversfrequentie</td><td class='pl-0 pt-0'>$details[refresh_rate]gHz</td></tr>";
                                }
                                if (isset($details['resolution']) && $details['resolution']) {
                                    echo "<tr><td class='pl-0 pt-0'>Resolutie</td><td class='pl-0 pt-0'>$details[resolution]</td></tr>";
                                }
                                if (isset($details['brand']) && $details['brand']) {
                                    echo "<tr><td class='pl-0 pt-0'>Merk</td><td class='pl-0 pt-0'>$details[brand]</td></tr>";
                                }
                                if (isset($details['ean']) && $details['ean']) {
                                    echo "<tr><td class='pl-0 pt-0'>EAN</td><td class='pl-0 pt-0'>$details[ean]</td></tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <div class="<?php echo isset($product['image']) ? 'col-md-4': 'd-none' ?>">
                        <?php
                        if (isset($product['image'])) {
                            echo "<img class='img-fluid img-rounded w-100' src='$product[image]'>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function ajaxCall(id) {
            $.post(`/cart?add=${id}`, function (res) {
            });
        }
    </script>

<?php
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
include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php"; ?>