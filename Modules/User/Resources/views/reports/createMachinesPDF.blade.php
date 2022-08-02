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
    <h2>Reporte de Máquinas - {{ date("d/m/Y") }}</h2>
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-danger">
                <th style="width: 20%" scope="col">Nombre</th>
                <th style="width: 20%" scope="col">Status</th>
                <th style="width: 15%" scope="col">shares_1m</th>
                <th style="width: 20%" scope="col">shares_5m</th>
                <th style="width: 25%" scope="col">shares_15m</th>
            </tr>
        </thead>
        <tbody>
            @foreach($machines as $machine)
            <tr>
                <td>{{ $machine->worker_name }}</td>
                <td>{{ $machine->status }}</td>
                <td>{{ $machine->shares_1m }}</td>
                <td>{{ $machine->shares_5m }}</td>
                <td>{{ $machine->shares_15m }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>