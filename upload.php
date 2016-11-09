<?php
   include_once "./tool.php";

   date_default_timezone_set('Asia/Shanghai');
   $date = date('Y.m.d');
   $week = date('w');
   $title = '工作内容'.$date;
   $content = $_POST['editContent'];
   //防SQL注入
   if (!get_magic_quotes_gpc()) {
     addslashes($content);
   }

   $sql = "select id from notebook where name = '$title'";
   $res = $con -> query($sql);
   var_dump($res);
   if($row = $res -> fetch_assoc())
   {
     $sql = "update notebook set text='$content' where name = '$title'";
     $con -> query($sql);
     header("Location:index.php?success=1");
     exit();
   }else
   {
     $sql = "insert into notebook(name,text) values('$title','$content')";
     $con -> query($sql);
     header("Location:index.php?success=1");
     exit();
   }

   mysqli_close($con);
 ?>
