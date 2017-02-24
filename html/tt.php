<html>
 <?php 
$sttime=$_GET["time_start"];
$endtime=$_GET["time_end"];
$tblname=$_GET["Location"];
$result =  "python /home/pi/wserv.py " . $tblname  ." " . $sttime  ." " . $endtime ; 
//print_r($result);
//$result =  "python /home/user/aicq/wserv.py"; 
system($result); 
?>
<ul> 
<li>Location: Chengdu</li> 
<?php 
$conn=mysql_connect('localhost','root','123'); 
if (!$conn) {
    die('Could not connect: ' . mysql_error());
    mysql_close($conn);
}
mysql_select_db('mysql',$conn); 
$result = mysql_query("SELECT DISTINCT tloc  FROM Chengdu" );
$num=mysql_numrows($result);mysql_close();

$i=0;
 while ($i < $num ) {
  $f1=mysql_result($result, $i, "tloc");
  $i++;
 ?>


<label><input type="checkbox"><?php echo $f1; ?></label><br>
<?php } ?>
</ul> 

</html>
