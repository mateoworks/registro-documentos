<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Lista de residentes</title>
</head>
<style>
    @font-face {
        font-family: 'Montserrat';
        src: url("{{ storage_path('fonts/montserrat/Montserrat-Regular.otf')}}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    body {
        font-family: 'Montserrat', Arial, sans-serif;

    }

    .page-break {
        page-break-after: always;
    }

    .avatar-image {
        width: 40px;
        border-radius: 5px;
    }

    .avatar-text {
        width: 40px;
        height: 40px;
        border-radius: 5px;
        background-color: #1B396A;
        color: #fff;
        text-align: center;
        line-height: 40px;
        font-size: 16px;
        font-weight: bold;
    }

    .tabla-principal {
        border-collapse: collapse;
        width: 100%;

    }

    .tabla-principal th {
        background-color: #1B396A;
        color: white;
    }

    .tabla-principal th,
    .tabla-principal td {
        border: 1px solid #9b9b9b;
        font-size: 11px;
    }

    td.ancho-maximo {
        max-width: 180px;
    }

    /* Estilos para la tabla anidada (hija) */

    .tabla-anidada td {
        border: none;
        font-size: 11px;
    }

    .tabla-anidada .text-left {
        text-align: left;
    }

    td.cell-avatar {
        max-width: 41px;
    }

    .details {
        vertical-align: middle;
    }

    .chip-carrera {
        border-radius: 2px;
        padding: 1px;
        color: white;
    }

    .m-0 {
        margin: 0;
        padding: 0;
    }

    .tipo-proyecto {
        border-radius: 2px;
        padding: 1px;
        background-color: lightgray;
    }

    .asesor {
        border-radius: 2px;
        padding: 1px;
        background-color: lightblue;
    }
</style>

<body>
    <div class="titulo">
        Lista de residentes del periodo {{$periodo->nombre}}
    </div>
    <table class="tabla-principal">
        <thead>
            <tr>
                <th>Estudiante</th>
                <th>Empresa</th>
                <th>Proyecto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($residentes as $residente)
            <tr>
                <td>
                    <table class="tabla-anidada">
                        <tr>
                            <td class="cell-avatar m-0">
                                @if ($residente->url_foto)
                                <img src="{{ $residente->url_foto }}" alt="Avatar" class="avatar-image">
                                @else
                                <div class="avatar-text">{{ $residente->iniciales_nombre_apellido }}</div>
                                @endif
                            </td>
                            <td>
                                <div>{{ $residente->nombre_completo }}</div>
                                <div class="details m-0">
                                    <span class="chip-carrera" style="background-color: {{ $residente->color_carrera }};">
                                        {{$residente->nombre_carrera}}
                                    </span>
                                    <!-- <img src="{{ asset('iconos/llamada.png') }}" height="12px" alt="Icono de teléfono"> -->
                                    {{ $residente->telefono_estudiante }}
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="ancho-maximo m-0">
                    <div>{{$residente->nombre_empresa }}</div>
                    <div>{{$residente->telefono_empresa }}</div>
                </td>
                <td class="ancho-maximo m-0">
                    <div>{{$residente->proyecto }}</div>
                    <small>
                        @if ($residente->tipo_proyecto)
                        <span class="tipo-proyecto">{{ $residente->tipo_proyecto }}</span>
                        @else
                        No hay proyecto asignado
                        @endif
                        |
                        @if ($residente->asesor_interno)
                        <span class="asesor">{{ $residente->asesor_interno }}</span>
                        @else
                        No hay asesor asignado
                        @endif
                    </small>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>