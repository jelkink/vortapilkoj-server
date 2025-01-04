<h2>Serĉu vortojn</h2>

<form action="index.php?page=words&session=<?php echo $sessionid ?>" method="post">
  <table>
    <tr valign="top">
      <td>Serĉu:</td>
      <td><input type="text" name="search" required></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="Serĉi"></td>
    </tr>
  </table>