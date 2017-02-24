<html>
<head>
<style type="text/css">
 .centerDiv { width: 99%; height:400px; margin: 0 auto; background-color:green ; } 
 .div1 { width: 50%; height:400px; background-color:red ; float:left; } 
 .div2 { width: 49%; height:400px; background-color:yellow ; float:left; } 
 </style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="./calendar/calendar-blue.css"/>
<script type="text/javascript">
function OnchangeRa()
  {
  document.getElementById("Form1").submit()
//  alert("this is it" )
  }
function submitForm(action)
{
        document.getElementById('Form1').action = action;
        document.getElementById('Form1').submit();
    }
</script>
</head>

<body>

<div class="centerDiv">

<div class="div2">
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

<form id="Form1" method="post" action"<?php echo $_SERVER['PHP_SELF']?>" >
<label><input type="checkbox" name="cbox[]" value="<?php echo $f1; ?>"  '><?php echo $f1; ?></label><br>
<?php } ?>





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

<button onclick="submitForm('self6.php')">OK</button>
</form>
</div>
</div>

</body>
</html>
