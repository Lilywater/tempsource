
<html>
<body>

<select name="name">
<?php
$aa = array("foo", "bar", "hello", "world");
$tt = "bar";
foreach ($aa as $key => $item) {
  $array[$key + 1] = $item + 2;
  $opt="<option value =\"";
  if($item != $tt)
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
</body>
</html>

