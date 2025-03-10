<?php
require_once('ip.php');
$time = time();
$conn = mysqli_connect("localhost","qd","qdqdqd","qd");


  $name = trim($_POST['name']);   //去除左右空格
  $sql = "SELECT * FROM `user` where name = '$name'";
  $re = mysqli_query($conn,$sql);
  $arr = mysqli_fetch_assoc($re);
  
  if (empty($arr['name'])) {
    echo "姓名為空或非本班同學!";
    if (!empty($name)) {
      @$log = "INSERT INTO `log` VALUES('非本班同學','$name','$ip','$time')";
      @mysqli_query($conn,$log);
      //日誌
    }
    exit();
    }
  //本班同學檢測
  
  if (!empty($arr['time'])) {
    echo "您已經簽過到了";
    @$log = "INSERT INTO `log` VALUES('重複簽到','$name','$ip','$time')";
    @mysqli_query($conn,$log);
    //日誌

    exit();
  }
  $timex = date("Hi");
  if(($timex>="650"&&$timex<"710") || ($timex>="1320"&&$timex<"1340") || ($timex>="1820"&&$timex<"1840"))
  {
    //通過
  }else{
   echo "非規定簽到時間!<br />你可以在每天的 6:50-7:10 | 13:20-13:40 | 18:20-18:40 進行簽到";
   @$log = "INSERT INTO `log` VALUES('非規定時間簽到','$name $timex','$ip','$time')";
   @mysqli_query($conn,$log);
   exit();
  }
    //簽到時間檢測
    
    if (empty($ip)) {
      $strPol = "0193wie452687qazplmxnskdjurythfgvc";
      $max = strlen($strPol)-1;
      for ($i = 0;$i < 20; $i++) {
        $ip.= $strPol[rand(0,$max)];
      }
      goto pass;
    }  
      //防止出現空IP以免出事



    $checkip = "SELECT * FROM `user` where ip = '$ip'";
    $recheckip = mysqli_query($conn,$checkip);
    $arr = mysqli_fetch_assoc($recheckip);
    if (!empty($arr)) {
      echo "<h1>請勿代簽!</h1>";
      @$s = "SELECT * FROM `user` WHERE ip = '$ip';";
      @$ss = mysqli_query($conn,$s);
      @$sss = mysqli_fetch_assoc($ss);
      @$namex = $sss['name'];
      @$namexx = $namex . " 幫 " . $name . " 代簽";
      @$log = "INSERT INTO `log` VALUES('代簽','$namexx','$ip','$time')";
      @mysqli_query($conn,$log);
      exit();
    }
    //代簽檢測
    
    pass:
  

//通過，進行簽到
  $sql = "update `user` SET time = '$time' , ip='$ip' where name ='$name'";
  mysqli_query($conn,$sql);
  //簽到

  @$log = "INSERT INTO `log` VALUES('簽到','$name','$ip','$time')";
  @mysqli_query($conn,$log);
  //日誌

  echo "200";

