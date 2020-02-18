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

            .container-app{
                margin-top: -230px;
            }
        </style>

        <!-- Bootstrap core CSS -->
        <link href = {{ asset("css/bootstrap.css") }} rel="stylesheet" />
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="container container-app">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Product Monitoring</h2>
                        <h4>Easy to track your product price</h4>
                        <form action="javascript:void(0);" method="post" id="form" data-toggle="validator">
                        <div class="input-group form-group">
                            <input required id="link" type="text" class="form-control" placeholder="www.fabelio.com" aria-label="www.fabelio.com" aria-describedby="basic-addon2">
                            <div class="input-group-btn">
                                <button style="border-top-right-radius: 5px; border-bottom-right-radius: 5px " onclick="addLink()" class="btn btn-default form-control" type="button">Submit</button>
                            </div>
                        </div>
                        </form>
                        <a href="list-product" style="float: right">
                            See Product List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script src="{{asset('js/lib/jquery.js')}}"></script>
<script src="{{asset('js/lib/bootstrap.js')}}"></script>
<script src="{{asset('js/lib/validator.js')}}"></script>
<script>

    $(document).ready(function() {
        $('#form').validator()
    })

    function addLink() {
        if ($('#form').validator('validate').has('.has-error').length === 0){
            $.ajax({
                type: "POST",
                url: '{{ env('BASE_URL') }}/api',
                dataType: "json",
                contentType: 'application/json',
                data: JSON.stringify({
                    link : $('#link').val()
                }),
                success: function(result) {
                    if(result != null){
                        $('#link').val('')
                        alert('Success Add Link')
                    }
                },
                error: function(err) {
                    alert(err.responseJSON.message);
                }
            });
        }
    }

</script>
