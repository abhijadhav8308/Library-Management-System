<?php
include('includes/config.php');
$ret="select * from tblfine where 1";
$query= $dbh -> prepare($ret);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{
$fine=$result->fine;
echo"<script>alert('".$fine."')</script>";	
}
}
?>