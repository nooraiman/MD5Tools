<?php
include("inc/db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>MD5 Tools</title>
  <script type="text/javascript" src="/v3/ruxitagentjs_ICA2SVfghjqrux_10191200518082328.js" data-dtconfig="rid=RID_1762657397|rpid=216169431|domain=uitm.edu.my|reportUrl=/v3/rb_bed8d9ce-f533-445a-b185-0949b89571e4|app=17d402e2bb72c628|ssc=1|featureHash=ICA2SVfghjqrux|rdnt=1|uxrgce=1|bp=3|cuc=xv5a9vn8|srms=1,0,,,|uxrgcm=100,25,300,3;100,25,300,3|dpvc=1|md=2=a#content ^rb div.navbar.hidden-print.navbar-default.main ^rb div.user-action.pull-left.menu-right-hidden-xs.menu-left-hidden-xs.border-left ^rb div ^rb a ^rb span ^rb span|bismepl=2000|lastModification=1590630431386|dtVersion=10191200518082328|tp=500,50,0,1|uxdcw=1500|agentUri=/v3/ruxitagentjs_ICA2SVfghjqrux_10191200518082328.js"></script><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
