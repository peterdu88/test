<aside class="main-sidebar navbar-default sidebar" role="navigation">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!!asset('/img/'.$user->email.'-160x160.jpg')!!}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>
                    @if(isset($user->first_name) && isset($user->last_name))
                        {!! $user->first_name .' '. $user->last_name !!}
                    @else
                        {!! $user->email !!}
                    @endif
                </p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {!! trans('default.online') !!}</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">{!! trans('default.main_nav') !!}</li>

            <!-- Optionally, you can add icons to the links -->
            <li {!! (Request::is('/dashboard*') ? 'class="active"' : '') !!}><a href="{!! url ('dashboard') !!}"><i class="fa fa-dashboard fa-fw"></i> <span>{!! trans('default.dashboard') !!}</span></a></li>

            @if(Sentinel::hasAccess('admin') || Sentinel::hasAccess('manager'))
                <li class="treeview  {!! Request::is('admin/categories','admin/categories/*') ? 'active' : '' !!}">
                    <a href="{!! Sentinel::hasAccess('admin') ? url('admin/categories') : url('categories') !!}"><i class="fa fa-tags fa-fw"></i> <span>{!! trans('default.categories') !!}</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu {!! Request::is('admin/categories/create','admin/categories') ? 'class="menu-open"' : '' !!}">
                        <li {!! Request::is('admin/categories') ? 'class="active"' : '' !!}>
                            <a href="{!! Sentinel::hasAccess('admin') ? url('admin/categories') : url('categories') !!}"><i class="fa fa-th-list fa-fw"></i><span>{!! trans('default.categories') !!}</span> </a>
                        </li>
                        <li {!! Request::is('admin/categories/create') ? 'class="active"' : '' !!}>
                            <a href="{!! Sentinel::hasAccess('admin') ? url('admin/categories/create') : url('categories/create') !!}"><i class="fa fa-plus fa-fw"></i> <span>{!! trans('default.create') !!} {!! trans('default.categories') !!}</span></a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="treeview  {!! (Request::is('admin/orders','admin/orders/*','admin/orderitem') ? 'active' : '') !!}">
                <a href="{!! Sentinel::hasAccess('admin') ? url('admin/orders') : url('orders') !!}"><i class="fa fa-shopping-cart fa-fw"></i> <span>{!! trans('default.orders') !!}</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{!!  Request::is('admin/orders','orders') ? 'active' : '' !!}">
                        <a href="{!! Sentinel::hasAccess('admin') ? url('admin/orders') : url('orders') !!}"><i class="fa fa-th-list fa-fw"></i><span>{!! trans('default.orders') !!}</span> </a>
                    </li>
                    <li class="{!! ((Request::is('admin/orders/create','orders/create') ) ? 'active' : '') !!}">
                        <a href="{!! Sentinel::hasAccess('admin') ? url('admin/orders/create') : url('orders/create') !!}"><i class="fa fa-plus fa-fw"></i> <span>{!! trans('default.create') !!} {!! trans('default.order') !!}</span></a>
                    </li>

                    <li class="{!! ((Request::is('admin/ordersitem','orderitem') ) ? 'active' : '') !!}">
                        <a href="{!! Sentinel::hasAccess('admin') ? url('admin/orderitem') : url('orderitem') !!}"><i class="fa fa-th-list fa-fw"></i><span>{!! trans('default.orderitems') !!}</span> </a>
                    </li>
                </ul>
            </li>

            @if(Sentinel::hasAccess('admin'))
                <li class="treeview  {!! (Request::is('admin/users/*') ? 'active' : '') !!}">
                    <a href="{!! url('admin/users') !!}"><i class="fa fa-user fa-fw"></i> <span>{!! trans('default.users') !!}</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li {!! (Request::is('admin/users') ? 'class="active"' : '') !!}>
                            <a href="{!! url ('admin/users') !!}"><i class="fa fa-th-list fa-fw"></i><span>{!! trans('default.users') !!}</span> </a>
                        </li>
                        <li {!! (Request::is('admin/users/create') ? 'class="active"' : '') !!}>
                            <a href="{!! url ('admin/users/create') !!}"><i class="fa fa-user-plus fa-fw"></i> <span>{!! trans('default.create') !!}</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {!! (Request::is('admin/roles/*') ? 'active' : '') !!}">
                    <a href="{!! url('admin/roles') !!}"><i class="fa fa-users fa-fw"></i> <span>{!! trans('default.roles') !!}</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li {!! (Request::is('admin/roles/*') ? 'class="active"' : '') !!}>
                            <a href="{!! url ('admin/roles') !!}"><i class="fa fa-th-list fa-fw"></i><span>{!! trans('default.roles') !!}</span> </a>
                        </li>
                        <li {!! (Request::is('admin/roles/create') ? 'class="active"' : '') !!}>
                            <a href="{!! url ('admin/roles/create') !!}"><i class="fa fa-plus fa-fw"></i> <span>{!! trans('default.role_create') !!}</span></a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(Sentinel::hasAccess('admin'))
                <li class="treeview {!! (Request::is('admin/settings/*') ? 'active' : '') !!}" >
                    <a href="{!! url('admin/settings') !!}"><i class="fa fa-cogs fa-fw"></i> <span>{!! trans('default.settings') !!}</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu {!! (Request::is('admin/settings/approval','admin/settings/approval/*') ? 'menu-open' : '') !!}">
                        <li class="treeview {!! (Request::is('admin/settings/approval','admin/settings/approval/*') ? 'active' : '') !!}">
                            <a href="javascript:return false;"><i class="fa fa-check"></i><span>{!! trans('default.approval') !!}</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu {!! (Request::is('admin/settings/approval') ? 'menu-open' : '') !!}">
                                <li class="{!! (Request::is('admin/settings/approval') ? 'active' : '') !!}">
                                    <a href="{!! url ('admin/settings/approval') !!}"><i class="fa fa-th-list fa-fw"></i><span>{!! trans('default.approval') !!}</span> </a>
                                </li>
                                <li class="{!! (Request::is('admin/settings/approval/create') ? 'active' : '') !!}">
                                    <a href="{!! url ('admin/settings/approval/create') !!}"><i class="fa fa-plus fa-fw"></i> <span>{!! trans('default.approval_create') !!}</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview {!! (Request::is('admin/settings/payment','admin/settings/payment/*') ? 'active' : '') !!}">
                            <a href="javascript:return false;"><i class="fa fa fa-credit-card"></i><span>{!! trans('default.payments') !!}</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu  {!! (Request::is('admin/settings/payment/*') ? 'menu-open' : '') !!}">
                                <li {!! (Request::is('admin/settings/payment') ? 'class="active"' : '') !!}>
                                    <a href="{!! url ('admin/settings/payment') !!}"><i class="fa fa-list"></i><span>{!! trans('default.payment') !!}</span> </a>
                                </li>
                                <li {!! (Request::is('admin/settings/payment/create') ? 'class="active"' : '') !!}>
                                    <a href="{!! url ('admin/settings/payment/create') !!}"><i class="fa fa-plus"></i> <span>{!! trans('default.payment_create') !!}</span></a>
                                </li>
                            </ul>
                        </li>

                        {{ Request::is() }}
                        <li class="treeview {!! (Request::is('admin/settings/vendor','admin/settings/vendor/*') ? 'active' : '') !!}">
                            <a href="javascript:return false;"><i class="fa fa fa-suitcase"></i><span>{!! trans('default.vendors') !!}</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu  {!! (Request::is('admin/settings/vendor/*') ? 'menu-open' : '') !!}">
                                <li {!! (Request::is('admin/settings/vendor') ? 'class="active"' : '') !!}>
                                    <a href="{!! url ('admin/settings/vendor') !!}"><i class="fa fa-list"></i><span>{!! trans('default.vendor') !!}</span> </a>
                                </li>
                                <li {!! (Request::is('admin/settings/vendor/create') ? 'class="active"' : '') !!}>
                                    <a href="{!! url ('admin/settings/vendor/create') !!}"><i class="fa fa-plus"></i> <span>{!! trans('default.vendor_create') !!}</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif

            <li {!! (Request::is('*charts') ? 'class="active"' : '') !!}>
                <a href="{!! url ('charts') !!}"><i class="fa fa-bar-chart-o fa-fw"></i> <span>Charts</span></a>
                <!-- /.nav-second-level -->
            </li>
            <li {!! (Request::is('*tables') ? 'class="active"' : '') !!}>
                <a href="{!! url ('tables') !!}"><i class="fa fa-table fa-fw"></i> <span>Tables</span> </a>
            </li>
            <li {!! (Request::is('*forms') ? 'class="active"' : '') !!}>
                <a href="{!! url ('forms') !!}"><i class="fa fa-edit fa-fw"></i><span> Forms</span></a>
            </li>
            <li >
                <a href="#"><i class="fa fa-wrench fa-fw"></i> <span>UI Elements</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li {!! (Request::is('*panels') ? 'class="active"' : '') !!}>
                        <a href="{!! url ('panels') !!}">Panels and Collapsibles</a>
                    </li>
                    <li {!! (Request::is('*buttons') ? 'class="active"' : '') !!}>
                        <a href="{!! url ('buttons' ) !!}"><span>Buttons</span></a>
                    </li>
                    <li {!! (Request::is('*notifications') ? 'class="active"' : '') !!}>
                        <a href="{!! url('notifications') !!}"><span>Alerts</span></a>
                    </li>
                    <li {!! (Request::is('*typography') ? 'class="active"' : '') !!}>
                        <a href="{!! url ('typography') !!}"><span>Typography</span></a>
                    </li>
                    <li {!! (Request::is('*icons') ? 'class="active"' : '') !!}>
                        <a href="{!! url ('icons') !!}"> Icons</a>
                    </li>
                    <li {!! (Request::is('*grid') ? 'class="active"' : '') !!}>
                        <a href="{!! url ('grid') !!}">Grid</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> <span>Multi-Level Dropdown</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">Second Level Item</a>
                    </li>
                    <li>
                        <a href="#">Second Level Item</a>
                    </li>
                    <li>
                        <a href="#">Third Level <span class="fa arrow"></span></a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> <span>Sample Pages</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li {!! (Request::is('*blank') ? 'class="active"' : '') !!}>
                        <a href="{!! url ('blank') !!}"><span>Blank Page</span></a>
                    </li>
                    <li>
                        <a href="{!! url ('login') !!}"><span>Login Page</span></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li {!! (Request::is('*documentation') ? 'class="active"' : '') !!}>
                <a href="{!! url ('documentation') !!}"><i class="fa fa-file-word-o fa-fw"></i><span> Documentation</span></a>
            </li>

            <li {!! (Request::is('/dashboard*') ? 'class="active"' : '') !!}><a href="{!! url ('/dashboard') !!}"><i class="fa fa-dashboard fa-fw"></i> <span>{!! trans('admin/default.dashboard') !!}</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Layout Options</span>
                    <span class="label label-primary pull-right">4</span>
                </a>
                <ul class="treeview-menu">
                    <li {!! (Request::is('layout*') ? 'class="active"' : '') !!}><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                    <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                    <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                    <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                </ul>
            </li>
            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Charts</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                    <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                    <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                    <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-laptop"></i><span>UI Elements</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                    <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                    <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                    <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                    <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                    <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Forms</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                    <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                    <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Tables</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                    <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
                </ul>
            </li>
            <li>
                <a href="pages/calendar.html">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                    <small class="label pull-right bg-red">3</small>
                </a>
            </li>
            <li>
                <a href="pages/mailbox/mailbox.html">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <small class="label pull-right bg-yellow">12</small>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Examples</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                    <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                    <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                    <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                    <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                    <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                    <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Multilevel</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                            <li>
                                <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                </ul>
            </li>
            <li {!! (Request::is('*documentation') ? 'class="active"' : '') !!}>
                <a href="{!! url ('documentation') !!}"><i class="fa fa-book fa-fw"></i><span> Documentation</span></a>
            </li>
            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
    <!-- /aside -->
</aside>