<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="###" class="site_title"><i class="fa fa-paw"></i> <span>Uears</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ url('adminpanel/') }}/build/images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ auth()->guard('admin')->user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ url('admin-panel/') }}"><i class="fa fa-home"></i> Home </a></li>
                    <li><a><i class="fa fa-user-secret"></i> Admins <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admins.index') }}">Admins Table</a></li>
                            <li><a href="{{ route('admins.create') }}">Create New Admin</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-user"></i> Users <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('users.index') }}">Users Table</a></li>
                            <li><a href="{{ route('users.create') }}">Create New User</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-calendar"></i> Programs <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('programs.index') }}">Programs Table</a></li>
                            <li><a href="{{ route('programs.create') }}">Create New Program</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-university"></i> Faculties <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('faculties.index') }}">Faculties Table</a></li>
                            <li><a href="{{ route('faculties.create') }}">Create New Faculty</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-tasks"></i> WorkShops <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('workshops.index') }}">Workshops Table</a></li>
                            <li><a href="{{ route('workshops.create') }}">Create New Workshop</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-deafness"></i> others <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('chairs.index') }}">Chairs</a></li>
                            <li><a href="{{ route('presentations.index') }}">Presentations</a></li>
                            <li><a href="{{ route('messages.index') }}">Messages</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-gears"></i> Settings <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('abstract_webs') }}">Abstract Webs URL</a></li>
                            <li><a href="{{ route('committee_feeds') }}">Commit Feeds text</a></li>
                            <li><a href="{{ route('Exhibiitionss') }}">Exhibtions & Homes PDF</a></li>
                            <li><a href="{{ route('main_topics') }}">Main Topics Text</a></li>
                            <li><a href="{{ route('new_feeds') }}">News Feeds</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings" href="{{ url('admin-panel/settings') }}">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('admin_logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>