<table>
    <thead>
        <tr>
            <th>Estudiante</th>
            @foreach ($documentos as $documento)
            <th>{{ $documento->nombre_documento }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($estudiantes as $estudiante)
        <tr>
            <td>{{ $estudiante->nombre }}</td>
            @foreach ($documentos as $documento)
            <td>{{ $data[$estudiante->id][$documento->id] }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>