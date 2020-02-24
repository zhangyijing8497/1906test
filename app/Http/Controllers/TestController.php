<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * 请求接口服务器
     * 2020年2月20日19:13:32
     */
    public function test()
    {
        $key = "1906api";
        $data = "Long time no see";
        $sign = md5($data.$key);
        $url = "http://zyj.fanhanxiao.cn/test/verifySign?data=".$data."&sign=".$sign;
        echo $url;echo '<hr>';
        $response = file_get_contents($url);
        var_dump($response);
    }


    public function encrypt()
    {
        $str = 'hello';
        // echo "原文:" .$str;echo '</br>';

        $length = strlen($str);
        // echo "长度:" . $length;echo '<hr>';

        $new_str = "";
        for($i=0;$i<$length;$i++){
            // echo $str[$i] . " -> " . ord($str[$i]);
            // echo '</br>';
            $code = ord($str[$i])+1;
            // echo "编码 $str[$i]" . "->" .$code . "->" .chr($code);
            // echo '</br>';
            $new_str .= chr($code);
        }
        // echo '<hr>';
        // echo "密文:" .$new_str;echo '</br>';die;

        // 请求接口 发送数据
        $url = 'http://api.1906.com/test/decrypt?str='.$new_str;
        $response = file_get_contents($url);
        var_dump($response);
    }


    public function decrypt()
    {
        // $data = $_GET['str'];
        $data = "Mpoh!ujnf!op!tff";
        echo "密文:".$data;echo '</br>';

        $length = strlen($data);

        $str = '';
        for($i=0;$i<$length;$i++){
            echo $data[$i] . "->" . ord($data[$i]);
            echo '</br>';
            $code = ord($data[$i])-1;
            echo "解密:" . "->" .$data[$i] . "->" .chr($code);
            echo '</br>';
            $str.=chr($code);
        }
        echo '<hr>';
        echo $str;
    }

    public function encrypt1()
    {
        $key = '1906api';

        $data = "Nice to meet you";//要加密的数据
        $method = 'aes-128-cbc'; //加算法
        $iv = 'jcdqwertyuiazcjj';
        $enc_str = openssl_encrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);
        echo "加密后的密文:".$enc_str;echo '</br>';
        $base64_str = base64_encode($enc_str);  //将密文base64编码
        echo "base64编码后的密文:".$base64_str;
        // var_dump($base64_str);
        echo '<hr>';

        // 将加密后的数据发送出去

        $url = 'http://api.1906.com/test/decrypt1?data='.$base64_str;
        $response = file_get_contents($url);
        var_dump($response);
    } 
    
    public function encrypt2()
    {
        $key = '1906api';

        $data = "php";//要加密的数据
        $sign = md5($data.$key);

        $method = 'aes-128-cbc'; //加算法
        $iv = 'poiuytrewqasdfgh';
        $enc_str = openssl_encrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);
        echo "加密后的密文:".$enc_str;echo '</br>';
        $base64_str = base64_encode($enc_str);  //将密文base64编码
        echo "base64编码后的密文:".$base64_str;
        // var_dump($base64_str);
        echo '<hr>';

        // 将加密后的数据发送出去

        $url = 'http://api.1906.com/test/decrypt2?data='.$base64_str . '&sign=' . $sign;
        echo $url;echo '</br>';

        $response = file_get_contents($url);
        var_dump($response);
    }
}
