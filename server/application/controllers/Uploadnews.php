
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Uploadnews extends CI_Controller {
public function index() {   
 $appid='wx3874ef0027a36124';//appid需自己提供，此处的appid我随机编写
    $secret='56cc5881e05aab100fe56c13e2e13da6';//secret需自己提供，此处的secret我随机编写
    $code = $_POST['code'];//小程序传来的code值
    
    $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=wx3874ef0027a36124&secret=56cc5881e05aab100fe56c13e2e13da6&js_code=' . $code . '&grant_type=authorization_code';
    //yourAppid为开发者appid.appSecret为开发者的appsecret,都可以从微信公众平台获取；
    $info = file_get_contents($url);//发送HTTPs请求并获取返回的数据，推荐使用curl
    $json = json_decode($info);//对json数据解码
    $arr = get_object_vars($json);
  $openid = $arr['openid'];
    $session_key = $arr['session_key'];
    $hostname_conn = "localhost";
    $database_conn = "cAuth";//自己建数据库名
    $username_conn = "root";
    $password_conn = "dEc23KrC";
    $title=$_POST['title'];
    $author='';
      $article1=$_POST['article'];
      $id='';
  
    // $article1=str_replace("\n",CHAR(10),$article);
     
   $artnum=$_POST['artnum'];
        $conn = mysqli_connect($hostname_conn, $username_conn, $password_conn,$database_conn)or trigger_error(mysqli_error(),E_USER_ERROR);

    if(!$conn){
        
        echo "连接不成功！";  
    }

$sql = "  SELECT author FROM `user` WHERE openid='$openid'";
mysqli_query($conn, "set id 'utf8'");
$result = mysqli_query($conn, $sql);

$result= $conn->query($sql);
   
 if($result->num_rows >0){
    while($row=$result->fetch_row()){
  $author= $row[0];

 
}
}else{
    echo "query failed";
}


$sql = "  SELECT id FROM `user` WHERE openid='$openid'";
mysqli_query($conn, "set id 'utf8'");
$result = mysqli_query($conn, $sql);

$result= $conn->query($sql);
   
 if($result->num_rows >0){
    while($row=$result->fetch_row()){
  $id= $row[0];

 
}
}else{
    echo "query failed";
}

  

 $sql = "UPDATE `preview` SET `title`='$title' WHERE `artnum`= '$artnum'";
   mysqli_query($conn, "set id 'utf8'");
   $result = mysqli_query($conn, $sql);
   $result= $conn->query($sql);


 $sql = "UPDATE `preview` SET `author`='$author' WHERE `artnum`= '$artnum' ";
   mysqli_query($conn, "set id 'utf8'");
   $result = mysqli_query($conn, $sql);
   $result= $conn->query($sql);

    $sql = "UPDATE `preview` SET `article`='$article1' WHERE `artnum`= '$artnum' ";
   mysqli_query($conn, "set id 'utf8'");
   $result = mysqli_query($conn, $sql);
   $result= $conn->query($sql);

 $sql = "UPDATE `preview` SET `auid`='$id' WHERE `artnum`= '$artnum' ";
   mysqli_query($conn, "set id 'utf8'");
   $result = mysqli_query($conn, $sql);
   $result= $conn->query($sql);


$rs=json_encode($artnum);
exit($rs);

    



}
}

?>