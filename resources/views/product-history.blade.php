<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Product Monitoring</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background: rgb(254,250,88);
                background: radial-gradient(circle, rgba(254,250,88,1) 0%, rgba(248,189,15,1) 100%);
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .full-height {
                height: 100vh;
            }
        </style>

        <!-- Bootstrap core CSS -->
        <link href = {{ asset("css/bootstrap.css") }} rel="stylesheet" />
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Monitoring Chart</h2>
                        <div id="chart" style="box-shadow: 0 2px 8px rgba(0,0,0,.12);" ></div>
                        <br/>
                        <h4>Gallery</h4>
                        <div id="container-img" style="text-align: center;"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script src="{{asset('js/lib/jquery.js')}}"></script>
<script src="{{asset('js/lib/bootstrap.js')}}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: `{{ env('BASE_URL') }}/api/${'{{request()->route('id')}}'}/history-chart?page=1`,
            contentType: 'application/json',
            success: function(result) {
                if(result != null){
                    Highcharts.chart('chart', {
                        chart: {
                            zoomType: 'x'
                        },
                        title: {
                            text: 'Monitoring Price'
                        },
                        xAxis: {
                            type: 'datetime'
                        },
                        yAxis: {
                            title: {
                                text: 'Harga'
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        credits: {
                            enabled: false
                        },
                        plotOptions: {
                            area: {
                                fillColor: {
                                    linearGradient: {
                                        x1: 0,
                                        y1: 0,
                                        x2: 0,
                                        y2: 1
                                    },
                                    stops: [
                                        [0, '#F9C317'],
                                        [1, '#ffffff']
                                    ]
                                },
                                marker: {
                                    radius: 2
                                },
                                lineWidth: 1,
                                states: {
                                    hover: {
                                        lineWidth: 1
                                    }
                                },
                                threshold: null
                            }
                        },

                        series: [{
                            type: 'area',
                            name: 'Harga',
                            data: result.data || []
                        }]
                    });
                }
            },
            error: function() {
                console.log('error')
            }
        });
        $.ajax({
            type: "GET",
            url: `{{ env('BASE_URL') }}/api/${'{{request()->route('id')}}'}/photo`,
            contentType: 'application/json',
            success: function(result) {
                if(result != null){
                    result.data.forEach(function (e) {
                        $('#container-img').append(
                            '<img style="max-width: 100px;margin: 10px;box-shadow: 0 2px 8px rgba(0,0,0,.12);" src='+e.photo_url+' alt='+e.photo_url+' >'
                        )
                    })
                }
            },
            error: function() {
                console.log('error')
            }
        });
    })

</script>
