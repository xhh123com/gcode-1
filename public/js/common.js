// 接口部分
//基本的ajax访问后端接口类
function ajaxRequest(url, param, method, callBack) {
    console.log("url:" + url + " method:" + method + " param:" + JSON.stringify(param));
    $.ajax({
        type: method,  //提交方式
        url: url,//路径
        data: param,//数据，这里使用的是Json格式进行传输
        contentType: "application/json", //必须有
        dataType: "json",
        success: function (ret) {//返回数据根据结果进行相应的处理
            console.log("ret:" + JSON.stringify(ret));
            callBack(ret)
        },
        error: function (err) {
            console.log(JSON.stringify(err));
            console.log("responseText:" + err.responseText);
            callBack(err)
        }
    });
}

//////////////////////////////////////////////////////////////////////////////////////////////////

//是否输出打印信息的开关，为true 时输出打印信息
var DEBUG = true;

var consoledebug = (DEBUG) ? console : new nodebug();

function nodebug() {
}

nodebug.prototype.log = function (str) {
}
nodebug.prototype.warn = function (str) {
}


/*
 * 校验手机号js
 *
 * By TerryQi
 */

function isPoneAvailable(phone_num) {
    var myreg = /^[1][3,4,5,7,8][0-9]{9}$/;
    if (!myreg.test(phone_num)) {
        return false;
    } else {
        return true;
    }
}

// 判断参数是否为空
function judgeIsNullStr(val) {
    if (val == null || val == "" || val == undefined || val == "未设置") {
        return true
    }
    return false
}

// 判断参数是否为空
function judgeIsAnyNullStr() {
    if (arguments.length > 0) {
        for (var i = 0; i < arguments.length; i++) {
            if (!isArray(arguments[i])) {
                if (arguments[i] == null || arguments[i] == "" || arguments[i] == undefined || arguments[i] == "未设置" || arguments[i] == "undefined") {
                    return true
                }
            }
        }
    }
    return false
}

// 判断数组时候为空, 服务于 judgeIsAnyNullStr 方法
function isArray(object) {
    return Object.prototype.toString.call(object) == '[object Array]';
}


// 文字转html，主要是进行换行转换
function Text2Html(str) {
    if (str == null) {
        return "";
    } else if (str.length == 0) {
        return "";
    }
    str = str.replace(/\r\n/g, "<br>")
    str = str.replace(/\n/g, "<br>");
    return str;
}

//null变为空str
function nullToEmptyStr(str) {
    if (judgeIsNullStr(str)) {
        str = "";
    }
    return str;
}


/*
 * 获取url中get的参数
 *
 * By TerryQi
 *
 * 2017-12-23
 *
 */
function getQueryString(name) {
    var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
    var r = window.location.search.substr(1).match(reg);
    if (r != null) {
        return unescape(r[2]);
    }
    return null;
}


//判断密码的复杂度
function checkPass(s) {
    if (s.length < 8) {
        return 0;
    }
    var ls = 0;
    if (s.match(/([a-z])+/)) {
        ls++;
    }
    if (s.match(/([0-9])+/)) {
        ls++;
    }
    if (s.match(/([A-Z])+/)) {
        ls++;
    }
    if (s.match(/[^a-zA-Z0-9]+/)) {
        ls++;
    }
    return ls
}


/*
 * 去掉空格、回车、换行
 *
 * By TerryQi
 *
 * 2018-09-12
 */
function formateText(str_val) {
    var resultStr = str_val.replace(/\ +/g, ""); //去掉空格
    resultStr = resultStr.replace(/[ ]/g, "");    //去掉空格
    resultStr = resultStr.replace(/[\r\n]/g, ""); //去掉回车换行
    resultStr = resultStr.replace(/[\n]/g, ""); //去掉换行
    resultStr = resultStr.replace(/[\r]/g, ""); //去掉回车

    resultStr = resultStr.replace(/(^\s+)|(\s+$)/g, "");
    resultStr = resultStr.replace(/\s/g, "");

    return resultStr;
}

// 七牛云图片裁剪
function qiniuUrlTool(img_url, type) {
    //如果不是七牛的头像，则直接返回图片
    //consoledebug.log("img_url:" + img_url + " indexOf('isart.me'):" + img_url.indexOf('isart.me'));
    if (img_url.indexOf('7xku37.com') < 0 && img_url.indexOf('isart.me') < 0) {
        return img_url;
    }
    //七牛链接
    var qn_img_url;
    const size_w_500_h_200 = '?imageView2/2/w/500/h/200/interlace/1/q/75|imageslim'
    const size_w_200_h_200 = '?imageView2/2/w/200/h/200/interlace/1/q/75|imageslim'
    const size_w_500_h_300 = '?imageView2/2/w/500/h/300/interlace/1/q/75|imageslim'
    const size_w_500_h_250 = '?imageView2/2/w/500/h/250/interlace/1/q/75|imageslim'

    const size_w_500 = '?imageView1/1/w/500/interlace/1/q/75'

    //除去参数
    if (img_url.indexOf("?") >= 0) {
        img_url = img_url.split('?')[0]
    }
    //封装七牛链接
    switch (type) {
        case "ad":  //广告图片
            qn_img_url = img_url + size_w_500_h_300
            break
        case "folder_list":  //作品列表图片样式
            qn_img_url = img_url + size_w_500_h_200
            break
        case  'head_icon':      //头像信息
            qn_img_url = img_url + size_w_200_h_200
            break
        case  'work_detail':      //作品详情的图片信息
            qn_img_url = img_url + size_w_500
            break
        default:
            qn_img_url = img_url
            break
    }
    return qn_img_url
}


//描绘趋势图
/*
 * chart_dom_id：chart的id，例如user_chart
 *
 * data：数据，一般为数组
 *
 * legend_str：标题，例如 新增用户
 *
 */
function loadLineChart(chart_dom_id, data, legend_str, unit_str) {
    //获取线性图标
    var lineChart = echarts.init(document.getElementById(chart_dom_id))
    lineChart.showLoading({
        type: 'default'
    })
    var date_array = [];
    var value_array = [];
    //配置数据
    for (var i = 0; i < data.length; i++) {
        date_array.push(data[i].date)
        value_array.push(data[i].value)
    }
    var setOption = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        legend: {
            data: [legend_str]
        },
        xAxis: [
            {
                type: 'category',
                data: date_array,
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: legend_str,
                axisLabel: {
                    formatter: '{value} ' + unit_str
                },
                minInterval: 1
            }
        ],
        series: [
            {
                name: legend_str,
                type: 'line',
                data: value_array
            }
        ]
    }
    lineChart.setOption(setOption)
    lineChart.hideLoading()

    return lineChart;
}


//描绘双曲线
/*
 * chart_dom_id：chart的id，例如user_chart
 *
 * data1、data2：数据，一般为数组
 *
 * legend_str1、legend_str2：标题，例如 新增用户
 *
 * unit_str1、unit_str2：单位
 *
 */
function loadTwoLineChart(chart_dom_id, data1, data2, legend_str1, legend_str2, unit_str1, unit_str2) {

    var lineChart = echarts.init(document.getElementById(chart_dom_id))

    lineChart.showLoading({
        type: 'default'
    })

    var date_array = []
    var data1_array = []
    var data2_array = []

    for (var i = 0; i < data1.length; i++) {
        date_array.push(data1[i].date)
        data1_array.push(data1[i].value)
        data2_array.push(data2[i].value)
    }

    var setOption = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        legend: {
            data: [legend_str1, legend_str2]
        },
        xAxis: [
            {
                type: 'category',
                data: date_array,
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: legend_str1,
                axisLabel: {
                    formatter: '{value} ' + unit_str1
                },
                minInterval: 1
            },
            {
                type: 'value',
                name: legend_str2,
                axisLabel: {
                    formatter: '{value} ' + unit_str2
                },
                minInterval: 1
            }
        ],
        series: [
            {
                name: legend_str1,
                type: 'line',
                data: data1_array
            },
            {
                name: legend_str2,
                type: 'line',
                data: data2_array,
                yAxisIndex: 1
            },
        ]
    }

    lineChart.setOption(setOption)
    lineChart.hideLoading()

    return lineChart;
}


/*
 * 描绘柱状图趋势
 *
 * By TerryQi
 *
 * 2018-11-28
 *
 */
function loadTwoBarChart(chart_dom_id, data1, data2, legend_str1, legend_str2, unit_str1, unit_str2) {

    var barChart = echarts.init(document.getElementById(chart_dom_id))
    barChart.showLoading({
        type: 'default'
    })

    var date_array = []
    var data1_array = []
    var data2_array = []

    for (var i = 0; i < data1.length; i++) {
        date_array.push(data1[i].date)
        data1_array.push(data1[i].value)
        data2_array.push(data2[i].value)
    }

    var setOption = {
        tooltip: {
            trigger: 'axis',
            // formatter: "{b} : {c} 笔"
        },
        legend: {
            data: [legend_str1, legend_str2]
        },
        xAxis: {
            type: 'category',
            data: date_array
        },
        yAxis: [
            {
                type: 'value',
                axisLabel: {
                    formatter: '{value} ' + unit_str1
                }
            }, {
                type: 'value',
                axisLabel: {
                    formatter: '{value} ' + unit_str2
                }
            }
        ],
        series: [{
            name: legend_str1,
            data: data1_array,
            type: 'bar'
        }, {
            name: legend_str2,
            data: data2_array,
            type: 'bar'
        }
        ]
    }
    barChart.setOption(setOption)
    barChart.hideLoading()
    return barChart;
}
