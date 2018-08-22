<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ColoredBalls</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <script
                src="https://code.jquery.com/jquery-3.3.1.slim.js"
                integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA="
                crossorigin="anonymous"></script>
    </head>
    <body>
        <form method="POST" action="" id="form">
            {{ csrf_field() }}
            ColoredBalls number: <input type="text" name="coloredBallsNumber"><br />
            <input type="submit" style="display: none" id="submit">
        </form>
        <div id="template"  class="formElement" style="display: none">
            <label for="color">Color: </label><input type="text" name="colors[]">
            <label for="number">Number: </label><input type="text" name="numbers[]">
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                $('[name="coloredBallsNumber"]').keyup(function(){
                    if (!jQuery.isNumeric( $('[name="coloredBallsNumber"]').val() )) {
                        return;
                    }

                    $('form .formElement').remove();
                    var fields = $('[name="coloredBallsNumber"]').val();
                    for (i=0; i < fields; i++) {
                       ($("#template")).clone().show().insertAfter($('[name="coloredBallsNumber"]'));
                    }
                    $("#submit").show();
                })

            })
        </script>
    </body>
</html>
