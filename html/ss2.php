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
  }
function handleClick(cb) {
  if(cb.checked)
  {
    var x=document.getElementById('POITable').insertRow(1);
    var c1=x.insertCell(0);
    var c2=x.insertCell(1);
     var sl=document.getElementById("sortOrder").selectedIndex;
    c1.innerHTML= document.getElementById("sortOrder")[sl].value;
     c2.innerHTML=cb.value;
     var loc=document.getElementById("Los");
     loc.value = document.getElementById("sortOrder")[sl].value;
  }
}

</script>
</head>

<body>

<div class="centerDiv">
<div class="div1">
<form id="Form1" method="post" action"<?php echo $_SERVER['PHP_SELF']?>" >
<table id="POITable" border="1">
        <tr> <td>Location</td> <td>SubLocation</td> </tr>
<?php

   if(isset($_POST['Location']) && isset($POST['cbox']) )
   {
      
     $tblname=$_POST["Location"];
     $cbox=$_POST['cbox'];  
     if(!empty($cbox)){   
      echo('您的选择结果是：');  
      echo (count($_GET['cbox']));
       for($i=0; $i<count($_GET['cbox']);$i++){  
          echo " <tr> <td>" . $tblname ."</td> <td>" . cbox[$i]  . "</td> </tr>" ;
       }
     }  
   }
?>
</table>
  <br>
<input type="text" id="Los" name="Location" ><br>
  <br>
  StartDate:  <input type="text" name="time_start" id="J_time_start" class="date" size="12" > &nbsp
  EndData:    <input type="text" name="time_end" id="J_time_end" class="date" size="12" ><br>
  <br>
<input type="submit">

</div>


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

<label><input type="checkbox" name="cbox[]" value="<?php echo $f1; ?>"  onclick='handleClick(this)'><?php echo $f1; ?></label><br>
<?php } ?>

</form>




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
