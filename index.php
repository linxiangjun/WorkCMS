<!--
    WorkCMS version beta
    Make write work diary more easier!
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="author" content="Write By LXJ ">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  </style>
  <title>WorkCMS</title>
  <link rel="shortcut icon" type="images/x-icon" href="">
  <link rel="bookmark" href="">
  <script type="text/javascript" src="./script/jquery-3.1.1.min.js"></script>
  <style media="screen">
    /*公用样式*/
    *{ margin: 0; padding: 0; font-family: 'Microsoft YaHei'; }
    a{color: #000000}
    /*列表和内容样式*/
    .workList{width: 100%;height: 500px;overflow: auto;}
    @media (max-width: 768px){.workList{width: 100%;height: 300px;overflow: auto;}}
    .workContent{width: 100%;height: auto;}
    .btn-submit{margin-top: 20px;margin-left: 5%}
    .btn-reset{margin-top: 20px;margin-left:20px}
    .textStyle{width: 90%;height: 300px;margin-left: 5%}
    .workTitle{padding: 10px}
    .workList div span:hover{cursor: pointer}
    .workTitle h2{border-bottom: 3px solid #AAAAAA}
    .workList span{font-size: 18px;display: inline-block;padding: 5px 0px 10px 10px}
  </style>
</head>
<body>
  <div class="container" style="background-color: #DDDDDD;">
    <div class="row">
      <div class="col-xs-12 col-md-3 col-lg-3">
        <div class="workList">
          <div class="workTitle">
            <h2>文章列表</h2></div>
            <?php
            include_once('./tool.php');
            $sql = "select * from notebook order by id desc";
            $res = $con -> query($sql);
            while($row = $res -> fetch_array()){
              $URL = 'index.php?data='.$row['id'];
              echo "<div><a href='$URL'><span>".$row['id']."、".$row['name']."</span></a></div>";
            }
            ?>
        </div>
      </div>
      <div class="col-xs-12 col-md-9 col-lg-9">
        <div class="workContent">
          <div class="workTitle"><h2>编辑内容</h2></div>
            <form action="upload.php" method="post" id="iform">
              <?php
                if(!empty($_GET['data']))
                {
                  $data = $_GET['data'];
                  if (!get_magic_quotes_gpc()) {    //防SQL注入
                    addslashes($data);
                  }
                }else
                {
                  $data = 1;    //默认取工作本的第一条数据
                }
                  include_once('./tool.php');
                  $sql = "select text from notebook where id = '$data'";
                  $res = $con -> query($sql);
                  if($row = $res -> fetch_array()){
                    echo "<textarea name='editContent' class='textStyle' required>";
                    echo $row['text'];
                    echo "</textarea>";
                  }else{
                    echo "<textarea name='editContent' class='textStyle' required>";
                    echo "</textarea>";
                  }
              ?>
              <input type="submit" class="btn btn-primary btn-submit"></input>
              <input type="reset" class="btn btn-danger btn-reset"></input>
            </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
