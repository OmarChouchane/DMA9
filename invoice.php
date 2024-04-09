<?php

session_start();

    require __DIR__. '/vendor/autoload.php';

    use Dompdf\Dompdf;
    use Dompdf\Options;
    
    $title = '
    <style>
    .container {
        display: flex;
  		justify-content: center;
        align-items: center;
    }
    
    .container img {
        padding-top: 40px;
        max-width: 150px; 
        margin-right: 10px;
    }

    .text-container, .container {
        display: inline-block; 
        vertical-align: middle;
    }

    .text-container h2 {
        font-family: sans-serif;
        margin: 0;
    }

    .text-container h2 span {
        color: #f5ac3f;
    }

    .invoice {
  		margin-right: 20px;
  		margin-left:20px;
        margin-bottom: 20px;
        
        display: flex;
        justify-content: center;
        align-items: center;
        
        border: none;
        border-radius: 10px;
        background-color: #dba000;
        padding: 5px;
    }


    .invoice p {
  		color: white;
        margin: 0; 
  		font-weight: bold;
        font-family: sans-serif;
        font-size: 35px;
        text-align: center;
    }


    .client-contact-container {
        display: flex;
  		justify-content: center;
        align-items: center;
    }

    .invoice-details,
    .invoice-info {
        display: inline-block; 
        vertical-align: middle;
        margin-top: 10px;
        margin-left: 20px;
        margin-right: 20px;
        border: none;
        height: 100px;
    }

    .invoice-details p,
    .invoice-info p {
        font-size: 17px;
        margin: 5px;
        line-height: 1.35;
    }

    .invoice-details span {
        font-size: 20px;
        font-weight: bold;
        margin-top: 20px;
    }

    .invoice-details span + span {
        margin-left: 10px; 
    }

    .invoice-details {
        padding-right: 10px;
    }

    .invoice-info {
        position: relative;
        width: 46%;
    }
    .invoice-info p {
        position: absolute;
        bottom: 0;
        right: 0; 
    }

    .cart-content{height: 470px; border: 2px solid; }

    .contact-us {
        margin : 20px;
    }

    .contact-us-details {
        font-size: 17px;
        line-height: 1.35; 
    }

    .thank-you {
        text-align: center;
        margin-top : 5px; 
    }

    .thank-you h2{
        font-family: sans-serif;
        color: #f5ac3f;

    }

    </style>
    <body>
    <div class="container"> 
        <img src="assets/imgs/logo.png" alt="Logo">     
        <div class="text-container">
            <h2>Taste <br><span>The Best Food</span><br> in Town.</h2>
        </div>
    </div>
    <div class="invoice">
        <p>Facture</p>
    </div>
    <div class="client-contact-container">
    <div class="invoice-details">
        <p>Invoice to:<br>
        <span>MR JHON</span> <br>
        123 Anywhere St., Any City, ST 12345<br>
        +123-456-7890
        </p>
    </div>
    <div class="invoice-info">
        <p>Invoice No : #1234<br>
        Invoice Date : June 02, 2022
        </p>
    </div>
    </div>
    


    
    <div class= "cart-content">
        
    </div> 



    <div class="contact-us">
       <div class="contact-us-details">+216 29 292 292 <br/>RT2, INSAT, Centre Urbain Nord.<br/>contactdma9@gmail.com</div>
    </div> 
    <div class="thank-you">
        <h2>THANK YOU !</h2>
    </div>
   </body> 
';


    $options = new Options; 
    $options -> setChroot(__DIR__);

    $dompdf = new Dompdf ($options);

    $dompdf->setPaper("A4");

    $dompdf ->loadHtml($title);

    $dompdf ->render();

    $dompdf->addInfo("Title", "Invoice");
    $dompdf->addInfo("Author", "DMA9 Services");
    $dompdf->addInfo("Subject", "Invoice");

    $dompdf ->stream("Facture.pdf");
?>