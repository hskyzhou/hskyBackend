<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"> </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="nav-item start active open">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">系统管理</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start active open">
                        <a href="{{route('permission.index')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">权限管理</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="{{route('role.index')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">角色管理</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="{{route('user.index')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">用户管理</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start">
                        <a href="{{route('menu.index')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">菜单管理</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="dashboard_2.html" class="nav-link ">
                            <i class="icon-bulb"></i>
                            <span class="title">Dashboard 2</span>
                            <span class="badge badge-success">1</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="dashboard_3.html" class="nav-link ">
                            <i class="icon-graph"></i>
                            <span class="title">Dashboard 3</span>
                            <span class="badge badge-danger">5</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="heading">
                <h3 class="uppercase">Features</h3>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bulb"></i>
                    <span class="title">Elements</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="elements_steps.html" class="nav-link ">
                            <span class="title">Steps</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="elements_lists.html" class="nav-link ">
                            <span class="title">Lists</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="elements_ribbons.html" class="nav-link ">
                            <span class="title">Ribbons</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="elements_overlay.html" class="nav-link ">
                            <span class="title">Overlays</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="elements_cards.html" class="nav-link ">
                            <span class="title">User Cards</span>
                        </a>
                    </li>
                </ul>
            </li>
            
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>