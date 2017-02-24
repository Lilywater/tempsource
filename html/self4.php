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
//  document.getElementById("Form1").submit()
//  alert("this is it" )
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
<form id="total" method="get" action="self4.php" >
<div class="div1">

<table id="POITable" border="1">
        <tr> <td>Location</td> <td>SubLocation</td> </tr>

<?php
   if (!isset($_GET['Location']) ) {
      if (!isset($_GET['cbox']) ) {
        if(!isset($_POST['sortOrder'])){
             echo "rrestart the session";
//       $aa = array('Chengdu', 'Kunming', 'Beijing', 'Panzhihua','Shenzhen','Shanghai','Liangshan');
//       for($j=0; $j<1; $j++){
//          $sloca = $aa[$j] ;
//          unset($_SESSION[$sloca]);
//         }
//         print_r(_SESSION['Chengdu']);
          session_unset();
             }
   } }
    session_start();  
//   if (isset($_GET['update_button'])) {
//    echo "update button  set"; 

   if (isset($_GET['Location']) ) {

     $tblname=$_GET["Location"];
   
//       for($i=0; $i<count($oldcbox);$i++){  
//          echo " <tr> <td>" . $tblname ."</td> <td>" . $oldcbox[$i]  . "</td> </tr>" ;
//       }
   if (isset($_GET['cbox']) ) {
     $cbox=$_GET['cbox'];  
      echo (count($cbox));
      echo('CBOx is set');  
 
      if(!isset($_SESSION[$tblname]))  {
      $_SESSION[$tblname] = $cbox;}
       else {
         $tmp = array_merge($_SESSION[$tblname], $cbox) ;
         $_SESSION[$tblname] = $tmp;  }
      echo 'session of table is ';
      print_r($_SESSION[$tblname] );
       $aa = array('Chengdu', 'Kunming', 'Beijing', 'Panzhihua','Shenzhen','Shanghai','Liangshan');
       for($j=0; $j<1; $j++){
          $sloca = $aa[$j] ;
         if(isset($_SESSION[$sloca]))  {
            $rest = $_SESSION[$sloca];
           for($i=0; $i<count($rest);$i++){  
          echo " <tr> <td>" . $sloca ."</td> <td>" . $rest[$i]  . "</td> </tr>" ; }
        }
      }
     }
   }
   else{echo "no Location and sublocation";}
// } 

  if (isset($_GET['query_button'])) {
   $sttime=$_GET["time_start"];
   $endtime=$_GET["time_end"];
   $tblname=$_GET["Location"];
   $a="";


     $oldcbox = $_SESSION['cbox'] ;
    echo "the count of oldcbox is:";
    echo count($oldcbox);

     for($i=0; $i<count($oldcbox);$i++){  
       $a .= $oldcbox[$i];
       $a .= "    ";
     } 
  $result =  "python /home/pi/wserv.py " . $tblname  ." " . $sttime  ." " . $endtime   ." " . $a ." " . ">example.html" ; 
   print_r($result);
   session_destroy();
//  system($result); 
//    header("Location: ./example.html");
  }

?>


</table>
  <br>
<input type="text" id="Los" name="Location" ><br>
  <br>
  StartDate:  <input type="text" name="time_start" id="J_time_start" class="date" size="12" > &nbsp
  EndData:    <input type="text" name="time_end" id="J_time_end" class="date" size="12" ><br>
  <br>
<input type="submit" name="update_button" value="Update" />
<input type="submit" name="query_button" value="Query" />

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
