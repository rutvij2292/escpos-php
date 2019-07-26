<?php
/**
 * This print-out shows how large the available font sizes are. It is included
 * separately due to the amount of text it prints.
 *
 * @author Michael Billington <michael.billington@gmail.com>
 */
require __DIR__ . '/../autoload.php';

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\TSPLPrinter;

$connector = new WindowsPrintConnector("TSC_TTP");
$printer = new TSPLPrinter($connector, 38, 38,true);

$barcodeDetails = [
    "item_description" => "32 JEANS PANT",
    "size_range" => "32-36",
    "created_at" => "3103",
    "pattern" => "ABC101",
    "size_name" => "32",
    "sell_rate" => 490,
    "stock_id" => 1802000101
];

try {
    $printer -> setText($barcodeDetails["item_description"], 45, 29, '0', 0, 8,10, TSPLPrinter::JUSTIFY_LEFT);
    $printer -> setText("SR:".$barcodeDetails["size_range"], 45, 52, '0', 0, 7,10, TSPLPrinter::JUSTIFY_LEFT);
    $printer -> setText("PN:".$barcodeDetails["created_at"]."-".$barcodeDetails["pattern"], 300, 52, '0', 0, 7,10, TSPLPrinter::JUSTIFY_RIGHT);
    $printer -> setText("SIZE:".$barcodeDetails["size_name"], 45, 75, '0', 0, 10,11, TSPLPrinter::JUSTIFY_LEFT);
    $printer -> setText("Rs. ".$barcodeDetails["sell_rate"], 300, 75, '0', 0, 10,11, TSPLPrinter::JUSTIFY_RIGHT);
////            $printer -> setText("PRO:".$barcodeDetails["product_name"], 8, 165, '0', 0, 10,10, TSPLPrinter::JUSTIFY_LEFT);
    $printer -> setBarcode(strval($barcodeDetails["stock_id"]), 95, 105, TSPLPrinter::BARCODE_TYPE_128, 20, TSPLPrinter::JUSTIFY_CENTER, 0, 2,4);
    $printer->setPrint();
    $printer->close();
    return true;
} catch (\Exception $e) {
    echo $e;
    return false;
}