<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Print PDF</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>

      .page-break {
          page-break-after: always;
      }
      tr {
        page-break-inside: avoid;
        page-break-before: auto;
        page-break-after: auto;
        width: 100%;
      }
      
      html,
      body {
        font-family: "Trebuchet MS", Helvetica, sans-serif;
        padding: 0;
        margin: 0;
        width: 100%;
      }
      
      table {
        border-collapse: collapse;
        width: 98%;
        table-layout: fixed;
        page-break-after: auto;
        margin:auto;
      }
      
      th,
      td {
        border: 0.5px solid black;
        border-collapse: collapse;
        page-break-after: auto;
      }
      
      th {
        width: 30%;
      }
      
      th+th {
        width: 40%;
        text-align: center;
      }
      
      th+th+th {
        width: 15%;
      }
      
      th+th+th+th {
        width: 15%;
      }
      
      td+td {
        text-align: center;
      }
      
      td+td+td {
        text-align: center
      }
      
      h1 {
        margin-bottom: 0.2cm;
      }
      
      hr {
        background-color: #000000;
        height: 1cm;
        float: left;
      }
    </style>
  <body>
    <table style="overflow: hidden; page-break-after:always;">
      <thead>
        <tr>
          <th><h6>Nombre</h6></th>
          <th><h6>Estado</h6></th>
          <th><h6>CódigoQR</h6></th>
        </tr>
      </thead>
      <tbody>
          @foreach ($machines as $machine)
          <tr>
              <td class="min-width"><p>{{ $machine->name }}</p></td>
              <td class="min-width">
                <span class="status-btn @if($machine->status == 'Encendido') success-btn @elseIf($machine->status == 'Apagado') close-btn @elseIf($machine->status == 'Mantenimiento') warning-btn @endif">{{ $machine->status }}</span>
              </td>
              <td class="min-width"><img src="data:image/png;base64, {!! base64_encode(QrCode::size(50)->generate($machine->codeQR)) !!} "></td>
          </tr>
          @endforeach
      </tbody>
    </table>
  </body>
</html>