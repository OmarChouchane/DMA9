<?php
    require __DIR__. '/vendor/autoload.php';

    use Dompdf\Dompdf;
    
    $title = '<h1 style="font-family: Poppins;">Taste The Best Food in Town .</h1>';
    $title .='<img src="assets/imgs/logo.png">';

    $dompdf = new Dompdf ([
        "chroot" => __DIR__
    ]);

    $dompdf ->loadHtml($title);

    $dompdf ->render();

    $dompdf ->stream("Facture.pdf");
?>