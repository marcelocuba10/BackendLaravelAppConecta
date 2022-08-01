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
    <h2>Reporte de Funcionarios - {{ date("d/m/Y") }}</h2>
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-danger">
                <th style="width: 20%" scope="col">Nombre</th>
                <th style="width: 20%" scope="col">Apellidos</th>
                <th style="width: 15%" scope="col">Teléfono</th>
                <th style="width: 20%" scope="col">Email</th>
                <th style="width: 25%" scope="col">Doc Identidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->ci }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>