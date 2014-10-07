<?php

session_start();
$table = 'facturas';
 
// Table's primary key
$primaryKey = 'idFacturas';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'FacturasSq', 'dt' => 0 ),
    array( 'db' => 'FacturasRuc',  'dt' => 1 ),
    array( 'db' => 'FacturasRazonComprador',   'dt' => 2 ),
    array( 'db' => 'FacturasFechaEmision', 'dt' => 3),
    array( 'db' => 'FacturasNumeroAutoriza', 'dt' => 4),
    array( 'db' => 'FacturasFechaAutoriza', 'dt' => 5),
    array( 'db' => 'FacturasImporteSinImpuesto', 'dt' => 6),
    array( 'db' => 'FacturasTotalImpto', 'dt' => 7),
    array( 'db' => 'FacturasImporteTotal', 'dt' => 8)
    );
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => 'salgraf',
    'db'   => 'salgraf',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'sspclass1.php' );
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);