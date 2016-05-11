/**
 * Created by Administrator on 2015/12/11.
 */
//创建和初始化地图函数：
function initMap() {
    createMap();//创建地图
    setMapEvent();//设置地图事件
    addMapControl();//向地图添加控件
    addMarker();//向地图中添加marker
}

var mapcenter=new BMap.Point(104.09048277778 + 0.008774687519, 30.595395 + 0.00374531687912);//中心点和商店中心 控制

//创建地图函数：
function createMap() {
    var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
    map.centerAndZoom(mapcenter, 15);//设定地图的中心点和坐标并将地图显示在地图容器中
    window.map = map;//将map变量存储在全局
}
//地图事件设置函数：
function setMapEvent() {
    map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
    map.enableScrollWheelZoom();//启用地图滚轮放大缩小
    map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
    map.enableKeyboard();//启用键盘上下左右键移动地图
}
//地图控件添加函数：
function addMapControl() {
    //向地图中添加缩放控件
    var ctrl_nav = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_LARGE});
    map.addControl(ctrl_nav);
    //向地图中添加缩略图控件
    var ctrl_ove = new BMap.OverviewMapControl({anchor: BMAP_ANCHOR_BOTTOM_RIGHT, isOpen: 1});
    map.addControl(ctrl_ove);
}

//---车辆位置-------------------------------------------------------
//var markerArr = [
//    {
//        title: "车辆 ID",
//        content: "<a href='linemap.html'>查看轨迹</a>",
//        point: "104.09048277778|30.595395",
//        isOpen: 0,
//        icon: {w: 23, h: 25, l: 69, t: 21, x: 9, lb: 12}
//    },
//    {
//        title: "车辆 ID",
//        content: "车辆备注信息...",
//        point: "104.09048277278|30.593395",
//        isOpen: 0,
//        icon: {w: 23, h: 25, l: 69, t: 21, x: 9, lb: 12}
//    },
//    {
//        title: "车辆 ID",
//        content: "车辆备注信息...",
//        point: "104.09048277378|30.545395",
//        isOpen: 0,
//        icon: {w: 23, h: 25, l: 69, t: 21, x: 9, lb: 12}
//    },
//    {
//        title: "车辆 ID",
//        content: "车辆备注信息...",
//        point: "104.09048277758|30.565295",
//        isOpen: 0,
//        icon: {w: 23, h: 25, l: 69, t: 21, x: 9, lb: 12}
//    }
//];
//新加一辆车
//markerArr.push({
//    title: "车辆 ID",
//    content: "车辆备注信息...",
//    point: "104.09048277758|30.565395",
//    isOpen: 0,
//    icon: {w: 23, h: 25, l: 69, t: 21, x: 9, lb: 12}
//});
//-----------------车辆轨迹点---------
var plPoints = [{
    style: "solid",
    weight: 4,
    color: "#f00",
    opacity: 0.6,
    points: ["104.099257465299|30.59914031687912", "104.096953465299|30.59910031687912", "104.09048277758|30.565395"]
}
];
var points = [];
for (var i = 0; i < markerArr.length; i++) {
    var json = markerArr[i];
    var p0 = json.point.split("|")[0];
    var p1 = json.point.split("|")[1];
    points[i] = new BMap.Point(p0, p1);
}

//创建marker
function addMarker() {
    //坐标转换完之后的回调函数
    translateCallback = function (data) {
        if (data.status === 0) {
            for (var i = 0; i < data.points.length; i++) {
                var json = markerArr[i];
                var iconImg = createIcon(json.icon);
                var marker = new BMap.Marker(data.points[i], {icon: iconImg});
                map.addOverlay(marker);
                //map.setCenter(data.points[i]); //重新定义地图中心
                var iw = createInfoWindow(i);
                var label = new BMap.Label(json.title, {"offset": new BMap.Size(json.icon.lb - json.icon.x + 10, -10)});
                marker.setLabel(label);

                label.setStyle({
                    borderColor: "rgba(0, 0, 0, 0)",
                    color: "orange",
                    cursor: "pointer",
                    backgroundColor: "rgba(0,0,0,0)"
                });
                //
                (function () {
                    var index = i;
                    var _iw = createInfoWindow(i);
                    var _marker = marker;
                    _marker.addEventListener("click", function () {
                        this.openInfoWindow(_iw);
                    });
                    //行车轨迹
                    //_marker.addEventListener("click", function (e) {
                    //    map.clearOverlays();//清除所有覆盖物
                    //
                    //
                    //    //------向地图中添加线函数------
                    //
                    //        for (var i = 0; i < plPoints.length; i++) {
                    //            var json = plPoints[i];
                    //            var points = [];
                    //            for (var j = 0; j < json.points.length; j++) {
                    //                var p1 = json.points[j].split("|")[0];
                    //                var p2 = json.points[j].split("|")[1];
                    //                points.push(new BMap.Point(p1, p2));
                    //            }
                    //            var line = new BMap.Polyline(points, {
                    //                strokeStyle: json.style,
                    //                strokeWeight: json.weight,
                    //                strokeColor: json.color,
                    //                strokeOpacity: json.opacity
                    //            });
                    //            map.addOverlay(line);
                    //        }
                    //
                    //
                    //
                    //});
                    //_marker.addEventListener("mouseout", function () {
                    //    this.closeInfoWindow(_iw);
                    //});

                    _iw.addEventListener("open", function () {
                        _marker.getLabel().hide();
                    });
                    _iw.addEventListener("close", function () {
                        _marker.getLabel().show();
                    });
                    label.addEventListener("click", function () {
                        _marker.openInfoWindow(_iw);
                    });
                    if (!!json.isOpen) {
                        label.hide();
                        _marker.openInfoWindow(_iw);
                    }
                })();
            }
        }
    };
    setTimeout(function () {
        var convertor = new BMap.Convertor();
        convertor.translate(points, 1, 5, translateCallback)
    }, 100);

}
//创建InfoWindow
function createInfoWindow(i) {
    var json = markerArr[i];
    var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>" + json.content + "</div>");
    return iw;
}
//创建一个Icon
function createIcon(json) {
    var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w, json.h), {
        imageOffset: new BMap.Size(-json.l, -json.t),
        infoWindowOffset: new BMap.Size(json.lb + 5, 1),
        offset: new BMap.Size(json.x, json.h)
    });
    //创建商店logo
    var pt =mapcenter;
        var myIcon = new BMap.Icon("assets/admin/images/shoplogo.png", new BMap.Size(50, 50));
    var marker2 = new BMap.Marker(pt, {icon: myIcon});  // 创建标注
    map.addOverlay(marker2);
    return icon;
}
initMap();//创建和初始化地图
$("#carquery").click(function(){
    map.clearOverlays();//清除所有覆盖物
    for (var i = 0; i < plPoints.length; i++) {
        var json = plPoints[i];
        var points = [];
        for (var j = 0; j < json.points.length; j++) {
            var p1 = json.points[j].split("|")[0];
            var p2 = json.points[j].split("|")[1];
            points.push(new BMap.Point(p1, p2));
        }
        var line = new BMap.Polyline(points, {
            strokeStyle: json.style,
            strokeWeight: json.weight,
            strokeColor: json.color,
            strokeOpacity: json.opacity
        });
        map.addOverlay(line);
    }
})
$("#resetmap").click(function () {
    initMap();//创建和初始化地图
});