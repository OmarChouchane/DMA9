<?php


    require_once('vendor/autoload.php');
    use Dompdf\Dompdf;

    require_once('server/connection.php');

    session_start();

    $gt = 0;
    $i = 1;

    $html = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <style>
       table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
      }
      
      table caption {
        font-size: 1.5em;
        margin: .5em 0 .75em;
      }
      
      table tr {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: .35em;
      }
      
      table th,
      table td {
        padding: .625em;
        text-align: center;
      }
      
      table th {
        font-size: .85em;
        letter-spacing: .1em;
        text-transform: uppercase;
      }
      
      @media screen and (max-width: 600px) {
        table {
          border: 0;
        }
      
        table caption {
          font-size: 1.3em;
        }
        
        table thead {
          border: none;
          clip: rect(0 0 0 0);
          height: 1px;
          margin: -1px;
          overflow: hidden;
          padding: 0;
          position: absolute;
          width: 1px;
        }
        
        table tr {
          border-bottom: 3px solid #ddd;
          display: block;
          margin-bottom: .625em;
        }
        
        table td {
          border-bottom: 1px solid #ddd;
          display: block;
          font-size: .8em;
          text-align: right;
        }
        
        table td::before {
          content: attr(aria-label);
          */
          content: attr(data-label);
          float: left;
          font-weight: bold;
          text-transform: uppercase;
        }
        
        table td:last-child {
          border-bottom: 0;
        }
      }
      
       </style>
        </head>
    <body>
        <div class="container my-5 py-5">
            <h1 class="mt-5 mb-3">Dma9 Receipt</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Sub. Total</th>
                    </tr>
                </thead>
                <tbody>';
    $totalPrice = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) { 
            $totalPrice += $value['product_quantity'] * $value['product_price'];
            $html .= "<tr>
                <th scope='row'>".$value['product_id']."</th>
                <td>".$value['product_name']."</td>
                <td>$".$value['product_price']."</td>
                <td  class='text-center'>".$value['product_quantity']."</td>
                <td  class='text-center'>$".$value['product_quantity']*$value['product_price'].".00</td>
            </tr>";
        }
    } 
    
    $html .= '</tbody>
            </table>
            <div class="total-price">
        <p><h2>Total Price: $' . $totalPrice . '</h2></p>
    </div>
        </div> 
    </body>
    </html>';

        


    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('invoice.pdf');

?>