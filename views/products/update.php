<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header_backend.php";
$product = $data[0];
$details = $data[1];
?>
    <div class="container my-5">
        <div class="row">
            <div class="col">
                <div class="card shadow-sm border-radius-5">
                    <div class="card-body">
                        <form action="?id=<?php echo $product['id']?>" method="POST">
                            <div class="form-row">
                                <div class="col-md-8">
                                    <label for="name">Product Naam <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" value="<?php echo $product['name']?>" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="stock">Voorraad <span class="text-danger">*</span></label>
                                    <input type="number" name="stock" class="form-control" id="stock" value="<?php echo $product['stock']?>" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="price">Prijs <span class="text-danger">*</span></label>
                                    <input type="number" name="price" class="form-control" id="price" value="<?php echo $product['price']?>" required>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="sale">Aanbieding</label>
                                    <select name="sale" id="sale" class="form-control">
                                        <option value="0">Nee</option>
                                        <option value="1" <?php echo $product['sale'] ? 'selected' : ''?>>Ja</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label for="sale-percentage">Korting percentage <span class="text-danger">*</span></label>
                                    <input type="number" name="sale-percentage" class="form-control" id="sale-percentage" min="1" max="100" step="1" value="<?php echo $product['sale_percentage']?>" required>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col">
                                    <label for="photo">Foto <span class="text-danger">*</span></label>
                                    <input type="text" name="photo" id="photo" class="form-control" placeholder="URL" required value="<?php echo $product['image'] ?>">
                                    <small class="text-muted">Hier kunt u de URL van een foto plakken, om een foto te uploaden kunt u een upload tool gebruiken zoals
                                        <a href="https://imgur.com/upload" target="_blank">imgur</a></small>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col">
                                    <label for="description">Beschrijving</label>
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="3"><?php echo $product['description']?></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col">
                                    <label for="sku">SKU <span class="text-danger">*</span></label>
                                    <input type="text" name="sku" class="form-control" id="sku" value="<?php echo $product['sku']?>" required>
                                    <small class="text-muted">Dit is de stock keeping unit van het product, ook de url waar het product in komt te staan.
                                        <br>Je mag alleen streepjes, cijfers en letters gebruiken.</small>
                                </div>
                            </div>
                            <hr>
                            <h4>Product Details</h4>
                            <div class="form-row">
                                <div class="col-md-auto">
                                    <label for="color">Kleur</label>
                                    <input type="text" name="color" class="form-control" id="color" value="<?php echo $details['color'] ? : '' ?>">

                                </div>
                                <div class="col-md-auto">
                                    <label for="connections">Aansluiting(en)</label>
                                    <input type="text" name="connections" class="form-control" id="connections" value="<?php echo $details['connections'] ? : '' ?>">
                                </div>
                                <div class="col-md-auto">
                                    <label for="audio">Audio</label>
                                    <input type="text" name="audio" class="form-control" id="audio" value="<?php echo $details['audio'] ? : '' ?>">
                                </div>
                                <div class="col-md-auto">
                                    <label for="platform">Platform(s)</label>
                                    <input type="text" name="platform" class="form-control" id="platform" value="<?php echo $details['platform'] ? : '' ?>">
                                </div>
                                <div class="col-md-auto">
                                    <label for="refresh_rate">Verversingsfrequentie</label>
                                    <input type="text" name="refresh_rate" class="form-control" id="refresh_rate" value="<?php echo $details['refresh_rate'] ? : '' ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-auto">
                                    <label for="resolution">Resolutie</label>
                                    <input type="text" name="resolution" class="form-control" id="resolution"  value="<?php echo $details['resolution'] ? : '' ?>">
                                </div>
                                <div class="col-md-auto">
                                    <label for="brand">Merk</label>
                                    <input type="text" name="brand" class="form-control" id="brand"  value="<?php echo $details['brand'] ? : '' ?>">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-md-auto">
                                    <button class="btn btn-primary mr-2">Product Aanpassen</button>
                                    <button class="btn btn-secondary" onclick="event.preventDefault(); back()" href="#">Terug</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php"; ?>
<script>
    function back() {
        return window.location = document.referrer;
    }
</script>
