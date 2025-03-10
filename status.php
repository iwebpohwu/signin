<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign-in statistics</title>
</head>
<body>
  <?php
  require_once('ip.php');
  $time = time();
  $conn = mysqli_connect("localhost","qd","qdqdqd","qd");
  //資料庫

  echo"<h3>未簽到：</h3>";
  echo "<table rules=none>";
  $j = 0;
  $sql = "SELECT * FROM `user`";
  $re = mysqli_query($conn,$sql);
  while ($row = mysqli_fetch_object($re)) {
    $id = $row->id;
    $name = $row->name;
    $time = $row->time;
    if (empty($time)) {
      $j++;
      echo "<tr>
          <td>$name</td>
          </tr>";
    }
  }
  echo "</table>";



  /*******************************/



  echo "<br /><br /><br /><h3>已簽到:</h3>";
  echo "<table rules=none>";
  $i = 0;
  $sql = "SELECT * FROM `user` order by time";
  $re = mysqli_query($conn,$sql);
  while ($row = mysqli_fetch_object($re)) {
    $id = $row->id;
    $name = $row->name;
    $time = $row->time;
    $ip = $row->ip;
    if (!empty($time)) {
      $i++;
      $times = date("H:i:s",$time);
      echo "<tr>
        <td>$name</td>
        <td>,&emsp;<td>
        <td>$times</td>
        </tr>";
    }
  }
  echo "</table>";
  echo "<br /><br /><br /><h3>總計：</h3>簽到" . $i . "人,未簽到 " . $j . "人";
  echo "<br /><br /><a href=\"./forsignin.php\">歷史記錄</a><br />";
  echo "Tip:清除記錄功能暫時移除,由程式於每天在簽到前1小時左右自動清除";
  ?>
</body>
