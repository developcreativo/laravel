<div id="graficas" data-codigo="{{ $producto->id }}">
    <div class="col-sm-6">
        <!-- Lines Chart -->
        <div class="block block-themed block-rounded block-bordered">
            <div class="block-header bg-amethyst">
                <ul class="block-options">
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle"
                                data-action-mode="demo" onclick="chart()"><i class="si si-refresh"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Historico Precios de compra</h3>
            </div>
            <div class="block-content block-content-full text-center" >
                    <canvas id="historico_compras" class="js-chartjs-lines" height="250" ></canvas>
            </div>
        </div>
        <!-- END Lines Chart -->
    </div>
    <div class="col-sm-6">
        <!-- Lines Chart -->
        <div class="block block-themed block-rounded block-bordered">
            <div class="block-header bg-amethyst">
                <ul class="block-options">
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle"
                                data-action-mode="demo"><i class="si si-refresh"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Historico Precios de compra</h3>
            </div>
            <div class="block-content block-content-full text-center" >
                <canvas id="historico_ventas" class="js-chartjs-lines" height="250" ></canvas>
            </div>
        </div>
        <!-- END Lines Chart -->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(chart());
    function chart() {
        setTimeout(function () {
            var codigo = $('#graficas').data('codigo');
            $.getJSON("chart?id=" + codigo, function (result) {
                console.log(result.label)
                console.log(result.data)

                var buyerData = {
                    labels: result.label,
                    datasets: [
                        {
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: result.data
                        }
                    ]
                };
                var compras = document.getElementById('historico_compras').getContext('2d');
                var ventas = document.getElementById('historico_ventas').getContext('2d');
                new Chart(compras).Line(buyerData, {bezierCurve: true});
                new Chart(ventas).Line(buyerData, {bezierCurve: true});

            });
        },3000)
    }


</script>