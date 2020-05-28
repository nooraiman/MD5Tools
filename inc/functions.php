<?php
include("db.php");

function encode()
{
  global $connection;
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
  else
  {
    $query = "INSERT INTO md5(hash,text) values ('$encoded','$text')";
    $result = mysqli_query($connection,$query);

    if(!$result)
    {
      die('Query Failed' . mysqli_error());
    }
    else
    {
      echo "Text: " . $text . "<br>";
      echo "Hash: " . $encoded . "<br>";
    }
  }
}

function decode()
{
  global $connection;
  $hash = $_POST['vars'];
  $hashLength = strlen($hash);  // Get the character length

  if($hashLength == 32)
  {
      $query = mysqli_query($connection,"SELECT * FROM `md5` where hash='$hash' ");
      $checkrows = mysqli_num_rows($query);

      if($checkrows > 0)
      {
        while($rows = mysqli_fetch_assoc($query))
        {
          echo "Hash: <b>" . $rows['hash'] . "</b><br>";
          echo "Text: <b>" . $rows['text'] . "</b><br>";
        }
      }
      else {
          echo "Hash: <b>" . $rows['hash'] . "</b><br>";
          echo "Text: <b>Not Found</b><br>";
      }
  }
  else
  {
    echo "Invalid MD5 Hash: " . $hash;
  }
}
?>
