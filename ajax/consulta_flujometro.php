<?php

require_once dirname(__FILE__) . '/../Phpmodbus/ModbusMaster.php';

// Create Modbus object
$modbus = new ModbusMaster("192.168.200.216", "TCP");

try {
    // FC 3
    $recData0 = $modbus->readMultipleRegisters(0,0, 1);
    $recData1 = $modbus->readMultipleRegisters(0,1, 2);
}
catch (Exception $e) {
    // Print error information if any
    echo $modbus;
    echo $e;
    exit;
}

$arr = array();
$arr[0] = $recData0[1];
$arr[1] = $recData1[1] * 100;

echo json_encode($arr);
?>