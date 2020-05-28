<?php
include("inc/db.php");
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
    $text = $_POST['vars'];
    $encoded = md5($text);

    $query = mysqli_query($connection, "SELECT * FROM `md5` WHERE hash='$encoded' and text='$text' " );
    $checkrows=mysqli_num_rows($query);

    if($checkrows > 0)
    {
      while ($rows = mysqli_fetch_assoc($query))
      {
        echo "Text: <b>" . $rows['text'] . "</b><br>";
        echo "Hash: <b>" . $rows['hash'] . "</b><br>";
      }
    }
    else {
      $query = "INSERT INTO md5(hash,text) values ('$encoded','$text')";
      $result = mysqli_query($connection,$query);

      if(!$result)
      {
        die('Query Failed' . mysqli_error());
      }
      else {
        echo "Text: " . $text . "<br>";
        echo "Hash: " . $encoded . "<br>";
      }
    }
	echo "</div>";
  }
  else if(isset($_POST['decode']))
  {
    $hash = $_POST['vars'];
    $hashLength = strlen($hash);
	echo "<div class='container' style='background: #fff;padding: 20px; width: 400px;margin: auto;border-radius:10px;box-shadow: 0px 0px 5px 0px #000;'>";
    if($hashLength == 32)
    {
      $query = mysqli_query($connection,"SELECT * FROM `md5` where hash='$hash' ");
      $checkrows = mysqli_num_rows($query);

      if($checkrows > 0)
      {
        while ($rows = mysqli_fetch_assoc($query))
        {
          echo "Hash: <b>" . $rows['hash'] . "</b><br>";
          echo "Text: <b>" . $rows['text'] . "</b><br>";
        }
      }
      else
      {
          echo "Hash: " . $hash . "<br>";
          echo "Text: Not Found! <br>";
      }
    }
    else {
      echo "Invalid MD5 Hash: " . $hash;
    }
    echo "</div>";
  }
?>

</body>
</html>
