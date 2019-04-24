<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header.php";
$products = $data[0];
?>
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-borderless">
                    <?php
                    if ($products) {
                        echo '<p>Uw zoekopdracht gaf '. count($products).' resultaten</p>';
                        foreach ($products as $product) {
                            echo "<tr><td><a href='/$product[sku]'>$product[name]</a></td></tr>";
                        }
                    } else {
                        echo '<p>Uw zoekopdracht gaf geen resultaten</p>';
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php"; ?>