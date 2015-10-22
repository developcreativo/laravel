<div id="graficas" data-codigo="{{ $cliente->id }}">
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
                <canvas id="top_ventass"  ></canvas>
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
                <canvas id="top_ventas" class="js-chartjs-lines" style="width:100%; height: 300px" ></canvas>
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
                var options = {
                    responsive: true,
                    showScale: false
                };

                var buyerData = {
                    labels: result.label,
                    datasets: [
                        {
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            highlightFill: "rgba(220,220,220,0.75)",
                            highlightStroke: "rgba(220,220,220,1)",
                            data: result.data
                        }
                    ]
                };

                var ventas = document.getElementById('top_ventas').getContext('2d');
                new Chart(ventas).Bar(buyerData, options);


            });
        },3000)
    }


</script>