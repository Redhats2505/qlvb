    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> @yield('title')</title>
        <link href="{{asset('css/bootstrap.min.css')}}" type="text/css" rel="stylesheet" />
    	<link href="{{asset('css/dataTables.bootstrap.min.css')}}" type="text/css" rel="stylesheet" />
        <link href="{{asset('css/app.css')}}" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    </head>
    <body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'BTP Holdings') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
        <div class="container">
        
            @section('content')
            @show
        </div>
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="{!! url('js/dataTables.bootstrap.min.js') !!}"></script>
        <script type="text/javascript" src="{!! url('js/bootstrap.min.js') !!}"></script>
        <!--<script type="text/javascript" src="{!! url('js/jquery.dataTables.min.js') !!}"></script>-->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    	<script>
    		$(document).ready(function() {
    			$('#DataList').dataTable({
    				"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tất cả"]],
    				"iDisplayLength": 10,
    				"oLanguage": {
    					"sLengthMenu": "Hiển thị _MENU_ dòng mỗi trang",
    					"oPaginate": {
    						"sFirst": "<span class='glyphicon glyphicon-step-backward' aria-hidden='false'></span>",
    						"sLast": "<span class='glyphicon glyphicon-step-forward' aria-hidden='true'></span>",
    						"sNext": "<span class='glyphicon glyphicon-triangle-right' aria-hidden='true'></span>",
    						"sPrevious": "<span class='glyphicon glyphicon-triangle-left' aria-hidden='true'></span>"
    					},
    					"sEmptyTable": "Không có dữ liệu",
    					"sSearch": "Tìm kiếm:",
    					"sZeroRecords": "Không có dữ liệu",
    					"sInfo": "Hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ dòng được tìm thấy",
    					"sInfoEmpty" : "Không tìm thấy",
    					"sInfoFiltered": " (trong tổng số _MAX_ dòng)"
    				}
    			});
    		});
    	</script>
        
    </body>
    </html>