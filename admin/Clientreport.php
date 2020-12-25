<?php 

//require_once 'core.php';
require_once 'includes/config.php';
	
	$sql = "SELECT tblstudents.FullName,tblbooks.BookName,tblbooks.ISBNNumber,tblbooks.id,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId order by tblissuedbookdetails.id desc";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Student Name</th>
			<th>Book Name</th>
			<th>Book ID</th>
			<th>ISBN Number</th>
			<th>Issued Date</th>
			<th>Return Date</th>
		</tr>

		<tr>';
		$cnt=1;
		if($query->rowCount() > 0)
		{
		foreach($results as $result)
		{  
			//echo"<script>alert('".$result->FullName."')</script>";
			$table .= '<tr>
				<td><center>'.$result->FullName.'</center></td>
				<td><center>'.$result->BookName.'</center></td>
				<td><center>'.$result->id.'</center></td>
				<td><center>'.$result->ISBNNumber.'</center></td>
				<td><center>'.$result->IssuesDate.'</center></td>
				<td><center>'.$result->ReturnDate.'</center></td>
			</tr>';	
		}
		}
		$table .= '
		</tr>		
	</table>
	<button onClick="window.print()">Print this page</button>
	';	

	echo $table;



?>