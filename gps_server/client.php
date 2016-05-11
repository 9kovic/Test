<?php
/**
 * File name:client.php
 * 客户端代码
 *
 * @author guisu.huang
 * @since 2012-04-11
 */

    //echo $_POST['input'];

    $host = "202.115.113.119";
    $port = 80;
	$input = "1010010011010101101101010101010101010";
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)or die("Could not create  socket\n"); // 创建一个Socket

    $connection = socket_connect($socket, $host, $port) or die("Could not connet server\n");    //  连接
    for($i=0;$i<10;$i++){
        socket_write($socket, $input) or die("Write failed\n"); // 数据传送 向服务器发送消息
        echo $i."\n";
		//sleep(1);
    }

   /* while ($buff = socket_read($socket, 1024, PHP_NORMAL_READ)) {
        echo("Response was:" . $buff . "\n");
    }*/
    //socket_close($socket);





?>

