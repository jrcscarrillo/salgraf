<?php

$table = 'Archivo';
$primaryKey = 'idArchivo';

$columns = array(
    array( 'db' => 'ArchivoNombre', 'dt' => 0 ),
    array( 'db' => 'ArchivoGenerado',  'dt' => 1 ),
    array( 'db' => 'ArchivoDescargado',   'dt' => 2 ),
    array( 'db' => 'ArchivoProcesado', 'dt' => 3)
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

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);