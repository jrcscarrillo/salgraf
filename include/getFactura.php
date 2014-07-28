<?php

/* Array of database columns which should be read and sent back to DataTables. 

	TxnID varchar(255) NULL,
	TimeCreated varchar(255) NULL,
	TimeModified varchar(255) NULL,
	EditSequence varchar(255) NULL,
	TxnNumber int NULL,
	CustomerRef_ListID varchar(255) NULL,
	CustomerRef_FullName varchar(255) NULL,
	ClassRef_ListID varchar(255) NULL,
	ClassRef_FullName varchar(255) NULL,
	ARAccountRef_ListID varchar(255) NULL,
	ARAccountRef_FullName varchar(255) NULL,
	TemplateRef_ListID varchar(255) NULL,
	TemplateRef_FullName varchar(255) NULL,
	TxnDate datetime NULL,
	RefNumber varchar(255) NULL,

	FOB varchar(255) NULL,

	Subtotal float NULL,

	SalesTaxPercentage varchar(255) NULL,
	SalesTaxTotal float NULL,
	AppliedAmount float NULL,
	BalanceRemaining float NULL,
	CustomField10 varchar(50) NULL,
*/
$aColumns = array( 'TxnNumber', 'CustomerRef_FullName', 'TxnDate', 'Subtotal', 'SalesTaxTotal', 'AppliedAmount', 'CustomField10' );

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "TxnID";

/* DB table to use */
$sTable = "invoice";

/* Database connection information */
$gaSql['user']       = "salgraf";
$gaSql['password']   = "salgraf";
$gaSql['db']         = "salgraf";
$gaSql['server']     = "Juanito";
	
/* 
 * Local functions
 */
	function fatal_error ( $sErrorMessage = '' )
	{
		header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
		die( $sErrorMessage );
	}	
/* 
 * MySQL connection
 */
	if ( ! $gaSql['link'] = mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) )
	{
		fatal_error( 'Could not open connection to server' );
	}

	if ( ! mysql_select_db( $gaSql['db'], $gaSql['link'] ) )
	{
		fatal_error( 'Could not select database ' );
	}

/* 
 * Paging
 * var_dump($_GET);
 *  
 */
        $sLimit = "";
	if ( isset( $_GET['start'] ) && $_GET['length'] != '-1' ) {
            $sLimit = "LIMIT ".intval( $_GET['start'] ).", ".intval( $_GET['length'] );
	}
/*
 * Ordering
 */
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
					($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}	
/* 
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
	$sWhere = " WHERE CustomField10 IS NULL ";

	
	
/*
 * SQL queries
 * Get data to display
 */
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
		FROM   $sTable $sWhere $sOrder $sLimit";
	$rResult = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	
/* Data set length after filtering */
	$sQuery = "SELECT FOUND_ROWS()";
	$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
/* Total data set length */
	$sQuery = "SELECT COUNT(`".$sIndexColumn."`) FROM   $sTable ";
	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];	
/*
 * Output
 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
			}
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>