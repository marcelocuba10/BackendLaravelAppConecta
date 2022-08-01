<html>
  <head>
      <title>Print PDF</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <style>
          table {
              border-collapse: collapse;
              page-break-inside:auto;
              margin: auto;
              width: 100%;
          }
          tr    { 
              page-break-inside:avoid; 
              page-break-after:auto;
              margin: 5px 0px 5px 0px;
          }
          thead { 
              display:table-header-group;
              background-color: black;
              color: #ffffff; 
          }
          th, td {
              border: black 1px solid;
              padding-left: 5px;
              padding-right: 5px;
              /**min-width: 150px;**/
          }
          @page {
              size: legal portrait;
              margin: 1cm;
          }
      </style>
  </head>
<body>
    <h2>Reporte de Horarios - {{ date("d/m/Y") }}</h2>
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-danger">
                <th style="width: 25%" scope="col">Nombre</th>
                <th style="width: 25%" scope="col">Fecha</th>
                <th style="width: 25%" scope="col">Horario Entrada</th>
                <th style="width: 25%" scope="col">Horario Salida</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
            <tr>
                <td>{{ $schedule->name }}</td>
                <td>{{ $schedule->date }}</td>
                <td>{{ $schedule->check_in_time }}</td>
                <td>{{ $schedule->check_out_time }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>