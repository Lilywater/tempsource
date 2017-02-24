<html>
<head>
<style type="text/css">
 .centerDiv { width: 99%; height:200px; margin: 0 auto; background-color:green ; } 
 .div1 { width: 33%; height:200px; background-color:red ; float:left; } 
 .div2 { width: 34%; height:200px; background-color:yellow ; float:left; } 
 .div3 { width: 33%; height:200px; background-color:pink ; float:left; }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="./calendar/calendar-blue.css"/>
</head>

<body>

<form name="bizLoginForm" method="post" action"<?php echo $_SERVER['PHP_SELF']?>" >
    Location: 
   <select name="sortOrder"  onchange="form.submit()">
  <option value ="Chengdu">Chengdu</option>
  <option value ="Kunming"> Kunming</option>
  <option value="Beijing">Beijing</option>
  <option value="Panzhihua">Panzhihua</option>
  <option value="Shenzhen">Shenzhen</option>
  <option value="Shanghai">Shanghai</option>
  <option value="Liangshan">Liangshan</option>
  <option value="Chongqing">Chongqing</option>
</select>

</form>



<form action="ss.php" method="get">

<?php
   if(!isset($_POST['sortOrder'])){
   $sortOrder = "Chengdu";
   } else {
    $sortOrder = $_POST['sortOrder'];
  }
  echo  'Location is: ' . '<input type="text" name="Location" value=' . $sortOrder . "><br>";
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

<label><input type="checkbox" name="cbox[]" value="<?php echo $f1; ?>"><?php echo $f1; ?></label><br>
<?php } ?>


  <br>
  StartDate:  <input type="text" name="time_start" id="J_time_start" class="date" size="12" ><br>
  <br>
  EndData:    <input type="text" name="time_end" id="J_time_end" class="date" size="12" ><br>
  <br>
<input type="submit">
</form>

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
