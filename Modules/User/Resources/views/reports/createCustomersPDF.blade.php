<html>
  <head>
      <title>Print PDF</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <style>
          table {
              border-collapse: collapse;
              page-break-inside:auto;
              margin: auto;
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
    <h2>Reporte de Cliente - {{ date("d/m/Y") }}</h2>
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-danger">
                <th style="width: 30%" scope="col">Nombre</th>
                <th style="width: 15%" scope="col">Teléfono</th>
                <th style="width: 40%" scope="col">Dirección</th>
                <th style="width: 15%" scope="col">Máquinas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->total_machines }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>