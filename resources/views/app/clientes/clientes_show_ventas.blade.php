<div class="row">
    <div class="col-sm-4 col-lg-4">
        <a class="block block-rounded block-link-hover3 text-center" href="javascript:void(0)">
            <div class="block-content block-content-full bg-success">
                <div class="h1 font-w700 text-white"><span class="h2 text-white-op">$</span> {{ number_format($datos['pagado']) }}</div>
            </div>
            <div class="block-content block-content-full block-content-mini">
                <i class="fa fa-arrow-up text-success"></i> Pagos realizados
            </div>
        </a>
    </div>
    <div class="col-sm-4 col-lg-4">
        <a class="block block-rounded block-link-hover3 text-center" href="javascript:void(0)">
            <div class="block-content block-content-full bg-warning">
                <div class="h1 font-w700 text-white"><span class="h2 text-white-op">$</span> {{ number_format($datos['pendiente']) }}</div>
            </div>
            <div class="block-content block-content-full block-content-mini">
                <i class="fa fa-arrow-down text-warning"></i> Pagos pendientes
            </div>
        </a>
    </div>
    <div class="col-sm-4 col-lg-4">
        <a class="block block-rounded block-link-hover3 text-center" href="javascript:void(0)">
            <div class="block-content block-content-full bg-danger">
                <div class="h1 font-w700 text-white"><span class="h2 text-white-op">$</span> {{number_format( $datos['vencido']) }}</div>
            </div>
            <div class="block-content block-content-full block-content-mini">
                <i class="fa fa-arrow-down text-danger"></i> Compras vencidas
            </div>
        </a>
    </div>
</div>
<div class='block block-themed'>
    <div class="block-header bg-primary-light">
        <h3 class="block-title">Tabla de @yield('title')</h3>
    </div>
    <div class="block-content table-responsive">
        @include('app.ventas.tabla_ventas')
    </div>
</div>
