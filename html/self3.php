<html>
<head>
<style type="text/css">
 .head { /*width:990px;*/ height:200px; background:#CCC; margin:0 auto; } 
 .centerDiv { width: 99%; height:400px; margin: 0 auto; background-color:green ; } 
 .div1 { width: 33%; height:400px; background-color:red ; float:left; } 
 .div2 { width: 34%; height:400px; background-color:yellow ; float:left; } 
 .div3 { width: 33%; height:400px; background-color:green ; float:left; }
 .centerDiv2 { width: 99%; height:80px; margin: 0 auto; background-color:green ; } 
 .div4 { width: 33%; height:80px; background-color:pink ; float:left; } 
 .div5 { width: 34%; height:80px; background-color:pink ; float:left; } 
 .div6 { width: 33%; height:80px; background-color:pink ; float:left; }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="./calendar/calendar-blue.css"/>
<script type="text/javascript">
function OnchangeRa()
  {
  document.getElementById("Form1").submit()
  }
function OnchangeRa2()
  {
  document.getElementById("Form2").submit()
  }
function OnchangeRa3()
  {
  document.getElementById("Form3").submit()
  }
function handleClick(cb) {
  if(cb.checked)
  {
   alert("Clicked, new value = " + cb.value);
    var x=document.getElementById('POITable').insertRow(1);
    var c1=x.insertCell(0);
    var c2=x.insertCell(1);
     var sl=document.getElementById("sortOrder").selectedIndex;
    c1.innerHTML= document.getElementById("sortOrder")[sl].value;
     c2.innerHTML=cb.value;
  }
}
function handleClick2(cb) {
  if(cb.checked)
  {
      var x=document.getElementById('POITable').insertRow(1);
    var c1=x.insertCell(0);
    var c2=x.insertCell(1);
     var sl=document.getElementById("sortOrder2").selectedIndex;
    c1.innerHTML= document.getElementById("sortOrder2")[sl].value;
     c2.innerHTML=cb.value;
  alert("Clicked, new value = " + cb.value);
  }
}
function handleClick3(cb) {
  if(cb.checked)
  {
      var x=document.getElementById('POITable').insertRow(1);
    var c1=x.insertCell(0);
    var c2=x.insertCell(1);
     var sl=document.getElementById("sortOrder3").selectedIndex;
    c1.innerHTML= document.getElementById("sortOrder3")[sl].value;
     c2.innerHTML=cb.value;
     alert("Clicked, new value = " + cb.value);
  }
}

</script>
</head>

<body>

<form name="total2" action="ss.php" method="get">
<div class="head">
<table id="POITable" border="1">
        <tr>
            <td>Location</td>
            <td>Longitude</td>
        </tr>
        <tr>
            <td><input size=25 type="text" id="latbox" name="r1c1" value="AA"/></td>
            <td><input size=25 type="text" id="lngbox" name="r1c1" value="BB" /></td>
            
        </tr>
</table>
  <br>
<?php  echo  'Location is: ' . '<input type="text" name="Location" value=' . $sortOrder . "><br>"; ?>
<?php  echo  'Location is: ' . '<input type="text" name="Location2" value=' . $sortOrder2 . "><br>"; ?>
  <br>
  StartDate:  <input type="text" name="time_start" id="J_time_start" class="date" size="12" > &nbsp
  EndData:    <input type="text" name="time_end" id="J_time_end" class="date" size="12" ><br>
  <br>
<input type="submit">
</div>

<div class="centerDiv">

<div class="div1">


<?php
   session_start();

   if(!isset($_POST['sortOrder']))
   {
    echo 'no selected value';
    if( !isset($_SESSION['sortOrder'] ))
     { $sortOrder = "Chengdu";}
    else{ $sortOrder= $_SESSION['sortOrder'] ; }
   } 
   else {
    echo ' selected value';
   $sortOrder = $_POST['sortOrder'];
   $_SESSION['sortOrder'] = $_POST['sortOrder'];
   }
$conn=mysql_connect('localhost','root','123'); 
if (!$conn) {
    die('Could not connect: ' . mysql_error());
    mysql_close($conn);
}
mysql_select_db('mysql',$conn); 
$sqlclause = "SELECT DISTINCT tloc  FROM ";
$sqlclause .= $sortOrder;
//$result = mysql_query("SELECT DISTINCT tloc  FROM Chengdu" );
$result = mysql_query($sqlclause );
$num=mysql_numrows($result);mysql_close();

$i=0;
 while ($i < $num ) {
  $f1=mysql_result($result, $i, "tloc");
  $i++;

?>

<label><input type="checkbox" name="cbox[]" value="<?php echo $f1; ?>"  onclick='handleClick(this)'><?php echo $f1; ?></label><br>
<?php } ?>


</div>
<div class="div2">

<?php
   session_start();

   if(!isset($_POST['sortOrder2']))
   {
    echo 'no selected value';
    if( !isset($_SESSION['sortOrder2'] ))
     { $sortOrder2 = "Chengdu";}
    else{ $sortOrder2= $_SESSION['sortOrder2'] ; }
   } 
   else {
    echo ' selected value';
   $sortOrder2 = $_POST['sortOrder2'];
   $_SESSION['sortOrder2'] = $_POST['sortOrder2'];
   }

$conn=mysql_connect('localhost','root','123'); 
if (!$conn) {
    die('Could not connect: ' . mysql_error());
    mysql_close($conn);
}
mysql_select_db('mysql',$conn); 
$sqlclause = "SELECT DISTINCT tloc  FROM ";
$sqlclause .= $sortOrder2;
//$result = mysql_query("SELECT DISTINCT tloc  FROM Chengdu" );
$result = mysql_query($sqlclause );
$num=mysql_numrows($result);mysql_close();

$i=0;
 while ($i < $num ) {
  $f1=mysql_result($result, $i, "tloc");
  $i++;

?>

<label><input type="checkbox" name="cbox2[]" value="<?php echo $f1; ?>"  onclick='handleClick2(this);' ><?php echo $f1; ?></label><br>
<?php } ?>
</div>

<div class="div3">

<?php
   session_start();

   if(!isset($_POST['sortOrder3']))
   {
    echo 'no selected value';
    if( !isset($_SESSION['sortOrder3'] ))
     { $sortOrder3 = "Chengdu";}
    else{ $sortOrder3= $_SESSION['sortOrder3'] ; }
   } 
   else {
    echo ' selected value';
   $sortOrder3 = $_POST['sortOrder3'];
   $_SESSION['sortOrder3'] = $_POST['sortOrder3'];
   }

$conn=mysql_connect('localhost','root','123'); 
if (!$conn) {
    die('Could not connect: ' . mysql_error());
    mysql_close($conn);
}
mysql_select_db('mysql',$conn); 
$sqlclause = "SELECT DISTINCT tloc  FROM ";
$sqlclause .= $sortOrder3;
//$result = mysql_query("SELECT DISTINCT tloc  FROM Chengdu" );
$result = mysql_query($sqlclause );
$num=mysql_numrows($result);mysql_close();

$i=0;
 while ($i < $num ) {
  $f1=mysql_result($result, $i, "tloc");
  $i++;

?>

<label><input type="checkbox" name="cbox3[]" value="<?php echo $f1; ?>"   onclick='handleClick3(this)'><?php echo $f1; ?></label><br>
<?php } ?>
</div>
</div>
</form>



<div class="centerDiv2">
<div class="div4">
<form id="Form1" method="post" action"<?php echo $_SERVER['PHP_SELF']?>" >
    Location: 
   <select id="sortOrder" name="sortOrder"  onchange="OnchangeRa()">
<?php
  $aa = array("Chengdu", "Kunming", "Beijing", "Panzhihua","Shenzhen","Shanghai","Liangshan");
foreach ($aa as $key => $item) {
  $array[$key + 1] = $item + 2;
  $opt="<option value =\"";
  if($item != $sortOrder)
  {
  echo $opt . "$item\">" . $item . "</option>\n";
  }
  else
  {
    echo $opt . "$item\" " . "selected = \"selected\">" . $item  . "</option>\n" ;
   }
}
?>
</select>

</form>
</div>

<div class="div5">
<form id="Form2" method="post" action"<?php echo $_SERVER['PHP_SELF']?>" >
    Location: 

   <select name="sortOrder2"  onchange="OnchangeRa2()">
<?php
  $aa = array("Chengdu", "Kunming", "Beijing", "Panzhihua","Shenzhen","Shanghai","Liangshan");
foreach ($aa as $key => $item) {
  $array[$key + 1] = $item + 2;
  $opt="<option value =\"";
  if($item != $sortOrder2)
  {
  echo $opt . "$item\">" . $item . "</option>\n";
  }
  else
  {
    echo $opt . "$item\" " . "selected = \"selected\">" . $item  . "</option>\n" ;
   }
}
?>
</select>

</form>
</div>
<div class="div6">
<form id="Form3" method="post" action"<?php echo $_SERVER['PHP_SELF']?>" >
    Location: 

   <select name="sortOrder3"  onchange="OnchangeRa3()">
<?php
  $aa = array("Chengdu", "Kunming", "Beijing", "Panzhihua","Shenzhen","Shanghai","Liangshan");
foreach ($aa as $key => $item) {
  $array[$key + 1] = $item + 2;
  $opt="<option value =\"";
  if($item != $sortOrder2)
  {
  echo $opt . "$item\">" . $item . "</option>\n";
  }
  else
  {
    echo $opt . "$item\" " . "selected = \"selected\">" . $item  . "</option>\n" ;
   }
}
?>
</select>

</form>
</div>

</div>

<script src="./calendar/calendar.js"></script>
<script>
Calendar.setup({
    inputField : "J_time_start",
    ifFormat   : "%Y-%m-%d",
    showsTime  : false,
    timeFormat : "24"
});
Calendar.setup({
    inputField : "J_time_end",
    ifFormat   : "%Y-%m-%d",
    showsTime  : false,
    timeFormat : "24"
});
$('.J_preview').preview(); //查看大图
$('.J_cate_select').cate_select({top_option:lang.all}); //分类联动
$('.J_tooltip[title]').tooltip({offset:[10, 2], effect:'slide'}).dynamic({bottom:{direction:'down', bounce:true}});
</script>
</body>
</html>
