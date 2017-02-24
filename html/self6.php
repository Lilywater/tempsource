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
function clearAll()
  {
    
  alert("clear all seleted location" )
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
function submitForm(action)
{
        document.getElementById('total').action = action;
        document.getElementById('total').submit();
}

</script>
</head>

<body>

<div class="centerDiv">
<form id="total" method="post" action="self6.php">
<div class="div1">

<table id="POITable" border="1">
        <tr> <td>Location</td> <td>SubLocation</td> </tr>

<?php
    $sloca="";
   session_start();  
    if(!isset($_SESSION['time_start']) )
    { 
     $_SESSION['time_start'] = "2017-01-01" ;
    }

    if(!isset($_SESSION['time_end']) )
    { 
     $_SESSION['time_end'] = "2017-02-20" ;
    }
   if (isset($_POST['clear_button'])) {
          session_unset();
    echo "clear button  set"; }
   if(isset($_POST['sortOrder']))
   {
    echo "select has been selected";
    $tblname=$_POST["sortOrder"];
     print_r($tblname);
    }
   if(isset($_POST['cbox'])){ 
     $cbox = $_POST['cbox'] ;
     echo "cbox has been selected";
     }

      if(!isset($_SESSION[$tblname]))  {
      $_SESSION[$tblname] = $cbox;}
       else {
         $tmp = array_merge($_SESSION[$tblname], $cbox) ;
         $_SESSION[$tblname] = $tmp;  }
      echo 'session of table is ';
      print_r($_SESSION[$tblname] );
      $sloca='Beijing';
       $aa = array('Chengdu', 'Kunming', 'Beijing', 'Panzhihua','Shenzhen','Shanghai','Liangshan');
       for($j=0; $j<count($aa); $j++){
          $sloca = $aa[$j] ;
         if(isset($_SESSION[$sloca]))  {
            $rest = $_SESSION[$sloca];
           for($i=0; $i<count($rest);$i++){  
          echo " <tr> <td>" . $sloca ."</td> <td>" . $rest[$i]  . "</td> </tr>" ; }
        }
      }
 
?>


</table>
<button onclick="submitForm('self5.php')">Add Location</button>
<input type="submit" name="clear_button" value="Clear all location" />
  <br>
  <br>
  StartDate:  <input type="text" name="time_start" id="J_time_start" class="date" value="<?php echo $_SESSION['time_start']; ?>" size="12" > &nbsp
  EndData:    <input type="text" name="time_end" id="J_time_end" class="date" value="<?php echo $_SESSION['time_end']; ?>" size="12" ><br>
  <br>

<button onclick="submitForm('ss.php')">Query with these locations and time</button>
</div>


<div class="div2">
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
