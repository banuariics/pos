<?php

$html = $_POST['html'];
// $myfile = fopen("print_struk.txt", "w") or die("Unable to open file!");
// $txt = $html;
// fwrite($myfile, $txt);
// fclose($myfile);
// $cmd='print.bat'; //windows
// $child = shell_exec($cmd);
// $data = array("result"=>1, "msg"=>$child);
// $json_string = json_encode($data);	
// echo $json_string;


require __DIR__ . '/vendor/escpos-php/vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/**
 * Install the printer using USB printing support, and the "Generic / Text Only" driver,
 * then share it (you can use a firewall so that it can only be seen locally).
 *
 * Use a WindowsPrintConnector with the share name to print.
 *
 * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
 * "Receipt Printer), the following commands work:
 *
 *  echo "Hello World" > testfile
 *  copy testfile "\\%COMPUTERNAME%\Receipt Printer"
 *  del testfile
 */
try {
    // Enter the share name for your USB printer here
    // $connector = null;
    $connector = new WindowsPrintConnector("serial");
	

    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
    $printer -> text($html);
    $printer -> cut();
    
    /* Close printer */
    $printer -> close();
	 echo "Proses Print\n";
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}