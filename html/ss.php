<html>
 <?php 
session_start();
$sttime=$_POST["time_start"];
$endtime=$_POST["time_end"];
$tblname=$_POST["Location"];
$argvstr = $a . "World!"; // now $b contains "Hello World!"
$a="";

if(empty($sttime) ||empty($endtime)  )
{
 echo "Please input the start/end time.";
 echo "<a href=\"./self6.php\">Click here to reselect the time</a> ";
}


//  echo('您的选择结果是：');  
//  echo $tblname;
//if(!empty($cbox)){    //!empty($_POST['cbox'])  
//  echo('您的选择结果是：');  
//  echo (count($cobx));
//  for($i=0; $i<count($cbox);$i++){  
//    $a .= $cbox[$i];
//    $a .= "    ";
//  }  
//  echo $a."<br>";
////  print_r($cbox);  

else{
  $_SESSION["time_start"]=$sttime;
  $_SESSION["time_end"]=$endtime;
 $aa = array('Chengdu', 'Kunming', 'Beijing', 'Panzhihua','Shenzhen','Shanghai','Liangshan');
       for($j=0; $j<count($aa); $j++){
          $sloca = $aa[$j] ;
         if(isset($_SESSION[$sloca]))  {
            $a .= "@@ ";
            $a .= $sloca;
            $a .= "  ";
            $rest = $_SESSION[$sloca];
            for($i=0; $i<count($rest);$i++){  
               $a .= $rest[$i];
               $a .= "    ";
        }
      }

  }
  $result =  "python /home/pi/wserv.py " . $sttime  ." " . $endtime   ." " . $a ; 
  print_r($result);
 system($result); 

}
?>

</html>
