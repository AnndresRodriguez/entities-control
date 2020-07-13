<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PAZ Y SALVO - PERMISOS APLICATIVOS HUEM </title>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <style type="text/css">
	    hr{
	    	margin-top: 2px;
	    	margin-bottom: 2px;
	    }

		p{
			font-size: 9px;
		}

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
        }

        td, th {
            padding: 5px;
        }

        .th-table {
            font-size: 12px;
        }

    </style>
</head>
<body>
    
    <div style="width: 14%; height: 100px; float: left;"></div>

    <div style="width: 70%; float: left;">
        <h3 style="text-align: center;"> ESE-HUEM </h3>
        <h4 style="text-align: center;"> 5AN-71 Barrio Guaimaral | Cúcuta - Norte de Santander </h4>
        <h3 style="text-align: center;"> PERMISOS APLICATIVOS HUEM </h3>
        <h3 style="text-align: center;"> PAZ Y SALVO </h3>
    </div>

    <div style="width: 15%; float: left;">
        <p> Sistemas HUEM </p>
        <p> {{ date('d/m/Y G:i:s') }} </p>
    </div>

    <hr style="width: 100%;">


    <div style="width: 100%;">
        <h4 style="text-align: center;"> DATOS DEL RETIRO </h4>

        <table>
            <tbody>
                <tr>
                    <td><b>Colaborador</b></td>
                    <td>{{ $retiro->empleado->empleado->nombreCompleto() }}</td>
                </tr>
                <tr>
                    <td><b>Fecha de solicitud de retiro</b></td>
                    <td>{{ $retiro->created_at }}</td>
                </tr>
                <tr>
                    <td><b>Usuario que realizo el retiro</b></td>
                    <td>{{ $retiro->administrador->empleado->nombreCompleto() }}</td>
                </tr>
                <tr>
                    <td><b>Fecha retiro</b></td>
                    <td>{{ $retiro->fecha_retiro }}</td>
                </tr>
            </tbody>
        </table>

    </div>

</body>
</html>