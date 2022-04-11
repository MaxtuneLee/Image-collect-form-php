<?php 
$env = "production";
switch($_FILES["file"]["type"])
{
case "image/jpeg":
    $ext = ".jpg";
    break;
case "image/gif":
    $ext = ".gif";
    break;
case "image/png":
    $ext = ".png";
    break;
default:
    $ext = ".jpg";
    break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <script src="./index.js"></script>
    <title>信息已提交</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-9 col-sm-9">
                <div class="titles mb-5">
                    <h1 class="formTitle">你的信息已提交</h1>
                    <h6 class="formSubtitle">如有疑问请联系管理员</h6>
                </div>
                <div class="information">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5>
                            <?php
                                // 判断当期目录下的 upload 目录是否存在该文件
                                if (file_exists("upload/" . $_POST["studentId"] . $_POST["name"] . ".".$ext))
                                {
                                    echo "文件错误：你已经上传过啦，有问题请联系管理员";
                                }
                                else{
                                    echo "姓名：". $_POST["name"] ."<br/>"."学号：".$_POST["studentId"]."<br/>"."文件：上传成功";
                                }
                                ?>
                                </h5>
                            <h5><?php
                                if ($_FILES["file"]["error"] > 0)
                                {
                                echo "错误: " . $_FILES["file"]["error"] . "<br />";
                                }
                              else
                                {
                                    if($env == "develop"){
                                        echo "文件名: " . $_FILES["file"]["name"] . "<br />";
                                        echo "文件类型: " . $_FILES["file"]["type"] . "<br />";
                                        echo "大小: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                                    }
                                if (!file_exists("upload/" . $_POST["studentId"] . $_POST["name"] . ".".$ext))
                                {
                                    move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
                                    $finishRename = rename("upload/" . $_FILES["file"]["name"], "upload/" . $_POST["studentId"] . $_POST["name"] . ".".$ext);
                                    if($env == "develop"){
                                        echo "文件存储在: " . "upload/" . $_FILES["file"]["name"]."<br/>";
                                        if ($finishRename){
                                            echo "文件重命名成功";
                                        }
                                        else{
                                            echo "文件重命名失败";
                                        }
                                    }
                                }
                                }
                            ?></h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>

</html>