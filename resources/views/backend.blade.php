<html>
<head>

    <script type="text/javascript" src="{{URL::asset('/js/clickEvent.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{URL::asset('/js/jquery.min.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{URL::asset('/js/jquery.knob.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{URL::asset('/js/jquery.throttle.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{URL::asset('/js/jquery.classycountdown.js')}}" charset="utf-8"></script>

    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/default.css')}}"/>

    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/css.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/menu.css')}}">
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/table.css')}}"/>

    <title>this is backend</title>
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
                <th>{{$managers}}</th>
                <th>{{$users}}</th>
            </tr>
        </table>

        <table class="bordered">
            <tr>
                <th>租户</th>
                <th>磁盘空间占用</th>
                <th>额度</th>
            </tr>

                @foreach($sizes as $manager)
                <tr>
                    <th>{{$manager['spacename']}}</th>
                    <th>{{$manager['size']}}Mb</th>
                    <th>{{$manager['size_per']}}%</th>
                </tr>
                @endforeach
        </table>
    </div>
</body>
</html>
