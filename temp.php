<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
$StudentID=$_GET['StudentID'];
$StudName=$_GET['StudName'];
$ISBNNumber=$_GET['ISBNNumber'];
$BookName=$_GET['BookName'];
$AuthorName=$_GET['AuthorName'];
$CategoryName=$_GET['CategoryName'];
$BookPrice=$_GET['BookPrice'];

$sql = "SELECT * from tblrequestedbookdetails where StudentID=:StudentID and ISBNNumber=:ISBNNumber";
$query = $dbh -> prepare($sql);
$query->bindParam(':StudentID',$StudentID,PDO::PARAM_STR);
$query->bindParam(':ISBNNumber',$ISBNNumber,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
$_SESSION['msg']="You have already requested this book";
header('location:request-a-book.php');
}
else{
  $sql = "SELECT * from tblrequestedbookdetails where StudentID=:StudentID";
  $query = $dbh -> prepare($sql);
  $query->bindParam(':StudentID',$StudentID,PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $cnt=1;
  if($query->rowCount() == 2)
  {
	$_SESSION['msg']="You cannot request more than 2 books at a time";
	header('location:request-a-book.php');
  }
  else 
  {
	$sql="INSERT INTO tblrequestedbookdetails(StudentID,StudName,BookName,CategoryName,AuthorName,ISBNNumber,BookPrice) VALUES(:StudentID,:StudName,:BookName,:CategoryName,:AuthorName,:ISBNNumber,:BookPrice)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':StudentID',$StudentID,PDO::PARAM_STR);
	$query->bindParam(':StudName',$StudName,PDO::PARAM_STR);
	$query->bindParam(':BookName',$BookName,PDO::PARAM_STR);
	$query->bindParam(':CategoryName',$CategoryName,PDO::PARAM_STR);
	$query->bindParam(':AuthorName',$AuthorName,PDO::PARAM_STR);
	$query->bindParam(':ISBNNumber',$ISBNNumber,PDO::PARAM_STR);
	$query->bindParam(':BookPrice',$BookPrice,PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	$_SESSION['msg']="Book requested successfully";
	header('location:request-a-book.php');
  }
}
}?>


