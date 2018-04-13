<p>{{Session::get('username')}}</p>
<p>{{Session::get('password')}}</p>
<p>{{Session::get('type')}}</p>
@if(Session::get('status')!=0)
    <div class="alert">
        {{Session::get('msg')}}
    </div>
@endif

<p>{{session('error')}}</p>
