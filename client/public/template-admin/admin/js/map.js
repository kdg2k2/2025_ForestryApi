var map = L.map("map").setView([20.99895357, 105.6999829], 11);
// add layer control
var baseMaps = {
    "Open Street Map": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18
    }),
    "World Imagery": L.tileLayer(
        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 18
        }),
    "Ảnh nền vệ tinh tháng 12 năm 2020": L.tileLayer('https://tiles.planet.com/basemaps/v1/planet-tiles/global_monthly_2020_12_mosaic/gmap/{z}/{x}/{y}.png?api_key=517ee8e9c1124b11ad023d6455b2d328', {
        maxZoom: 18
    }),
};


L.control.layers(baseMaps).addTo(map);
baseMaps["Ảnh nền vệ tinh tháng 12 năm 2020"].addTo(map);

new L.cascadeButtons([
    {icon: 'fa-solid fa-bars', ignoreActiveState: true, command: () => OpenMenu()},
    {icon: 'fa-solid fa-rotate-right', ignoreActiveState: true, command: () => location.reload()},
], {position: 'topright', direction: 'vertical'}).addTo(map);
var legend = L.control({position: "bottomright"});

//Nhom lop loai ban do
map.overlaysRG = L.layerGroup([]).addTo(map);
map.overlaysDBR = L.layerGroup([]).addTo(map);
map.overlaysFireMap = L.layerGroup([]).addTo(map);
map.overlaysPoint = L.layerGroup([]).addTo(map);
map.overlaysLocation = L.layerGroup([]).addTo(map);
map.overlaysLopPhu = L.layerGroup([]).addTo(map);
map.overlaysRuiRo = L.layerGroup([]).addTo(map);

map.overlaysGK = L.layerGroup([]).addTo(map);
var markers = L.markerClusterGroup();

//Tham so lop ban do ranh gioi hanh chinh
var layerCurrent = null;
var WMS_RANHGIOI_URL =
    "https://bando.ifee.edu.vn:8453/geoserver/ws_ranhgioi/wms";
var WS_RANHGIOI = "ws_ranhgioi";
var WMS_OPACITY_DEFAULT = 1;
var WMS_DBR = "https://bando.ifee.edu.vn:8453/geoserver/ws_khonggianxanh/wms";

//Tham so lop ban do WMS
var currentLayer = null;
var currentFillter = null;
var currentWmsUrl = null;
var currentMapType = null;
var currentLevel = "matinh";
var currentCode = 75;
var listFirePoint = null;

$(document).ready(function () {
    var matinh = "75";
    //LayDanhSachHuyen
    $.ajax({
        method: "GET",
        url: "district/" + matinh,
    }).done(function (data) {
        $("#district").html(data);
    });
    //Load RGHC Tinh
    nameLayer = "ws_ranhgioi:rg_vn_tinh";
    sqlFilter = "MATINH=" + matinh;

    fnShowMapRG(nameLayer, sqlFilter);
    //set tham so cho lop ban do wms
    if (currentMapType) {
        currentProvinceSelect = matinh;
        map.overlaysDBR.clearLayers();
        checkedWMSLayer(currentMapType, "matinh", matinh);
    }
});

/*
    Hien thi WMS
*/
function fnShowMapRG(layerName, strFilter) {
    if (layerName == undefined) {
        alert("Lớp bản đồ này không tìm thấy. Vui lòng liên hệ quản trị viên");
    } else {
        layerCurrent = layerName;
        map.overlaysRG.clearLayers();
        var wmsL = getLayerWMS(
            WMS_RANHGIOI_URL,
            layerName,
            strFilter,
            "gcf_ranhgioi"
        );
        map.overlaysRG.addLayer(wmsL);
        // Zoom fitBounds
        var jsonURL = getFeatureJsonUrl(
            WMS_RANHGIOI_URL,
            layerCurrent,
            strFilter,
            10000
        );
        $.getJSON(jsonURL, function (data_json) {
            var selectStyle = {
                color: "#ffff86",
                opacity: 1,
                fillColor: "#fff7bc",
                fillOpacity: 0.1,
                //dashArray: '3',
                weight: 2,
            };
            var geoMaps = L.geoJson(data_json, {style: selectStyle});
            map.overlaysRG.addLayer(geoMaps);

            // Zoom to Feature
            var latlngs = [];
            for (var i in data_json.features[0].geometry.coordinates) {
                var coord = data_json.features[0].geometry.coordinates[i];
                for (var j in coord) {
                    var points = coord[j];
                    for (var k in points) {
                        latlngs.push(L.GeoJSON.coordsToLatLng(points[k]));
                    }
                }
            }
            map.fitBounds(latlngs);
        });
    }
}

function checkedWMSLayer(mapType, regionLevel, regionCode) {
    listWMS = [
        {
            Type: 0,
            root_url:
                "https://bando.ifee.edu.vn:8453/geoserver/ws_giaokhoan_dongnai/wms?",
            name_layer: "ws_giaokhoan_dongnai:hientrangrung_crkhoan_utm",
            style: "Style_HTR",
        },
        {
            Type: 1,
            root_url:
                "https://bando.ifee.edu.vn:8453/geoserver/ws_giaokhoan_dongnai/wms?",
            name_layer: "ws_giaokhoan_dongnai:ws_giaokhoan_dongnai_clone",
            style: "Style_GiaoKhoan",
        },

    ];
    dataWMS = listWMS[mapType];

    var wmsL = getLayerWMS(
        dataWMS.root_url,
        dataWMS.name_layer,
        `${regionLevel}=${regionCode}`,
        dataWMS.style
    );

    mapType == 0 ? map.overlaysDBR.addLayer(wmsL) : map.overlaysGK.addLayer(wmsL);

    currentLayer = dataWMS.name_layer;
    currentFillter = `${regionLevel}=${regionCode}`;
    currentWmsUrl = dataWMS.root_url;
}

function getFeatureJsonUrl(_wmsURL, _layerName, _strFilter, _maxFeature) {
    params = {
        service: "WFS",
        request: "GetFeature",
        typeName: _layerName,
        maxFeatures: _maxFeature,
        outputFormat: "application/json",
        srsName: "EPSG:4326",
        cql_filter: _strFilter,
    };
    var parameters = L.Util.extend(params);
    return _wmsURL + L.Util.getParamString(parameters);
}

function getLayerWMS(_wmsURL, _layerName, _strFilter, _strStyle) {
    if (_strFilter != null) {
        return L.tileLayer.wms(_wmsURL, {
            layers: _layerName,
            cql_filter: _strFilter,
            styles: _strStyle,
            opacity: WMS_OPACITY_DEFAULT,
            transparent: true,
            srs: "EPSG:4326",
            format: "image/png",
            style: _strStyle,
            zIndex: 999,
        });
    } else {
        // Áp dụng cho ranh giới: quốc gia, khu vực
        return L.tileLayer.wms(_wmsURL, {
            layers: _layerName,
            styles: _strStyle,
            opacity: WMS_OPACITY_DEFAULT,
            transparent: true,
            format: "image/png",
        });
    }
}

function getFeatureInfoUrl(_latlng, _layerName, _wmsURL, _cqlFillter) {
    var point = map.latLngToContainerPoint(_latlng, map.getZoom()),
        size = map.getSize(),
        params = {
            request: "GetFeatureInfo",
            service: "WMS",
            srs: "EPSG:4326",
            //styles: 'grass',
            transparent: true,
            version: "1.1.1",
            format: "image/png",
            bbox: map.getBounds().toBBoxString(),
            height: size.y,
            width: size.x,
            cql_filter: _cqlFillter,
            layers: _layerName,
            query_layers: _layerName,
            info_format: "application/json",
        };
    params[params.version === "1.3.0" ? "i" : "x"] = Math.round(point.x);
    params[params.version === "1.3.0" ? "j" : "y"] = Math.round(point.y);

    var test = _wmsURL + L.Util.getParamString(params, _wmsURL, true);
    return _wmsURL + L.Util.getParamString(params, _wmsURL, true);
}

function getPointCayPhanTan(regionLv, regionCode) {
    $.ajax({
        data: {regionCode: regionLv, regionLv: regionCode},
        method: "GET",
        url: "map/getTree",
    }).done(function (data) {
        dataLocation = data;
        var markers = new L.markerClusterGroup();

        for (var i = 0; i < dataLocation.length; i++) {
            var a = dataLocation[i];
            var title = a.sohieucay.toString();
            var customOptions = {
                maxWidth: "300",
                className: "custom",
            };
            var icon = L.icon({
                iconUrl: "web/images/location/tree2.png",
                iconSize: [48, 48], // size of the icon
                iconAnchor: [48, 48], // point of the icon which will correspond to marker's location
                popupAnchor: [-14, -90], // point from which the popup should open relative to the iconAnchor
            });
            var marker = L.marker(new L.LatLng(a.vido, a.kinhdo), {
                icon: icon,
            });
            marker.bindPopup(title, customOptions);
            marker.id = a.id;
            markers.addLayer(marker);
        }
        map.overlaysLocation.addLayer(markers);

        markers.on("click", function (a) {
            var id = a.layer.id;
            $("#tt_cay").removeClass("hidden");
            $("#tt_htr").addClass("hidden");
            $.ajax({
                data: {id: id},
                method: "GET",
                url: "map/getInfoBioTree",
            }).done(function (data) {
                var xy = data["kinhdo"] + "/" + data["vido"];
                $("#sohieucay").text(data["sohieucay"]);
                $("#xy").text(xy);
                $("#diadiem").text(data["diadiem"]);
                $("#namtrong").text(data["namtrong"]);
            });
        });
    });
}

function cleanViewTNR(modeClean) {
    switch (modeClean) {
        case 100:
            $("#bandoDBR").attr("checked", false);
            $("#bandoGiaoKhoan").attr("checked", false);
            $("#district").html("");
            $("#commune").html("");
        case 101:
            $("#district").html("");
            $("#commune").html("");
            break;
        case 102:
            $("#commune").html("");
            break;
        default:
    }

    $("#ngnk").html("");
    $("#mangnk").html("");
    $("#xaHuyen").html("");
    $("#tkKhoanhLo").html("");
    $("#chuRung").html("");
    $("#trangThaiRung").html("");
    $("#loaiCayNamtrg").html("");
    $("#dtich").html("");
    $("#truLuong").html("");
    $("#mtn").html("");
    $("#malr3").html("");
    $("#lapDia").html("");
    $("#mamdsd").html("");
    // map.overlaysDBR.clearLayers();
}

$("#district").change(function () {
    var mahuyen = $(this).val();

    $.ajax({
        method: "GET",
        url: "commune/" + mahuyen,
    }).done(function (data) {
        $("#commune").html(data);
    });

    //Load RGHC Huyen
    nameLayer = "ws_ranhgioi:rg_vn_huyen";
    sqlFilter = "MAHUYEN=" + mahuyen;

    fnShowMapRG(nameLayer, sqlFilter);

    currentLevel = "mahuyen";
    currentCode = mahuyen;
    //set tham so cho lop ban do wms
    if (currentMapType) {
        map.overlaysDBR.clearLayers();
        checkedWMSLayer(currentMapType, "mahuyen", mahuyen);
    }
});

$("#commune").change(function () {
    var maxa = $(this).val();
    cleanViewTNR();
    //Load RGHC Xa
    nameLayer = "ws_ranhgioi:rg_vn_xa";
    sqlFilter = "MAXA=" + maxa;
    fnShowMapRG(nameLayer, sqlFilter);
    currentLevel = "maxa";
    currentCode = maxa;
    //set tham so cho lop ban do wms
    //if (currentMapType) {
    map.overlaysDBR.clearLayers();
    checkedWMSLayer(currentMapType, "maxa", maxa);
    //};
});

$("#bandoDBR").change(function (event) {
    cleanViewTNR();
    if (event.currentTarget.checked) {
        // $("#bandoGiaoKhoan").prop("checked", false);
        $("#bandoCayTrong").prop("checked", false);
        $("#tt_caytrong").addClass("hidden");
        $("#tt_htr").removeClass("hidden");
        currentMapType = 0;
        checkedWMSLayer(currentMapType, currentLevel, currentCode);
    } else {
        map.overlaysDBR.clearLayers();
    }
});

$("#bandoGiaoKhoan").change(function (event) {
    cleanViewTNR();
    if (event.currentTarget.checked) {
        // $("#bandoDBR").prop("checked", false);
        $("#bandoCayTrong").prop("checked", false);
        $("#tt_caytrong").addClass("hidden");
        $("#tt_htr").removeClass("hidden");
        currentMapType = 1;
        checkedWMSLayer(currentMapType, currentLevel, currentCode);
    } else {
        map.overlaysGK.clearLayers();
    }
});

$("#bandoCayTrong").change(function (event) {
    cleanViewTNR();
    if (event.currentTarget.checked) {
        $("#bandoDBR").prop("checked", false);
        $("#bandoGiaoKhoan").prop("checked", false);
        $("#tt_caytrong").removeClass("hidden");
        $("#tt_htr").addClass("hidden");
    } else {
        map.overlaysDBR.clearLayers();
    }
});

$("#btnClear").click(function () {
    location.reload();
});


/*
    Lấy thông tin lớp bản đồ
*/
$('#bandoPhu').on('change', function () {
    if ($('#bandoPhu').is(":checked")) {
        map.overlaysLopPhu.addLayer(
            L.tileLayer
                .wms(
                    "https://bando.ifee.edu.vn:8453/geoserver/ws_giaokhoan_dongnai/wms", {
                        layers: "ws_giaokhoan_dongnai:lopphu",
                        opacity: 1,
                        zIndex: 9999,
                        transparent: true,
                        format: "image/png",
                        srs: "EPSG:4326",
                    }
                )
        )
    } else {
        map.overlaysLopPhu.clearLayers();
    }
})


$('#bandoRuiro').on('change', function () {
    if ($('#bandoRuiro').is(":checked")) {
        legend.onAdd = function () {
            var div = L.DomUtil.create("div", "legend");
            div.innerHTML += "<h4>Chú thích</h4>";
            div.innerHTML += '<div style="display: flex"><div style="background-color: #33CC33; height: 20px; width: 36px; margin-right: 10px; margin-bottom: 6px"></div><span> Thấp</span></div>';
            div.innerHTML += '<div style="display: flex"><div style="background-color: #FFFF00; height: 20px; width: 36px; margin-right: 10px; margin-bottom: 6px"></div><span> Trung bình</span></div>';
            div.innerHTML += '<div style="display: flex"><div style="background-color: #FF0000; height: 20px; width: 36px; margin-right: 10px; margin-bottom: 6px"></div><span> Cao</span></div>';
            return div;
        };
        legend.addTo(map);

        map.overlaysRuiRo.addLayer(
            L.tileLayer
                .wms(
                    "https://bando.ifee.edu.vn:8453/geoserver/ws_giaokhoan_dongnai/wms", {
                        layers: "ws_giaokhoan_dongnai:ws_giaokhoan_dongnai_clone",
                        opacity: 1,
                        zIndex: 9999,
                        transparent: true,
                        format: "image/png",
                        srs: "EPSG:4326",
                        styles: 'DongNai_RuiRo',
                    }
                )
        )
    } else {
        legend.remove();
        map.overlaysRuiRo.clearLayers();
    }
})

map.on("click", function (e) {
    markers.clearLayers();
    if ($("#bandoDBR").is(":checked") || $("#bandoGiaoKhoan").is(":checked")) {
        $("#tt_htr").removeClass("hidden");
        $("#tt_cay").addClass("hidden");
        infoURL = getFeatureInfoUrl(
            e.latlng,
            currentLayer,
            currentWmsUrl,
            currentFillter
        );
        $.getJSON(infoURL, function (data) {
            if (data) {
                if(data.features[0]) {
                    var data = data.features[0].properties;
                    var markerLT = L.marker(new L.LatLng(e.latlng.lat, e.latlng.lng)).bindPopup(
                        "<table class='table'><thead class='thead-dark' style='font-size: 14px'><tr><th scope='col'>Thuộc tính</th><th scope='col'>Thông tin</th></tr></thead><tbody style='font-size: 12px'>" +
                        "<tr><th scope='row'>Xã - Huyện</th><td>" + data.xa + '/ ' + data.huyen + "</td></tr>" +
                        "<tr><th scope='row'>Tiểu khu/Khoảnh/Lô</th><td>" + data.tk + '/ ' + data.khoanh + '/ ' + data.lo + "</td></tr>" +
                        "<tr><th scope='row'>Chủ rừng</th><td>" + data.churung + "</td></tr>" +
                        "<tr><th scope='row'>Trạng thái rừng</th><td>" + getLDLR(data.ldlr) + "</td></tr>" +
                        "<tr><th scope='row'>Loài cây/Cấp tuổi/Năm trồng</th><td>" + data.sldlr + '/ ' + data.captuoi + '/ ' + data.namtr + "</td></tr>" +
                        "<tr><th scope='row'>Diện tích</th><td>" + data.dtich + " ha</td></tr>" +
                        "<tr><th scope='row'>Trữ lượng</th><td>" + data.mgolo + "</td></tr></tbody></table>"
                    );
                    markers.addLayer(markerLT);

                    map.addLayer(markers);
                    markers.eachLayer(function (layer) {
                        layer.openPopup();
                    });
                }

            } else {
                cleanViewTNR();
            }
        });
    }
});

//Lay thong tin ban do
function getLDLR(maLRLR) {
    var ldlrString = "";
    for (var i = 0; i < LDLR_MA_TRANG_THAI.length; i++) {
        if (maLRLR.toLowerCase() == LDLR_MA_TRANG_THAI[i]) {
            ldlrString = LDLR_TEN_TRANG_THAI[i];
            return ldlrString;
        }
    }
    return ldlrString;
}

function get3LR(maLR3) {
    var string3LR = "";
    switch (maLR3) {
        case 1:
            string3LR = "Rừng phòng hộ";
            break;
        case 2:
            string3LR = "Rừng đặc dụng";
            break;
        case 3:
            string3LR = "Rừng sản xuất";
            break;
    }
    return string3LR;
}

function getLapDia(maLapDia) {
    var stringLapDia = "";
    switch (maLapDia) {
        case 1:
            stringLapDia = "Núi đất";
            break;
        case 2:
            stringLapDia = "Núi đá";
            break;
        case 3:
            stringLapDia = "Đất ngập mặn";
            break;
        case 4:
            stringLapDia = "Đất ngập phèn";
            break;
        case 5:
            stringLapDia = "Đất ngập ngọt";
            break;
        case 6:
            stringLapDia = "Bãi cát";
            break;
    }
    return stringLapDia;
}

function getMDST(maMDSD) {
    var mdsdString = MDSD_MA_MUC_DICH[maMDSD - 1];
    return mdsdString;
}

//Bảng tra mã loại đất loại rừng
var LDLR_TEN_TRANG_THAI = [
    "1 - Rừng gỗ tự nhiên núi đất LRTX giàu nguyên sinh",
    "2 - Rừng gỗ tự nhiên núi đất LRTX TB nguyên sinh",
    "3 - Rừng gỗ tự nhiên núi đất LRRL giàu nguyên sinh",
    "4 - Rừng gỗ tự nhiên núi đất LRRL TB nguyên sinh",
    "5 - Rừng gỗ tự nhiên núi đất LK giàu nguyên sinh",
    "6 - Rừng gỗ tự nhiên núi đất LK TB nguyên sinh",
    "7 - Rừng gỗ tự nhiên núi đất LRLK giàu nguyên sinh",
    "8 - Rừng gỗ tự nhiên núi đất LRLK TB nguyên sinh",
    "9 - Rừng gỗ tự nhiên núi đá LRTX giàu nguyên sinh",
    "10 - Rừng gỗ tự nhiên núi đá LRTX TB nguyên sinh",
    "11 - Rừng gỗ tự nhiên ngập mặn nguyên sinh",
    "12 - Rừng gỗ tự nhiên ngập phèn nguyên sinh",
    "13 - Rừng gỗ tự nhiên ngập ngọt nguyên sinh",
    "14 - Rừng gỗ tự nhiên núi đất LRTX giàu",
    "15 - Rừng gỗ tự nhiên núi đất LRTX TB",
    "16 - Rừng gỗ tự nhiên núi đất LRTX nghèo",
    "17 - Rừng gỗ tự nhiên núi đất LRTX nghèo kiệt",
    "18 - Rừng gỗ tự nhiên núi đất LRTX phục hồi",
    "19 - Rừng gỗ tự nhiên núi đất LRRL giàu",
    "20 - Rừng gỗ tự nhiên núi đất LRRL TB",
    "21 - Rừng gỗ tự nhiên núi đất LRRL nghèo",
    "22 - Rừng gỗ tự nhiên núi đất LRRL nghèo kiệt",
    "23 - Rừng gỗ tự nhiên núi đất LRRL phục hồi",
    "24 - Rừng gỗ tự nhiên núi đất LK giàu",
    "25 - Rừng gỗ tự nhiên núi đất LK TB",
    "26 - Rừng gỗ tự nhiên núi đất LK nghèo",
    "27 - Rừng gỗ tự nhiên núi đất LK nghèo kiệt",
    "28 - Rừng gỗ tự nhiên núi đất LK phục hồi",
    "29 - Rừng gỗ tự nhiên núi đất LRLK giàu",
    "30 - Rừng gỗ tự nhiên núi đất LRLK TB",
    "31 - Rừng gỗ tự nhiên núi đất LRLK nghèo",
    "32 - Rừng gỗ tự nhiên núi đất LRLK nghèo kiệt",
    "33 - Rừng gỗ tự nhiên núi đất LRLK phục hồi",
    "34 - Rừng gỗ tự nhiên núi đá LRTX giàu",
    "35 - Rừng gỗ tự nhiên núi đá LRTX TB",
    "36 - Rừng gỗ tự nhiên núi đá LRTX nghèo",
    "37 - Rừng gỗ tự nhiên núi đá LRTX nghèo kiệt",
    "38 - Rừng gỗ tự nhiên núi đá LRTX phục hồi",
    "39 - Rừng gỗ tự nhiên ngập mặn giàu",
    "40 - Rừng gỗ tự nhiên ngập mặn trung bình",
    "41 - Rừng gỗ tự nhiên ngập mặn nghèo",
    "42 - Rừng gỗ tự nhiên ngập mặn phục hồi",
    "43 - Rừng gỗ tự nhiên ngập phèn giàu",
    "44 - Rừng gỗ tự nhiên ngập phèn trung bình",
    "45 - Rừng gỗ tự nhiên ngập phèn nghèo",
    "46 - Rừng gỗ tự nhiên ngập phèn phục hồi",
    "47 - Rừng gỗ tự nhiên ngập ngọt",
    "48 - Rừng tre/luồng tự nhiên núi đất",
    "49 - Rừng nứa tự nhiên núi đất",
    "50 - Rừng vầu tự nhiên núi đất",
    "51 - Rừng lồ ô tự nhiên núi đất",
    "52 - Rừng tre nứa khác tự nhiên núi đất",
    "53 - Rừng tre nứa tự nhiên núi đá",
    "54 - Rừng hỗn giao G-TN tự nhiên núi đất ",
    "55 - Rừng hỗn giao TN-G tự nhiên núi đất ",
    "56 - Rừng hỗn giao tự nhiên núi đá",
    "57 - Rừng cau dừa tự nhiên núi đất",
    "58 - Rừng cau dừa tự nhiên núi đá",
    "59 - Rừng cau dừa tự nhiên ngập nước ngọt",
    "60 - Rừng gỗ trồng núi đất",
    "61 - Rừng gỗ trồng núi đá",
    "62 - Rừng gỗ trồng ngập mặn",
    "63 - Rừng gỗ trồng ngập phèn",
    "64 - Rừng gỗ trồng đất cát",
    "65 - Rừng tre nứa trồng núi đất",
    "66 - Rừng tre nứa trồng núi đá",
    "67 - Rừng cau dừa trồng cạn",
    "68 - Rừng cau dừa trồng ngập nước",
    "69 - Rừng cau dừa trồng đất cát",
    "70 - Rừng trồng khác núi đất",
    "71 - Rừng trồng khác núi đá",
    "72 - Đất đã trồng trên núi đất",
    "73 - Đất đã trồng trên núi đá",
    "74 - Đất đã trồng trên đất ngập mặn",
    "75 - Đất đã trồng trên đất ngập phèn",
    "76 - Đất đã trồng trên đất ngập ngọt",
    "77 - Đất đã trồng trên bãi cát",
    "78 - Đất có cây gỗ tái sinh núi đất",
    "79 - Đất có cây gỗ tái sinh núi đá",
    "80 - Đất có cây gỗ tái sinh ngập mặn",
    "81 - Đất có cây tái sinh ngập nước phèn",
    "82 - Đất trống núi đất",
    "83 - Đất trống núi đá",
    "84 - Đất trống ngập mặn",
    "85 - Đất trống ngập nước phèn",
    "86 - Bãi cát",
    "87 - Bãi cát có cây rải rác",
    "88 - Đất nông nghiệp núi đất",
    "89 - Đất nông nghiệp núi đá",
    "90 - Đất nông nghiệp ngập mặn",
    "91 - Đất nông nghiệp ngập nước ngọt",
    "92 - Mặt nước ",
    "93 - Đất khác",
];

var LDLR_MA_TRANG_THAI = [
    "txg1",
    "txb1",
    "rlg1",
    "rlb1",
    "lkg1",
    "lkb1",
    "rkg1",
    "rkb1",
    "txdg1",
    "txdb1",
    "rnm1",
    "rnp1",
    "rnp1",
    "txg",
    "txb",
    "txn",
    "txk",
    "txp",
    "rlg",
    "rlb",
    "rln",
    "rlk",
    "rlp",
    "lkg",
    "lkb",
    "lkn",
    "lkk",
    "lkp",
    "rkg",
    "rkb",
    "rkn",
    "rkk",
    "rkp",
    "txdg",
    "txdb",
    "txdn",
    "txdk",
    "txdp",
    "rnmg",
    "rnmb",
    "rnmn",
    "rnmp",
    "rnpg",
    "rnpb",
    "rnpn",
    "rnpp",
    "rnn",
    "tlu",
    "nua",
    "vau",
    "loo",
    "tnk",
    "tnd",
    "hg1",
    "hg2",
    "hgd",
    "cd",
    "cdd",
    "cdn",
    "rtg",
    "rtgd",
    "rtm",
    "rtp",
    "rtc",
    "rttn",
    "rttnd",
    "rtcd",
    "rtcdn",
    "rtcdc",
    "rtk",
    "rtkd",
    "dtr",
    "dtrd",
    "dtrm",
    "dtrp",
    "dtrn",
    "dtrc",
    "dt2",
    "dt2d",
    "dt2m",
    "dt2p",
    "dt1",
    "dt1d",
    "dt1m",
    "dt1p",
    "bc1",
    "bc2",
    "nn",
    "nnd",
    "nnm",
    "nnp",
    "mn",
    "dkh",
];

//Bảng tra chức năng rừng
var MDSD_MA_MUC_DICH = [
    "1 - Phòng hộ đầu nguồn",
    "2 - Phòng hộ chắn sóng",
    "3 - Phòng hộ chắn cát",
    "4 - Phòng hộ môi sinh",
    "5 - Vườn quốc gia",
    "6 - Bảo tồn thiên nhiên",
    "7 - Nghiên cứu khoa học",
    "8 - Rừng lịch sử VHCQ",
    "9 - Gỗ lớn",
    "10 - Gỗ nhỏ",
    "11 - Tre nứa",
    "12 - Mục đích sản xuất khác",
];

function OpenMenu() {
    if ($('#offcanvasExample').hasClass('show')) {
        $('#offcanvasExample').removeClass('show');
    } else {
        $('#offcanvasExample').addClass('show');
    }
}

$('#close-menu-map').click(function () {
    $('#offcanvasExample').removeClass('show');
})
