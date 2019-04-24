<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header.php";
$sale = $data[0] ?? null;
?>

    <div class="container my-4">
        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <p>Welkom bij Multiversum. De online webshop voor VR Brillen.</p>
                <a href="/producten" class="btn btn-outline-secondary text-center">Producten bekijken</a>
            </div>
        </div>
        <?php
        if ($sale) {
            $card = '<div class="card shadow-sm"><div class="card-body"><h4>Aanbiedingen</h4><div class="row">';
            foreach ($sale as $product) {
                $card .= '<div class="col-md-4"><div class="card">';
                if (isset($product['image'])) {
                    $card .= '<img src="' . $product['image'] . '" alt="" class="card-img-top" style="max-height: 200px">';
                }
                $card .= '<div class="card-body">';
                $card .= "<p>$product[name]</p>";
                $card .= "<p><del class='text-danger'>&euro;$product[price]</del> &euro;" . strtolower($product['price'] - ($product['price'] / 100 * $product['sale_percentage'])) . "</p>";
                $card .= "<a href='$product[sku]'>Product Specificaties</a><br><br>";
                $card .= '<a href="#" onclick="event.preventDefault(); ajaxCall(' . $product['id'] . ')" data-toggle="modal" data-target="#modal-' . $product['id'] . '" class="btn btn-outline-secondary">Toevoegen aan winkelmand</a>';
                $card .= '</div></div></div>';
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
            $card .= '</div></div></div>';

            echo $card;
        }
        ?>
    </div>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php"; ?>