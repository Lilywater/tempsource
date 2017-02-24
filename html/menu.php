<html>
<head>
<style type="text/css">
 .centerDiv { width: 99%; height:200px; margin: 0 auto; background-color:green ; } 
 .div1 { width: 33%; height:200px; background-color:red ; float:left; } 
 .div2 { width: 34%; height:200px; background-color:yellow ; float:left; } 
 .div3 { width: 33%; height:200px; background-color:pink ; float:left; }
</style>
</head>
<body>
<form action="ss.php" method="get">
<div class="centerDiv">
 <div class="div1">
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


<label><input type="checkbox" name="cbox[]" value="<?php echo $f1; ?>"><?php echo $f1; ?></label><br>
<?php } ?>
</ul> 
</div>
<div class="div2">
<ul> 
<li>Location: Kunming</li> 
<?php 
$conn=mysql_connect('localhost','root','123'); 
if (!$conn) {
    die('Could not connect: ' . mysql_error());
    mysql_close($conn);
}
mysql_select_db('mysql',$conn); 
$result = mysql_query("SELECT DISTINCT tloc  FROM Kunming" );
$num=mysql_numrows($result);mysql_close();

$i=0;
 while ($i < $num ) {
  $f1=mysql_result($result, $i, "tloc");
  $i++;
 ?>


<label><input type="checkbox" name="cbox[]" value="<?php echo $f1; ?>"><?php echo $f1; ?></label><br>
<?php } ?>
</ul> 

</div>
<div>
<table id="POITable" border="1" input type="hidden" name="foo">
        <tr>
            <td>Latitude</td>
            <td>Longitude</td>
                    </tr>
        <tr>
            <td><input size=25 type="text" id="latbox" readonly=true/></td>
            <td><input size=25 type="text" id="lngbox" readonly=true/></td>
            
        </tr>
    </table>
</div>

   <input type="submit">
</div>
</form>
</body>
</html>

