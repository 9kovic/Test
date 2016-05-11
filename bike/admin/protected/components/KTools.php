<?php


class KTools
{
    /**
     * 获取两个gps坐标之间的距离
     * @param $lat1
     * @param $lng1
     * @param $lat2
     * @param $lng2
     * @return float
     */
    function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6367000; //approximate radius of earth in meters

        /*
        Convert these degrees to radians
        to work with the formula
        */

        $lat1 = ($lat1 * pi()) / 180;
        $lng1 = ($lng1 * pi()) / 180;

        $lat2 = ($lat2 * pi()) / 180;
        $lng2 = ($lng2 * pi()) / 180;


        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;

        return round($calculatedDistance);
    }


    /**
     * 百度地图坐标转换成gps坐标
     * @param $lnglat
     * @return array|string
     */
    function FromBaiduToGpsXY($lnglat)
    {
        // 经度,纬度
        $lnglat = explode(',', $lnglat);
        list($x, $y) = $lnglat;
        $Baidu_Server = "http://api.map.baidu.com/ag/coord/convert?from=0&to=4&x={$x}&y={$y}";
        $result = @file_get_contents($Baidu_Server);
        $json = json_decode($result);
        if ($json->error == 0) {
            $bx = base64_decode($json->x);
            $by = base64_decode($json->y);
            $GPS_x = 2 * $x - $bx;
            $GPS_y = a2 * $y - $by;
            return $GPS_x . ',' . $GPS_y;//经度,纬度
        } else
            return $lnglat;
    }

}

?>
