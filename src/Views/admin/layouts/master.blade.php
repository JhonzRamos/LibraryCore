
<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partials.head')
</head>


<body class=" skin-blue sidebar-mini">

<div id="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url(config('quickadmin.homeRoute')) }}" class="logo"
           style="font-size: 16px;">
            <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
           ALT</span>
            <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
          QuickAdmin</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

        </nav>
    </header>
    @include('admin.partials.sidebar')

            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">

            <h3 class="page-title">
                {{ preg_replace('/([a-z0-9])?([A-Z])/','$1 $2',str_replace('Controller','',explode("@",class_basename(app('request')->route()->getAction()['controller']))[0])) }}
            </h3>

            <div class="row">
                <div class="col-md-12">

                    @if (Session::has('message'))
                        <div class="alert alert-info">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif
                    @if ($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')

                </div>
            </div>
        </section>
    </div>
</div>

{!! Form::open(['route' => 'logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}

@include('admin.partials.javascripts')
@yield('javascript')
</body>
</html>



