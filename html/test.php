<?php


//$array = array( 'foo' => array('bar' => 'boz'));
//$foo = 'foo'; $bar = 'bar';
//$arr = array("one", "two", "three");
$arr = array(
'foo' => array('bar' , 'boz')
);
$foo = 'foo'; $bee = 'bee';
$arr[$bee]= array('dd','gg');
print_r( $arr[$foo]);
print_r( $arr[$bee]);

//foreach ($arr as $value) {
//    echo "Value: $value<br />\n";
//}
?>

