<?php 

//require_once 'core.php';
require_once 'includes/config.php';
	
	$sql = "SELECT * from overdue";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Sr No</th>
			<th>Student Name</th>
			<th>Student ID</th>
			<th>Phone Number</th>
			<th>Fine</th>
		</tr>

		<tr>';
		$cnt=1;
		$totalcredit=0;
		if($query->rowCount() > 0)
		{
		foreach($results as $result)
		{  
			//echo"<script>alert('".$result->FullName."')</script>";
			$table .= '<tr>
				<td><center>'.$cnt.'</center></td>
				<td><center>'.$result->StudentName.'</center></td>
				<td><center>'.$result->StudentID.'</center></td>
				<td><center>'.$result->MobNumber.'</center></td>
				<td><center>'.$result->Fine.'</center></td>
			</tr>';	
			$cnt+=1;
			$totalcredit+=$result->Fine;
		}
		}
		$table .= '
		</tr>		
	</table>
	<div align="right">Total Credit:'.$totalcredit.'</div>
	<br>
	<button onClick="window.print()">Print this page</button>
	';	

	echo $table;



?>