@extends('layouts.master')

@section('title')Egreso #{{$egreso->id}}
@stop
@section('description')
@stop
@section('style')
@stop
@section('breadcrumb')<li><a href="{{url('egresos')}}">Egresos</a></li>
@stop

@section('content')

    <div class="panel panel-default" xmlns="http://www.w3.org/1999/html">
        <div class="panel-heading hidden-print">Egreso</div>
        <div class="panel-body">
            <section class="invoice-env">
                <div class="invoice-header">
                    <div class="invoice-options hidden-print">

                        <a href="#"
                           class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right btn-single text-left"
                           onclick="imprimir()">
                            <i class="fa-print"></i>
                            <span>Print</span>
                        </a>
                    </div>
                    <div class="invoice-logo">
                        <a href="#" class="logo">
                            <img src="/img/logoalizquirdamediano.jpg" class="img-responsive">
                        </a>
                    </div>
                </div>
                <div class="invoice-details">
                    <div class="invoice-client-info">
                        <big>
                            <ul class="list-unstyled">
                                <li><strong>    Miproteina S.A.S </strong><span> NIT: 900517471-0</span></li>
                                <li><i class="linecons-cog"></i>    Pbx (1) 3826710-3218331781</li>
                                <li>    Cra 15 #16-46 Local 8</li>
                                <li>    {!! HTML::link('http://www.miproteina.com.co','www.miproteina.com.co') !!}</li>
                            </ul>
                        </big>

                    </div>
                    <div class="invoice-payment-info">
                        <span><big>Egreso #<strong>{{$egreso->id}}</strong></big></span>
                        <big>
                            <ul class="list-unstyled">
                                <li>Pagado a: <strong>{{$egreso->proveedor_id}}</strong></li>
                                <li>Forma de Pago: <strong>{{$egreso->forma_pago->forma_pago}}</strong></li>
                                <li>fecha: <strong>{{$egreso->fecha}}</strong></li>
                            </ul>
                        </big>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr class="no-borders">


                        <th width="80%" class="text-center">Concepto</th>
                        <th class="text-center">Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$egreso->concepto}}</td>
                        <td class="text-right text-primary text-bold">${{number_format($egreso->total,0) }}</td>
                    </tr>
                    </tr>
                    </tbody>
                </table>
                <div class="invoice-totals">
                    <div class="invoice-subtotals-totals">
                        <span>    Sub - Total :    <strong>${{number_format($egreso->total,0) }}</strong> </span>
                        <hr>
                        <span>    Gran Total:    <strong>${{number_format($egreso->total,0) }}</strong> </span>
                    </div>
                    <div class="invoice-bill-info">
                        <span>Firma y sello del Beneficiario: _________________________________</span>
                        <br></br>
                        <span>Elaborado: <strong> {{ Auth::user()->name }} </strong></span>
                        <span>Revisado: <strong>____</strong></span>
                        <span>Contabilizado: <strong>____</strong></span>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="panel panel-default" xmlns="http://www.w3.org/1999/html">
        <div class="panel-body">
            <section class="invoice-env">
                <div class="invoice-header">
                    <div class="invoice-logo">
                        <a href="#" class="logo">
                            <img src="/img/logoalizquirdamediano.jpg" class="img-responsive">
                        </a>
                    </div>
                </div>
                <div class="invoice-details">
                    <div class="invoice-client-info">
                        <big>
                            <ul class="list-unstyled">
                                <li><strong>Miproteina S.A.S </strong><span> NIT: 900517471-0</span></li>
                                <li><i class="linecons-cog"></i>Pbx (1) 3826710-3218331781</li>
                                <li>Cra 15 #16-46 Local 8</li>
                                <li>{!! HTML::link('http://www.miproteina.com.co','www.miproteina.com.co') !!}</li>
                            </ul>
                        </big>

                    </div>
                    <div class="invoice-payment-info">
                        <span><big>Egreso #<strong>{{$egreso->id}}</strong></big></span>
                        <big>
                            <ul class="list-unstyled">
                                <li>Pagado a: <strong>{{$egreso->proveedor_id}}</strong></li>
                                <li>Forma de Pago: <strong>{{$egreso->forma_pago->forma_pago}}</strong></li>
                                <li>fecha: <strong>{{$egreso->fecha}}</strong></li>
                            </ul>
                        </big>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr class="no-borders">


                        <th width="80%" class="text-center">Concepto</th>
                        <th class="text-center">Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$egreso->concepto}}</td>
                        <td class="text-right text-primary text-bold">${{number_format($egreso->total,0) }}</td>
                    </tr>
                    </tr>
                    </tbody>
                </table>
                <div class="invoice-totals">
                    <div class="invoice-subtotals-totals">
                        <span>    Sub - Total :    <strong>${{number_format($egreso->total,0) }}</strong> </span>
                        <hr>
                        <span>    Gran Total:    <strong>${{number_format($egreso->total,0) }}</strong> </span>
                    </div>
                    <div class="invoice-bill-info">
                        <span>Firma y sello del Beneficiario: _________________________________</span>
                        <br></br>
                        <span>Elaborado: <strong> {{ Auth::user()->name }} </strong></span>
                        <span>Revisado: <strong>____</strong></span>
                        <span>Contabilizado: <strong>____</strong></span>
                    </div>
                </div>
            </section>
        </div>

    </div>
@stop
@section('scripts')
    <script>
        function imprimir() {
            window.print();
            return false;
        }
    </script>
@stop
