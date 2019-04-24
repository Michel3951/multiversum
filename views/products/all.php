<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header_backend.php";
$products = $data[0];
$request = $data[1];
$count = $data[2];
?>
    <div class="container my-5">
        <div class="row">
            <div class="col">
                <div class="card shadow-sm border-radius-5">
                    <div class="card-body">
                        <h4 class="float-left">Producten</h4>
                        <a href="/admin/product/toevoegen" class="btn btn-outline-secondary float-right">Product Toevoegen</a>
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>SKU</th>
                                <th>Naam</th>
                                <th>Acties</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($products as $product) {
                                echo "<tr style='border-top: 1px rgba(0,0,0,.1) solid;'><td>$product[id]</td><td>$product[sku]</td><td>$product[name]</td><td><a href='/admin/product/aanpassen?id=$product[id]' class='mr-4'><i class='fas fa-edit'></i></a><a href='#' onclick='event.preventDefault(); deleteProduct($product[id])'><i class='fas fa-trash-alt'></i></a></td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php $request->paginate($count, 6)?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function ajaxCall(id) {
            $.post(`/cart?remove=${id}`, function (res) {
            });
        }

        function deleteProduct (id) {
            if (confirm('Weet u zeker dat u dit product wilt verwijderen?')) {
                $.post(`/admin/product/verwijderen?id=${id}`, function (res) {
                    window.reload();
                });
            }
        }
    </script>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php"; ?>