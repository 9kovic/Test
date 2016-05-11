<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/2
 * Time: 10:57
 */

use Workerman\Worker;
require "Workerman/Autoloader.php";
include('functions.php');

// 创建一个Worker监听2347端口，不使用任何应用层协议
$tcp_worker = new Worker("tcp://202.115.113.119:80");

// 启动4个进程对外提供服务
$tcp_worker->count = 4;

// 当客户端发来数据时
$tcp_worker->onMessage = function($connection, $data)
{
    //接受客户端数据
    $data = strtoupper(bin2hex($data));  // 将2进制数据转换成16进制

    //获取客户端数据数组
    $a_data = strToArr($data);
	//print_r($a_data);
    //获取协议标志位
    $flag = $a_data[3];
	
	//print_r($a_data);
    //判断协议类型
    switch ($flag) {
        //登录信息包
        case '01':
            $temp = retResStr($a_data);        
            sendData($temp, $connection);
            //file_put_contents ( './log.txt' ,  $data ,  FILE_APPEND  |  LOCK_EX );
            break;
        //状态信息包
        case '13':
            $temp = retResStr($a_data);
            //print_r($a_data[3]);
            sendData($temp, $connection);
            //file_put_contents ( './log.txt' ,  $data ,  FILE_APPEND  |  LOCK_EX );
            break;
        //gps lbs 合并信息包
        case '12':
            //print_r($a_data);
            $time = "20".hexdec($a_data[4])."-". hexdec($a_data[5]) ."-".hexdec($a_data[6]) . " ".hexdec($a_data[7]) .":". hexdec($a_data[8]) . ":".$time = hexdec($a_data[9]);
            $wd = $a_data[11].$a_data[12].$a_data[13].$a_data[14];
            $jd = $a_data[15].$a_data[16].$a_data[17].$a_data[18];

            $wd = hexdec($wd)/30000/60;
            $jd = hexdec($jd)/30000/60;
			echo $connection->getRemoteIp()."\n";
            echo "time:".$time."\n";
			echo "jd:".$jd."wd:".$wd."\n";
            //$db = getDB();
            //$db->query("INSERT INTO c_bike_trace (trace_jd,trace_wd,trace_time,bike_id) VALUES ($jd,$wd,$time,1)");
            break;
        default:
			echo "default:";
			print_r($a_data);
            //printf("Buffer: " . $data . "\n");
            //file_put_contents ( './log.txt' ,  $data ,  FILE_APPEND  |  LOCK_EX );
            break;
    }

};

// 运行worker
Worker::runAll();