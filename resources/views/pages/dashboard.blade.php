@extends('layouts.default')

@section('content')

    <div class="page-head">
        <h3>{{ $title }}</h3>
        <span class="sub-title">{{ $description }}</span>
    </div>

    <div class="wrapper">

        <div class="row state-overview">
            <div class="col-lg-3 col-sm-6">
                <section class="panel purple">
                    <div class="symbol">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="value white">
                        <h1 class="timer" data-from="0" data-to="{{ $orcamentos }}"
                            data-speed="1000">
                        </h1>
                        <p>Orçamentos</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel red">
                    <div class="symbol">
                        <i class="fa fa-send"></i>
                    </div>
                    <div class="value">
                        <h1 class="timer" data-from="0" data-to="{{ $emails }}"
                            data-speed="1000">
                        </h1>
                        <p>Orçamentos Enviados</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel green">
                    <div class="symbol">
                        <i class="fa fa-usd"></i>
                    </div>
                    <div class="value">
                        <h1 class="timer" data-from="0" data-to="{{ $ordensCompra }}"
                            data-speed="1000">
                        </h1>
                        <p>Ordens de Compra</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel blue">
                    <div class="symbol">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="value">
                        <h1 class="timer" data-from="0" data-to="{{ $ordensLancadas }}"
                            data-speed="3000">
                            <!--2345-->
                        </h1>
                        <p>Ordens Lançadas</p>
                    </div>
                </section>
            </div>
        </div>

    </div>

@stop

@section('footer')
    <script>
        jQuery(function ($) {
            $('.timer').countTo();
        })
    </script>
@stop