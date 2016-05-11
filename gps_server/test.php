<?php

include('functions.php');
/*
Time:22:23:11 - Received Data From Connection: 119.4.254.134-54360

0000: 78 78 0D 01 08 67 12 00 00 01 44 32 00 05 75 A2           xx...g....D2..u.
0010: 0D 0A                                                                                 ..

Time:22:22:11 - Received Data From Connection: 119.4.254.134-54360

0000: 78 78 0D 01 08 67 12 00 00 01 44 32 00 04 64 2B           xx...g....D2..d+
0010: 0D 0A                                                                                 ..

Time:22:22:6 - Received Data From Connection: 119.4.254.134-54360

0000: 78 78 0D 01 08 67 12 00 00 01 44 32 00 03 10 94           xx...g....D2....
0010: 0D 0A                                                                                 ..

Time:22:22:6 - New Connection Detected: 119.4.254.134-54360

D:\phpStudy\php53\php.exe D:\phpStudy\WWW\gps_test\test.php
D:\phpStudy\php53\php.exe D:\phpStudy\WWW\gps_test\test1.php

Buffer: 78781F120F0B1E0C3B17C803485CCE0B2AE98F00140001CC01811100F3FD000480B20D0A
78781F120F0B1E0D090FC7034858620B2AEA3300140001CC01811100F3FF00069F380D0A78781F12
0F0B1E0D091EC703485A5E0B2AE90501155F01CC01811100F3FF00089FFB0D0A78781F120F0B1E0D
092DC503485A7E0B2AE90F02149401CC01811100F3FF000A792C0D0A78781F120F0B1E0D0A00C803
48588D0B2AEA6500140001CC01811100F3FF000C07F10D0A78781F120F0B1E0D0B0FC60348578C0B
2AEB3D00140001CC01811100F3FF000EA9710D0A

Buffer: 78780A134406040001000FBBCE0D0A
Closed the socket

Buffer: 78780D0108671200000144320010328E0D0A

D:\phpStudy\php53\php.exe D:\phpStudy\WWW\gps_test\test.php


长度=协议号+信息内容+信息序列号+错误校验，
共（5+N）Byte，因为信息内容为不定长字段。

*/


//获取tcp协议号码。
$tcp = getprotobyname("tcp");
// 建立server端socket ，创建并返回一个套接字，也称作一个通讯节点。一个典型的网络连接由 2 个套接字构成，一个运行在客户端，另一个运行在服务器端。
$socket = socket_create(AF_INET, SOCK_STREAM, $tcp);
//绑定要监听的ip和端口，这里绑定的ip一定要写局域网ip，写成127.0.0.1客户端将无法与服务端建议连接。
socket_bind($socket, '211.149.150.248', 801);
//监听端口
socket_listen($socket);

while (true) {
    // 接受客户端请求过来的一个socket连接
    $connection = socket_accept($socket);
    if (!$connection) {
        echo "connect faild";
    } else {
        // 从客户端获取得的数据
        while ($data = @socket_read($connection, 1024, PHP_BINARY_READ)) {

            //接受客户端数据
            $data = strtoupper(bin2hex($data));  // 将2进制数据转换成16进制

            //获取客户端数据数组
            $a_data = strToArr($data);

            //print_r($a_data);
            //获取协议标志位
            $flag = $a_data[3];
            //判断协议类型
            switch ($flag) {
                //登录信息包
                case '01':
                    $temp = retResStr($a_data);
                    print_r($a_data[3]);
                    sendData($temp, $connection);
                    //file_put_contents ( './log.txt' ,  $data ,  FILE_APPEND  |  LOCK_EX );
                    break;
                //状态信息包
                case '13':
                    $temp = retResStr($a_data);
                    print_r($a_data[3]);
                    sendData($temp, $connection);
                    //file_put_contents ( './log.txt' ,  $data ,  FILE_APPEND  |  LOCK_EX );
                    break;
                //gps lbs 合并信息包
                case '12':
                    print_r($a_data[3]);
                    $time = hexdec($a_data[4]) . hexdec($a_data[5]) . hexdec($a_data[6]) . hexdec($a_data[7]) . hexdec($a_data[8]) . $time = hexdec($a_data[9]);
                    $wd = $a_data[11].$a_data[12].$a_data[13].$a_data[14];
                    $jd = $a_data[15].$a_data[16].$a_data[17].$a_data[18];
                    $wd = hexdec($wd)/30000/60;
                    $jd = hexdec($jd)/30000/60;

                    echo "time:".$time."经度:".$jd."纬度:".$wd;
                //file_put_contents ( './log.txt' ,  $data ,  FILE_APPEND  |  LOCK_EX );


                default:
                    printf("Buffer: " . $data . "\n");
                    //file_put_contents ( './log.txt' ,  $data ,  FILE_APPEND  |  LOCK_EX );
                    break;
            }


        }
    }

    //关闭 socket
    socket_close($connection);
    printf("Closed the socket\n");
    printf("Closed the socket\n");
    printf("Closed the socket\n");
    printf("Closed the socket\n");
}
?>