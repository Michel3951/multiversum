<!--<footer class="background-primary mt-5">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-4">-->
<!--                <h4>Navigatie</h4>-->
<!--                <hr>-->
<!--                <ul class="list-unstyled">-->
<!--                    <li><a href="/">Home</a></li>-->
<!--                    <li><a href="/">Home</a></li>-->
<!--                    <li><a href="/">Home</a></li>-->
<!--                    <li><a href="/">Home</a></li>-->
<!--                </ul>-->
<!--            </div>-->
<!--            <div class="col-4">-->
<!--            </div>-->
<!--            <div class="col-4">-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</footer>-->
<script>
    function ajaxCall(id) {
        $.post(`/cart?add=${id}`, function (res) {
        });
    }

    $('#price-start').focus(function () {
        $('#price-start').val('');
    });
    $('#price-end').focus(function () {
        $('#price-end').val('');
    });
</script>
</body>
</html>