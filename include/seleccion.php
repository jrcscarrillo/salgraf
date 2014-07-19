<?php

$table = 'invoice';
 
// Table's primary key
$primaryKey = 'TxnID';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'TxnID', 'dt' => 0 ),
    array( 'db' => 'TxnNumber', 'dt' => 1 ),
    array( 'db' => 'CustomerRef_ListID',  'dt' => 2 ),
    array( 'db' => 'CustomerRef_FullName',   'dt' => 3 ),
    array( 'db' => 'TxnDate', 'dt' => 4 ),
    array( 'db' => 'RefNumber', 'dt' => 5 ),
    array( 'db' => 'FOB', 'dt' => 6 ),
    array( 'db' => 'Subtotal', 'dt' => 7 ),
    array( 'db' => 'SalesTaxTotal', 'dt' => 8 ),
    array( 'db' => 'BalanceRemaining', 'dt' => 9 )    
    );
// SQL server connection information
$sql_details = array(
    'user' => 'srijrcscarrillo',
    'pass' => 'F9234568!s',
    'db'   => 'srijrcscarrillo',
    'host' => 'srijrcscarrillo.db.10949679.hostedresource.com'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'sspclass.php' );
require_once('FirePHP.class.php');
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
//ob_start();
//$firephp = FirePHP::getInstance(true);
//$firephp->log($_GET, 'GET Variables');