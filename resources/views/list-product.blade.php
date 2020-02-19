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

            .full-height {
                height: 100vh;
            }

            .dataTables_wrapper{
                background-color: white;
                box-shadow: 0 2px 8px rgba(0,0,0,.12);
            }
        </style>

        <!-- Bootstrap core CSS -->
        <link type="text/css"  rel="stylesheet" href = {{ asset("css/bootstrap.css") }} />

        <link type="text/css" rel="stylesheet" href={{ asset("datatable/css/jquery.dataTables.min.css") }}>
        <link type="text/css" rel="stylesheet" href={{ asset("datatable/css/dataTables.bootstrap.min.css") }}>
        <link type="text/css" rel="stylesheet" href={{ asset("datatable-responsive-2.1.0/css/responsive.dataTables.min.css") }}>
    </head>
    <body>
        <div class="position-ref full-height">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>List Product Saved</h2>
                        <button onclick="window.location.href = $(this).data('href');" data-href="{{URL::to('')}}" class="btn" style="position: absolute; margin: 15px;top:0; right: 0">Back</button>
                        <table style="background-color: #fff;" id="list-link" class="display responsive nowarp table main-table" cellspacing="0" width="100%"></table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script src="{{asset('js/lib/jquery.js')}}"></script>
<script src="{{asset('js/lib/bootstrap.js')}}"></script>

<script src="{{asset('datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('datatable/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('datatable-responsive-2.1.0/js/dataTables.responsive.min.js')}}"></script>
<script>

    let url = '';
    let table;
    let status = true;
    $(document).ready(function() {
        table = $('#list-link').DataTable({
            'dom' : '<"top">rt<"bottom"ipl><"clear">',
            'processing': true,
            'serverSide': true,
            'lengthChange': false,
            'columnDefs': [
                {
                    'targets': 0,
                    'title': 'Name',
                    "searchable": false,
                    "orderable": false,
                    'className': 'clickable-col',
                    'render': function (data, type, full, meta) {
                        return full['name'];
                    }
                },
                {
                    'targets': 1,
                    'title': 'Description',
                    "searchable": false,
                    "orderable": false,
                    'className': 'clickable-col',
                    'render': function (data, type, full, meta){
                        return full['description'];
                    }
                },
                {
                    'targets': 2,
                    'title': 'Link',
                    "searchable": false,
                    "orderable": false,
                    'className': 'clickable-col',
                    'render': function (data, type, full, meta){
                        return full['link'];
                    }
                }
            ],
            'ajax': {
                'url': '{{ env('BASE_URL') }}/api?page=1',
                'type': 'GET',
                'error': function() {
                }
            },
            "drawCallback": function( settings ) {
            }
        });

        $(".clickable-row").click(function() {
            window.document.location = $(this).data("href");
        });

        $(document).on( 'click', '.table tbody td.clickable-col', function () {
            window.document.location = (window.document.location.href.split('list-product'))[0]   + 'product-history/' + table.row(this).data().id;
        });
    });



</script>
