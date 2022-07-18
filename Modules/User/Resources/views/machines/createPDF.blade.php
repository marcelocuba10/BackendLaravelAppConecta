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
              display:table-header-group 
          }
          th, td {
              border: black 1px solid;
              padding-left: 5px;
              padding-right: 5px;
              min-width: 150px;
          }
          @page {
              size: legal landscape;
              margin: 1cm;
          }
      </style>
  </head>
  <body>
    <table>
      {{-- <thead>
          <tr>
            <?php
                // table headers
                // for($x = 1 ; $x <= $machinesCount; $x++) {
                //     echo '<th>Header ' . $x . '</th>';
                // }
                // foreach ($machines as $machine) {
                //     echo '<th>name ' . $machine->name . '</th>';
                // }
            ?>
          </tr>
      </thead> --}}
      <tbody>
        <?php
            //table body data
            $lastCount = 0;
            for($y = 0 ; $y < 10; $y++) {

                echo '<tr>';
                for($x = 0 ; $x < 10; $x++) {

                    if($lastCount < 10){
                        $name = $machines[$lastCount]->name;
                        $codeQR = $machines[$lastCount]->codeQR;
                    }

                    echo '<td style="text-align:center">';
                    echo  $name . ' <img src="data:image/png;base64,' . base64_encode(QrCode::size(80)->generate($codeQR)) . '" />' ;
                    echo ' </td>';

                    $lastCount++; //9
                }
                echo '</tr>';
            }
        ?>
      </tbody>
  </table>
  </body>
  </html>