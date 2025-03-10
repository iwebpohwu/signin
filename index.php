<?php
if($_GET['s'] == "s")
{
  header("Refresh:0;url=\"./status.php\"");
  exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <title>TZGJZX Class 2 Signin</title>
        <link rel="stylesheet" href="//cdnjs.loli.net/ajax/libs/mdui/0.4.3/css/mdui.min.css">
        <script src="//cdnjs.loli.net/ajax/libs/mdui/0.4.3/js/mdui.min.js"></script>
    </head>
    <header class="mdui-appbar mdui-appbar-fixed">
        <body background="https://time.xsot.cn/img/background.png" class="mdui-appbar-with-toolbar">
            <div class="mdui-toolbar mdui-color-theme"> <a class="mdui-typo-title">學生簽到系統</a>

            </div>
    </header>
    <br />
    <div class="mdui-container doc-container">
        <div class="mdui-typo">
             <h2>簽到</h2>
            <p>當前時間:
                <?php echo date( "H時i分s秒") ?>
            </p>
            <div class="mdui-textfield">
                <input id="name" time="name" class="mdui-textfield-input" type="text" placeholder="姓名" />
            </div>
            <br>
            <center>
            <button onClick="Submit();" id="Submit" class="mdui-btn mdui-btn-dense mdui-color-grey-300"><i class="mdui-icon material-icons">&#xe569;</i></button>
            </center>
        </div>
    </div>
    <br />
    <div class="mdui-container">
    <div class="mdui-typo">
      <h2 class="doc-chapter-title doc-chapter-title-first">注意</h2>
      &emsp;你可以在每天的 6:50-7:10 | 13:20-13:40 | 18:20-18:40 進行簽到<br />
    </div>
    </div>
    <br />
    <script>
    function Submit() {
        document.getElementById("Submit").innerHTML = "簽到中...";
        var name = document.getElementById("name").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./submit.php");
        xhr.setRequestHeader('Content-Type', ' application/x-www-form-urlencoded');
        xhr.send("name=" + name);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("Submit").innerHTML =
                    "<i class=\"mdui-icon material-icons\">&#xe569;</i>";
                if (xhr.responseText == 200) {
                    mdui.dialog({
                        title: '簽到成功',
                        content: '學習這件事不在乎有沒有人教你，最重要的是在於你自己有沒有覺悟和恒心.<br />--法國昆蟲學家,動物行為學家,文學家 法布林',
                        modal: true
                    });
                } else {
                    mdui.alert(xhr.responseText, '簽到失敗');
                }
            }
        }
    }
    </Script>
    </body>
</html>
