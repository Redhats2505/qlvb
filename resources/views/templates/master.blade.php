    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> @yield('title')</title>
        <link href="{{asset('css/bootstrap.min.css')}}" type="text/css" rel="stylesheet" />
    	<link href="{{asset('css/dataTables.bootstrap.min.css')}}" type="text/css" rel="stylesheet" />
        <!--<link href="{{asset('css/app.css')}}" type="text/css" rel="stylesheet" />-->
        <link href="{{asset('css/custom.css')}}" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.dataTables.min.css">

    </head>
    <body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/')}}"> <img alt="logo" src="/img/logoBTP.jpeg" width="200" height="60">
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
                            <!--<li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                            </li>
                          <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                            </li>-->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Đăng xuất') }}
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
        <!--<div class="page-header"><a href="/"><img src="{{ asset('img/Btpholdings.png') }}" width="100%" height="auto" title="Quản lý hồ sơ"  alt="Quản lý hồ sơ"/></a>
    </div>-->
        <div class="container">
        
            @section('content')
            @show
        </div>
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="{!! url('js/dataTables.bootstrap.min.js') !!}"></script>
        <script type="text/javascript" src="{!! url('js/bootstrap.min.js') !!}"></script>
        <!--<script type="text/javascript" src="{!! url('js/jquery.dataTables.min.js') !!}"></script>-->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
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
    				},
                    "scrollY":        "400px",
                    "scrollX":        true,
                    "scrollCollapse": true,
                    "fixedColumns":   {
                        leftColumns: 1,
                        rightColumns: 2
                    }
    			});
    		});
            </script>
    <div class="coppy-right">
    <div class="container">
        © Copyright 2021 BTP Holdings, All rights reserved.
    </div>
    </div> 
    </body>
    
    </html>