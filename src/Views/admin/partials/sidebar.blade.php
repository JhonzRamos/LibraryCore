
        <!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" id="menuSidebar">

        <!-- Sidebar user panel -->
        @include('admin.partials.userpanel')


        <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" class="form-control searchlist" id="searchSidebar" placeholder="Search..." autocomplete="off"/>
                    <span class="input-group-btn">
                        <button type='button' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
        </form>
         <ul class="sidebar-menu list" id="menuList">
        </ul>
        <ul class="sidebar-menu list" id="menuSub">

            @if(Auth::user()->role_id == config('quickadmin.defaultRole'))
                <li class="treeview @if(Request::path() == config('quickadmin.route').'/menu') active  menu-open @endif ">
                    <a href="{{ url(config('quickadmin.route').'/menu') }}">
                        <i class="fa fa-list"></i>
                        <span class="title">{{trans('quickadmin::admin.partials-sidebar-menu')}}</span>
                    </a>
                </li>
                <li class="treeview @if(Request::path() == 'users')active  menu-open @endif  ">
                    <a href="{{ url('users') }}">
                        <i class="fa fa-users"></i>
                        <span class="title">{{ trans('quickadmin::admin.partials-sidebar-users') }}</span>
                    </a>
                </li>
                <li class="treeview @if(Request::path() == 'roles') active  menu-open @endif  ">
                    <a href="{{ url('roles') }}">
                        <i class="fa fa-gavel"></i>
                        <span class="title">{{ trans('quickadmin::admin.partials-sidebar-roles') }}</span>
                    </a>
                </li>
                <li class="treeview @if(Request::path() == config('quickadmin.route').'/actions') active  menu-open @endif " >
                    <a href="{{ url(config('quickadmin.route').'/actions') }}">
                        <i class="fa fa-users"></i>
                        <span class="title">{{ trans('quickadmin::admin.partials-sidebar-user-actions') }}</span>
                    </a>
                </li>
                 <li class="treeview @if(Request::path() == 'files') active  menu-open @endif  ">
                    <a href="{{ url(config('quickadmin.route').'/files') }}">
                        <i class="fa fa-files-o"></i>
                        <span class="title">Generated Files</span>
                    </a>
                </li>
                 <li class="treeview @if(Request::path() == 'projects') active  menu-open @endif  ">
                    <a href="{{ route(config('quickadmin.route').'/project') }}">
                        <i class="fa fa-files-o"></i>
                        <span class="title">Projects</span>
                    </a>
                </li>
                 <li class="treeview @if(Request::path() == 'forms') active  menu-open @endif  ">
                    <a href="{{ url(config('quickadmin.route').'/forms') }}">
                        <i class="fa fa-files-o"></i>
                        <span class="title">Projects</span>
                    </a>
                </li>
                 <li class="treeview @if(Request::path() == 'extensions') active  menu-open @endif  ">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span class="title">Extensions</span>
                    </a>
                </li>
                <li class="treeview">
                            <a href="#">
                                <i class="fa fa-cogs"></i>
                                <span class="title">Settings</span>
                                <span class="fa arrow"></span>
                                <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">


                                          <li class="treeview @if(Request::path() == 'extensions') active  menu-open @endif  ">
                                                <a href="#">
                                                    <i class="fa fa-files-o"></i>
                                                    <span class="title">Extensions</span>
                                                </a>
                                            </li>

                                          <li class="treeview @if(Request::path() == 'extensions') active  menu-open @endif  ">
                                            <a href="#">
                                                <i class="fa fa-files-o"></i>
                                                <span class="title">Extensions</span>
                                            </a>
                                        </li>

                            </ul>
                        </li>
            @endif
            <li class="header">
                Generated Menus
            </li>
            @foreach($menus as $menu)
                @if($menu->menu_type != 2 && is_null($menu->parent_id))
                    @if(Auth::user()->role->canAccessMenu($menu))
                        <li class="treeview @if(isset(explode('/',Request::path())[1]) && explode('/',Request::path())[1] == strtolower($menu->name)) active menu-open @endif">
                            <a href="{{ route(config('quickadmin.route').'.'.strtolower($menu->name).'.index') }}">
                                <i class="fa {{ $menu->icon }}"></i>
                                <span class="title">{{ $menu->title }}</span>
                            </a>
                        </li>
                    @endif
                @else
                    @if(Auth::user()->role->canAccessMenu($menu) && !is_null($menu->children()->first()) && is_null($menu->parent_id))
                        <li class="treeview">
                            <a href="#">
                                <i class="fa {{ $menu->icon }}"></i>
                                <span class="title">{{ $menu->title }}</span>
                                <span class="fa arrow"></span>
                                <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @foreach($menu['children'] as $child)
                                    @if(Auth::user()->role->canAccessMenu($child))
                                        <li>
                                            <a href="{{ route(strtolower(config('quickadmin.route').'.'.$child->name).'.index') }}">
                                                <i class="fa {{ $child->icon }}"></i>
                                                <span class="title">
                                                    {{ $child->title  }}
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endif


            @endforeach


            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-sign-out fa-fw"></i>
                    <span class="title">{{ trans('quickadmin::admin.partials-sidebar-logout') }}</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit"></button>
{!! Form::close() !!}



