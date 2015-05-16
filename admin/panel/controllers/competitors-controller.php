<?php
	require_once '../scripts/dbquery.php';
	$table = '<table id="competitors">
		<thead>
			<tr><th>Име</th><th>Фамилия</th></tr>
		</thead>
		<tfoot>
		 	<tr>
		 		<td> Hack(TUES) 1 - 2015</td>
		 	</tr>
		</tfoot>
		<tbody>';
	
	$colls = ['name', 'lastname'];
	$competitors = getData('competitors', $colls);

	if (!count($competitors)) {
		echo "В момента няма информация.";
		return;
	}

	for ($i=0; $i < count($competitors); $i++) { 
		$table .= '<tr>';
		for ($j=0; $j <count($colls) ; $j++) { 
			$table .= '<td>';
			$table .= $competitors[$i]->$colls[$j];
			$table .= '</td>';
		}
		$table .= '</tr>';
	}
	$table .= '</tbody> </table>';
	
	echo $table;
?>