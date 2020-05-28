<?php
include("inc/functions.php")
?>
<!DOCTYPE html>
<html>
<head>
  <title>MD5 Tools</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--
    Coded by Noor Aiman.
    Templates: Bootstrap
      -->
</head>
<body style="background-color: #2A3135;">
  <br>
  <div class="container">
    <form method="post" style="background: #fff;padding: 20px; width: 400px;margin: auto;border-radius:10px;box-shadow: 0px 0px 5px 0px #000;">
      <label for="vars">Text/Hash: </label> <input type="text" name="vars" maxlength="32" required class="form-control"> <br>
      <input type="submit" name="encode" value="Encode" class="btn btn-primary">
      <input type="submit" name="decode" value="Decode" class="btn btn-danger">
      <input type="reset" name="reset" value="Reset" class="btn btn-secondary">
    </form>
  </div>
  <br>

  <?php
  if(isset($_POST['encode']))
  {
    echo "<div class='container' style='background: #fff;padding: 20px; width: 400px;margin: auto;border-radius:10px;box-shadow: 0px 0px 5px 0px #000;'>";
    encode();
    echo "</div>";
  }
  else if(isset($_POST['decode']))
  {
    echo "<div class='container' style='background: #fff;padding: 20px; width: 400px;margin: auto;border-radius:10px;box-shadow: 0px 0px 5px 0px #000;'>";
    decode();
    echo "</div>";
  }
  ?>

</body>
</html>
