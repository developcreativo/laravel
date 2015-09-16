<div id="graficas" data-codigo="{{ $proveedor->id }}">
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
                <h3 class="block-title">Compras pendientes</h3>
            </div>
            <div class="block-content block-content-full text-center">
                <canvas id="historico_compras" class="js-chartjs-pie" width="300" height="300"></canvas>
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
                console.log(result.data)
                var data = result.data
                var compras = document.getElementById('historico_compras').getContext('2d');
                new Chart(compras).Doughnut(data);


            });
        }, 3000);
    }


</script>