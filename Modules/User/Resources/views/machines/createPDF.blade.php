<html>
  <head>
      <title>sdfsfsdf</title>
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
      <thead>
          <tr>
              
              <?php
                  // table headers
                  for($x=1 ; $x<=$machinesLength; $x++) {
                      echo '<th>Header ' . $x . '</th>';
                  }
                ?>
          </tr>
      </thead>
      <tbody>

          <?php
                  //table body data
                  for($y=1 ; $y<=$machinesLength; $y++) {
                      echo '<tr>';
                      for($x=1 ; $x<=$machinesLength; $x++) {
                          $text="helloworld";
                          echo '<td>data ' . $y . ' - '. $x . ' <img src="data:image/png;base64,' . base64_encode(QrCode::size(70)->generate($text)) . '" /> </td>';
                      }
                      echo '</tr>';
                  }
                ?>
      </tbody>
  
  </table>
  
  </body>
  </html>