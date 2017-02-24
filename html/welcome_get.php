<html>
<body>

 <?php 
$result =  "python /home/user/pys.py " . $_GET["name"]  ." "  . $_GET["cbox1"]; 
system($result); 
?>
Welcome <?php echo $_GET["name"]; ?><br>
Your email address is: <?php echo $_GET["cbox1"]; ?>

</body>
</html>
