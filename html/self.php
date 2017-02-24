<?php
   if(isset($_POST['submit_button']))
      echo($_POST['loginUsername']);
?>

<form name="bizLoginForm" method="post" action"<?php echo $_SERVER['PHP_SELF']?>" >
  <table id="loginTable">
    <tr><td>Username:</td><td><input type="text" name="loginUsername" /></td></tr>
    <tr><td>Password:</td><td><input type="password" name="loginPassword" /></td></tr>
  </table>
  <input type="Submit" name="submit_button" value="Login" />
</form>
