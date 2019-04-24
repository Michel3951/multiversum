<?php include $_SERVER["DOCUMENT_ROOT"] . '/views/layouts/header.php' ?>
<div class="container py-5">
    <div class="row mb-4">
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-body">
                    Heeft u een vraag? Vul het onderstaande formulier in en wij zullen zo spoedig mogelijk contact met u opnemen!
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-row">
                            <div class="col">
                                <label for="name">Uw naam <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="email">Email adres <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <label for="message">Bericht <span class="text-danger">*</span></label>
                                <textarea name="message" id="message" cols="30" rows="10"
                                          class="form-control"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-outline-secondary">Verzenden</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <ul class="fa-ul">
                        <li><span class="fa-li" ><i class="fas fa-home"></i></span>Jan Pieterszoon Coenstraat 1861</li>
                        <li><span class="fa-li"><i class="fas fa-map-marked-alt"></i></span>Maasdriel, Zeeland</li>
                        <li><span class="fa-li"><i class="fas fa-envelope"></i></span>jack.jones@multiversum.com</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include $_SERVER["DOCUMENT_ROOT"] . './views/layouts/footer.php' ?>