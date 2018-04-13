<html>
<head>
    <title>this is managers page</title>
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/css.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/table.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{URL::asset('/css/menu.css')}}">
</head>
<body>
    <div>
        <input type='checkbox' id='sidemenu'>
        <aside>
            <h2><a class="menua" href="backend">Main Page</a></h2>
            <br/>
            <ul id="sideul">
                    <a href="createmanager"><li>create manager</li></a>
                    <a href="deletemanager"><li>delete managers</li></a>
                    <a href="adminlogout"><li>logout</li></a>
            </ul>
        </aside>
        <div id='wrap'>
            <label class="menulabel" id='sideMenuControl' for='sidemenu'>≡</label>
            <!--for 属性规定 label 与哪个表单元素绑定，即将这个控制侧边栏进出的按钮与checkbox绑定-->
        </div>
    </div>
    <div>
        <table class="bordered">
            <tr>
                <th>id</th>
                <th>租户</th>
                <th>用户数</th>
            </tr>
                @foreach($managers as $manager)
                    <tr>
                        <th>{{$manager['id']}}</th>
                        <th>{{$manager['username']}}</th>
                    </tr>
                @endforeach
        </table>
    </div>
</body>
</html>