<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header.php";
$code = $data[0];
$message = $data[1];
?>
<div class="container my-5 text-center">
    <h1>Error <strong class="text-blue"><?php echo $code ?></strong></h1>
    <p><?php echo $message ? $message : '' ?></p>
    <p>Klik <a href="/">hier</a> om terug naar de homepagina te gaan</p>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php"; ?>
