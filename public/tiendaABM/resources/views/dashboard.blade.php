@extends('layouts.admin')
@section('admin')
<div class="main">
    @include('layouts.nav')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Panel principal
                </h1>
                <p class="header-subtitle">Datos generales de la tienda.</p>
            </div>

            <?php 

                $today = getdate();
                $data_month = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
                $mes_actual = $today['mon'];
                $ano_actual = $today['year'];
                $current_month = $data_month[$mes_actual-1];

                $total_ganado = 0;
                $mes_ganado = 0;
                $reembolsado = 0;

                $g_enero = 0;
                $g_febrero = 0;
                $g_marzo = 0;
                $g_abril = 0;
                $g_mayo = 0;
                $g_junio = 0;
                $g_julio = 0;
                $g_agosto = 0;
                $g_septiembre = 0;
                $g_octubre = 0;
                $g_noviembre = 0;
                $g_diciembre = 0;

                $r_enero = 0;
                $r_febrero = 0;
                $r_marzo = 0;
                $r_abril = 0;
                $r_mayo = 0;
                $r_junio = 0;
                $r_julio = 0;
                $r_agosto = 0;
                $r_septiembre = 0;
                $r_octubre = 0;
                $r_noviembre = 0;
                $r_diciembre = 0;

                foreach ($ventas as $key => $item) {
                    $total_ganado = $total_ganado + $item->total;
                    $array_date = explode('-',$item->createAt);
                       

                    if($array_date[0] == $ano_actual){
                        if($array_date[1] == $mes_actual){
                            $mes_ganado = $mes_ganado + $item->total;
                        }  

                        if($array_date[1] == "01"){
                            $g_enero = $g_enero + $item->total;
                        }

                        if($array_date[1] == "02"){
                            $g_febrero = $g_febrero + $item->total;
                        }

                        if($array_date[1] == "03"){
                            $g_marzo = $g_marzo + $item->total;
                        }

                        if($array_date[1] == "04"){
                            $g_abril = $g_abril + $item->total;
                        }

                        if($array_date[1] == "05"){
                            $g_mayo = $g_mayo + $item->total;
                        }

                        if($array_date[1] == "06"){
                            $g_junio = $g_junio + $item->total;
                        }

                        if($array_date[1] == "07"){
                            $g_julio = $g_julio + $item->total;
                        }

                        if($array_date[1] == "08"){
                            $g_agosto = $g_agosto + $item->total;
                        }
   
                        if($array_date[1] == "09"){
                            $g_septiembre = $g_septiembre + $item->total;
                        }

                        if($array_date[1] == "10"){
                            $g_octubre = $g_octubre + $item->total;
                        }

                        if($array_date[1] == "11"){
                            $g_noviembre = $g_noviembre + $item->total;
                        }

                        if($array_date[1] == "12"){
                            $g_diciembre = $g_diciembre + $item->total;
                        }
                    }
                }
                
                foreach ($v_reembolsado as $key => $item) {
                    $total_ganado = $total_ganado + $item->total;
                    $array_date = explode('-',$item->createAt);

                    $reembolsado = $reembolsado + $item->total;

                    if($array_date[0] == $ano_actual){ 

                        if($array_date[1] == "01"){
                            $r_enero = $r_enero + $item->total;
                        }

                        if($array_date[1] == "02"){
                            $r_febrero = $r_febrero + $item->total;
                        }

                        if($array_date[1] == "03"){
                            $r_marzo = $r_marzo + $item->total;
                        }

                        if($array_date[1] == "04"){
                            $r_abril = $r_abril + $item->total;
                        }

                        if($array_date[1] == "05"){
                            $r_mayo = $r_mayo + $item->total;
                        }

                        if($array_date[1] == "06"){
                            $r_junio = $r_junio + $item->total;
                        }

                        if($array_date[1] == "07"){
                            $r_julio = $r_julio + $item->total;
                        }

                        if($array_date[1] == "08"){
                            $r_agosto = $r_agosto + $item->total;
                        }
   
                        if($array_date[1] == "09"){
                            $r_septiembre = $r_septiembre + $item->total;
                        }

                        if($array_date[1] == "10"){
                            $r_octubre = $r_octubre + $item->total;
                        }

                        if($array_date[1] == "11"){
                            $r_noviembre = $r_noviembre + $item->total;
                        }

                        if($array_date[1] == "12"){
                            $r_diciembre = $r_diciembre + $item->total;
                        }
                    }
                }


            ?>

       
            <div class="row form-group">
                <div class="col-md-6 col-lg-3 col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Ganancias</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="avatar">
                                        <div class="avatar-title rounded-circle bg-primary-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h1 class="display-5 mt-1 mb-3">${{$total_ganado}}</h1>
                            <div class="mb-0">
                                Todos los meses
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Ganancias de {{$current_month}}</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="avatar">
                                        <div class="avatar-title rounded-circle bg-primary-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart align-middle"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h1 class="display-5 mt-1 mb-3">${{$mes_ganado}}</h1>
                            <div class="mb-0">
                               Ganancias del mes actual
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Reembolsos</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="avatar">
                                        <div class="avatar-title rounded-circle bg-primary-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity align-middle"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h1 class="display-5 mt-1 mb-3">${{$reembolsado}}</h1>
                            <div class="mb-0">
                                Todas de reembolsos
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Usuarios</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="avatar">
                                        <div class="avatar-title rounded-circle bg-primary-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h1 class="display-5 mt-1 mb-3">{{count($users)}}</h1>
                            <div class="mb-0">
                               Usuarios registrados en la tienda
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                            <div class="card-actions float-right">
                                
                            <div class="d-inline-block dropdown show">
                                <a href="#" data-toggle="dropdown" data-display="static">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical align-middle"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </a>

                                    
                                </div>
                            </div>
                            <h5 class="card-title mb-0">Grafico de ganancias</h5>
                        </div>
                        <div class="card-body py-3">
                            <div class="chart chart-sm"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="chartjs-dashboard-line" style="display: block; height: 250px; width: 613px;" width="766" height="312" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </main>
    
</div>
@push('scripts')
<script>
    $(function() {
        
        new Chart(document.getElementById("chartjs-dashboard-line"), {

            type: 'line',
            data: {
                labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                datasets: [{
                        label: "Ventas",
                        fill: true,
                        backgroundColor: window.theme.primary,
                        borderColor: window.theme.primary,
                        borderWidth: 2,
                        stepSize: 50,
                        data: ['<?php echo $g_enero?>', '<?php echo $g_febrero?>', '<?php echo $g_marzo?>','<?php echo $g_abril?>', '<?php echo $g_mayo?>', '<?php echo $g_junio?>', '<?php echo $g_julio?>', '<?php echo $g_agosto?>', '<?php echo $g_septiembre?>', '<?php echo $g_octubre?>', '<?php echo $g_noviembre?>', '<?php echo $g_diciembre?>']
                    },
                    {
                        label: "Reembolsos",
                        fill: true,
                        backgroundColor: "#fea2a2c9",
                        borderColor: "#fea2a2c9",
                        borderWidth: 2,
                        data: ['<?php echo $r_enero?>', '<?php echo $r_febrero?>', '<?php echo $r_marzo?>','<?php echo $r_abril?>', '<?php echo $r_mayo?>', '<?php echo $r_junio?>', '<?php echo $r_julio?>', '<?php echo $r_agosto?>', '<?php echo $r_septiembre?>', '<?php echo $r_octubre?>', '<?php echo $r_noviembre?>', '<?php echo $r_diciembre?>']
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                elements: {
                    point: {
                        radius: 0
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 200
                        },
                        display: true,
                        gridLines: {
                            color: "rgba(0,0,0,0)",
                            fontColor: "#fff"
                        }
                    }]
                }
            }
        });
    });
</script>
@endpush
@endsection