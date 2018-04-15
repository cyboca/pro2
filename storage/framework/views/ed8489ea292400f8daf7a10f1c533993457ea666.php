<html>
<head>

    <script type="text/javascript" src="<?php echo e(URL::asset('/js/clickEvent.js')); ?>" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('/js/jquery.min.js')); ?>" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('/js/jquery.knob.js')); ?>" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('/js/jquery.throttle.js')); ?>" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('/js/jquery.classycountdown.js')); ?>" charset="utf-8"></script>

    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/default.css')); ?>"/>

    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/css.css')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/menu.css')); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/table.css')); ?>"/>
    
    <title>this is backend</title>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#countdown17').ClassyCountdown({
                theme: "flat-colors-very-wide",
                end: $.now() + 10000
            });
            $('#countdown11').ClassyCountdown({
                theme: "black",
                style: {
                    secondsElement: {
                        gauge: {
                            fgColor: "#F00"
                        }
                    }
                },
                end: $.now() + 10000
            });
            $('#countdown12').ClassyCountdown({
                theme: "black-wide",
                labels: false,
                end: $.now() + 10000
            });
            $('#countdown13').ClassyCountdown({
                theme: "black-very-wide",
                labelsOptions: {
                    lang: {
                        days: 'D',
                        hours: 'H',
                        minutes: 'M',
                        seconds: 'S'
                    },
                    style: 'font-size:0.5em; text-transform:uppercase;'
                },
                end: $.now() + 10000
            });
            $('#countdown14').ClassyCountdown({
                theme: "black-black",
                labelsOptions: {
                    style: 'font-size:0.5em; text-transform:uppercase;'
                },
                end: $.now() + 10000
            });
            $('#countdown4').ClassyCountdown({
                end: $.now() + 10000,
                labels: true,
                style: {
                    element: "",
                    textResponsive: .5,
                    days: {
                        gauge: {
                            thickness: .03,
                            bgColor: "rgba(255,255,255,0.05)",
                            fgColor: "#1abc9c"
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:#fff;'
                    },
                    hours: {
                        gauge: {
                            thickness: .03,
                            bgColor: "rgba(255,255,255,0.05)",
                            fgColor: "#2980b9"
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:#fff;'
                    },
                    minutes: {
                        gauge: {
                            thickness: .03,
                            bgColor: "rgba(255,255,255,0.05)",
                            fgColor: "#8e44ad"
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:#fff;'
                    },
                    seconds: {
                        gauge: {
                            thickness: .03,
                            bgColor: "rgba(255,255,255,0.05)",
                            fgColor: "#f39c12"
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:#fff;'
                    }

                },
                onEndCallback: function() {
                    console.log("Time out!");
                }
            });
            $('#countdown2').ClassyCountdown({
                end: '1388468325',
                now: '1378441323',
                labels: true,
                style: {
                    element: "",
                    textResponsive: .5,
                    days: {
                        gauge: {
                            thickness: .01,
                            bgColor: "rgba(0,0,0,0.05)",
                            fgColor: "#1abc9c"
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:#34495e;'
                    },
                    hours: {
                        gauge: {
                            thickness: .01,
                            bgColor: "rgba(0,0,0,0.05)",
                            fgColor: "#2980b9"
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:#34495e;'
                    },
                    minutes: {
                        gauge: {
                            thickness: .01,
                            bgColor: "rgba(0,0,0,0.05)",
                            fgColor: "#8e44ad"
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:#34495e;'
                    },
                    seconds: {
                        gauge: {
                            thickness: .01,
                            bgColor: "rgba(0,0,0,0.05)",
                            fgColor: "#f39c12"
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:#34495e;'
                    }

                },
                onEndCallback: function() {
                    console.log("Time out!");
                }
            });
            $('#countdown9').ClassyCountdown({
                end: '1388468325',
                now: '1380501323',
                labels: true,
                style: {
                    element: "",
                    textResponsive: .5,
                    days: {
                        gauge: {
                            thickness: .05,
                            bgColor: "rgba(0,0,0,0)",
                            fgColor: "#1abc9c",
                            lineCap: 'round'
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:#34495e;'
                    },
                    hours: {
                        gauge: {
                            thickness: .05,
                            bgColor: "rgba(0,0,0,0)",
                            fgColor: "#2980b9",
                            lineCap: 'round'
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:#34495e;'
                    },
                    minutes: {
                        gauge: {
                            thickness: .05,
                            bgColor: "rgba(0,0,0,0)",
                            fgColor: "#8e44ad",
                            lineCap: 'round'
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:#34495e;'
                    },
                    seconds: {
                        gauge: {
                            thickness: .05,
                            bgColor: "rgba(0,0,0,0)",
                            fgColor: "#f39c12",
                            lineCap: 'round'
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:#34495e;'
                    }

                },
                onEndCallback: function() {
                    console.log("Time out!");
                }
            });
            $('#countdown10').ClassyCountdown({
                end: '1397468325',
                now: '1388471324',
                labels: true,
                labelsOptions: {
                    lang: {
                        days: 'D',
                        hours: 'H',
                        minutes: 'M',
                        seconds: 'S'
                    },
                    style: 'font-size:0.5em; text-transform:uppercase;'
                },
                style: {
                    element: "",
                    textResponsive: .5,
                    days: {
                        gauge: {
                            thickness: .02,
                            bgColor: "rgba(255,255,255,0.1)",
                            fgColor: "rgba(255,255,255,1)",
                            lineCap: 'round'
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:rgba(255,255,255,0.7);'
                    },
                    hours: {
                        gauge: {
                            thickness: .02,
                            bgColor: "rgba(255,255,255,0.1)",
                            fgColor: "rgba(255,255,255,1)",
                            lineCap: 'round'
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:rgba(255,255,255,0.7);'
                    },
                    minutes: {
                        gauge: {
                            thickness: .02,
                            bgColor: "rgba(255,255,255,0.1)",
                            fgColor: "rgba(255,255,255,1)",
                            lineCap: 'round'
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:rgba(255,255,255,0.7);'
                    },
                    seconds: {
                        gauge: {
                            thickness: .02,
                            bgColor: "rgba(255,255,255,0.1)",
                            fgColor: "rgba(255,255,255,1)",
                            lineCap: 'round'
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:rgba(255,255,255,0.7);'
                    },
                },
                onEndCallback: function() {
                    console.log("Time out!");
                }
            });
            $('#countdown3').ClassyCountdown({
                end: '1390868325',
                now: '1388461323',
                labels: true,
                labelsOptions: {
                    lang: {
                        days: 'Zile',
                        hours: 'Ore',
                        minutes: 'Minute',
                        seconds: 'Secunde'
                    },
                    style: 'font-size:0.5em; text-transform:uppercase;'
                },
                style: {
                    element: "",
                    textResponsive: .5,
                    days: {
                        gauge: {
                            thickness: .2,
                            bgColor: "rgba(255,255,255,0.2)",
                            fgColor: "rgb(241, 196, 15)"
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:rgba(255,255,255,0.7);'
                    },
                    hours: {
                        gauge: {
                            thickness: .2,
                            bgColor: "rgba(255,255,255,0.2)",
                            fgColor: "rgb(241, 196, 15)"
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:rgba(255,255,255,0.7);'
                    },
                    minutes: {
                        gauge: {
                            thickness: .2,
                            bgColor: "rgba(255,255,255,0.2)",
                            fgColor: "rgb(241, 196, 15)"
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:rgba(255,255,255,0.7);'
                    },
                    seconds: {
                        gauge: {
                            thickness: .2,
                            bgColor: "rgba(255,255,255,0.2)",
                            fgColor: "rgb(241, 196, 15)"
                        },
                        textCSS: 'font-family:\'Open Sans\'; font-size:25px; font-weight:300; color:rgba(255,255,255,0.7);'
                    }

                },
                onEndCallback: function() {
                    console.log("Time out!");
                }
            });
        });
    </script>
</head>
<body>
    <div>
        <input type='checkbox' id='sidemenu'>
        <aside>
            <h2><a class="menua" href="backend">Main Page</a></h2>
            <br/>
            <ul id="sideul">
                <a href="managers"><li id="managers">管理租户</li></a>
                <a href="space"><li id="spaces">管理空间</li></a>
                <a href="adminlogout"><li>logout</li></a>
            </ul>
        </aside>
        <div id='wrap'>
            <label class="menulabel" id='sideMenuControl' for='sidemenu'>≡</label>
            <!--for 属性规定 label 与哪个表单元素绑定，即将这个控制侧边栏进出的按钮与checkbox绑定-->
        </div>
    </div>
    <div id="contents">
        <table class="bordered">
            <tr>
                <th>id</th>
                <th>租户</th>
                <th>用户数</th>
            </tr>
            <tr>
                <th>0</th>
                <th><?php echo e($managers); ?></th>
                <th><?php echo e($users); ?></th>
            </tr>
        </table>
        <div id="countdown17" class="ClassyCountdownDemo"></div>

        <table class="bordered">
            <tr>
                <th>租户</th>
                <th>磁盘空间占用</th>
                <th>额度</th>
            </tr>

                <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th><?php echo e($manager['spacename']); ?></th>
                    <th><?php echo e($manager['size']); ?>Mb</th>
                    <th><?php echo e($manager['size_per']); ?>%</th>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </table>
    </div>
</body>
</html>
