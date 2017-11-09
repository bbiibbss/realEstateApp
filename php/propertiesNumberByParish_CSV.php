<?php
	
	require_once('propertyClass.php');
    $property = new PROPERTY();
	
	$stmt = $property->runQuery("SELECT parish_name, PK_parish_id, parish_id, COUNT(*) AS `total`
                FROM property AS ppt  JOIN parish AS ps
                ON ppt.PK_parish_id=ps.parish_id
                GROUP BY parish_id");
	$stmt->execute();

	$jsonArray = array();

	if($stmt->rowCount() > 0) {
		foreach ($stmt AS $row) {
			$jsonArrayItem['Freguesia'] = $row['parish_name'];
			$jsonArrayItem['Num Propriedades'] = $row['total'];
			array_push($jsonArray, $jsonArrayItem);
		}
	}

	header('Content-type: application/json');

	function cleanData(&$str) {
	    $str = preg_replace("/\t/", "\\t", $str);
	    $str = preg_replace("/\r?\n/", "\\n", $str);
	    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
	}
	
	$filename = "property_number_by_parish_" . date('d-m-Y') . ".xls";

	header("Content-Encoding: UTF-8");
	header("Content-Type: application/vnd.ms-excel;charset=UTF-8");
	header("Content-Disposition: attachment; filename=\"$filename\"");

	$flag = false;
	foreach($jsonArray as $row) {
		if(!$flag) {
	     	echo implode("\t", array_keys($row)) . "\r\n";
	     	$flag = true;
    	}
	    array_walk($row, __NAMESPACE__ . '\cleanData');
	    echo implode("\t", array_values($row)) . "\r\n";
  	}
	exit;
		
?>