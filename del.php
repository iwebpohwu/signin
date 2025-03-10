<?php
require_once('ip.php');
$time = time();
$conn = mysqli_connect("localhost","qd","qdqdqd","qd");
$passwd = $_GET['p'];
if ($passwd == "passwd") {
  //主體
  $i = 0;
  //未簽到人數初始化
  $j = 0;
  //總人數初始化
  $name = array();
  //未簽到人名陣列初始化  完了，學完c++，php的陣列不會寫了
  $sql = "SELECT * FROM `user`";
  $re = mysqli_query($conn,$sql);
  while ($row = mysqli_fetch_object($re)) {
    $id = $row->id;
    $j++;
    //已簽到人數++
    if (empty($row->time)) {
      $i++;
      //為簽到人數++
      $name[] = $row->name;
    }
    $sqlx = "update `user` SET time = '' , ip='' where id ='$id'";
    @mysqli_query($conn,$sqlx);
    //刪除記錄
  }

  $z = $j -$i;
  //計算已簽到人數;
  //print_r($name);
  //$lenth = count($name);  //腦殘，陣列長度不就等於為簽到人數嗎，，笑死我了哈哈哈笑自己
  for ($q = 0;$q <= $i - 1;$q++) {
    $nameall .= $name[$q];
    if ($q !== $i-1) {
      $nameall .= "<br />";
      //防止最後多插入一個都逗號
    }
  }
  //echo $nameall;
  $timex = date("H");
  if ($timex <= 8) {
    $timec = date("m月d日",strtotime("-1 day"));
    $times = "晚";
  } elseif ($timex < 14) {
    $timec = date("m月d日");
    $times = "早";
  } else {
    $timec = date("m月d日");
    $times = "午";
  }
  $record = "INSERT INTO `history` VALUES('$time','$timec','$times','$z','$i','$nameall');";
  $up = mysqli_query($conn,$record);
  //記錄至歷史表
  echo "<h1>成功!</h1>";
  @$log = "INSERT INTO `log` VALUES('del','成功','$ip','$time')";
  @mysqli_query($conn,$log);
  //日誌
} else {
  echo "<h1>密碼錯誤!!</h1>";
  @$log = "INSERT INTO `log` VALUES('del','失敗','$ip','$time')";
  @mysqli_query($conn,$log);
  //日誌
}
?>
