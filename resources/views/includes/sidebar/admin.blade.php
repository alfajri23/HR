<aside class="site-sidebar scrollbar-enabled clearfix">
    
    <!-- Sidebar Menu -->
    <nav class="sidebar-nav">
        <ul class="nav in side-menu">
            {{-- <li class="current-page menu-item-has-children"><a href="javascript:void(0);" class="ripple"><i class="fas fa-columns"></i> <span class="hide-menu">Dashboard <span class="badge badge-border badge-border-inverted bg-primary pull-right">5</span></span></a>
                <ul class="list-unstyled sub-menu">
                    <li><a href="../default/index.html">Default</a>
                    </li>
                    <li><a href="../collapse-nav/index.html">Collapsed Nav</a>
                    </li>
                    <li><a href="../horizontal-nav-icons/index.html">Horizontal Nav Icons</a>
                    </li>
                    <li><a href="../horizontal-nav/index.html">Horizontal Nav</a>
                    </li>
                    <li><a href="../ecommerce/index.html">Ecommerce</a>
                    </li>
                    <li><a href="../real-estate/index.html">Real Estate</a>
                    </li>
                    <li><a href="../university/index.html">University</a>
                    </li>
                </ul>
            </li>
            <li class="menu-item-has-children active"><a href="javascript:void(0);" class="ripple"><span class="color-color-scheme"><i class="fas fa-user-friends"></i><span class="hide-menu">Karyawan</span></span></a>
                <ul class="list-unstyled sub-menu">
                    <li><a href="app-calender.html">Calender</a>
                    </li>
                    <li><a href="app-chat.html">Chat</a>
                    </li>
                    <li class="menu-item-has-children"><a href="javascript:void(0);">Inbox</a>
                        <ul class="list-unstyled sub-menu">
                            <li><a href="app-inbox.html">Inbox</a>
                            </li>
                            <li><a href="app-inbox-single.html">Inbox single</a>
                            </li>
                            <li><a href="app-inbox-compose.html">Compose mail</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children"><a href="javascript:void(0);">Contacts</a>
                        <ul class="list-unstyled sub-menu">
                            <li><a href="app-contacts.html">Contacts List</a>
                            </li>
                            <li><a href="app-contacts-alt.html">Contacts List Alt</a>
                            </li>
                            <li><a href="app-contacts-details.html">Contact Details</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li> --}}
            <li><a href="{{route('dashboardAdmin')}}"><i class="fas fa-columns"></i> </i><span class="hide-menu">Dashboard</span></a>
            </li>
            <li><a href="{{route('karyawanAdmin')}}"><i class="fas fa-user-friends"></i><span class="hide-menu">Karyawan</span></a>
            </li>
            <li><a href="{{route('divisiAdmin')}}"><i class="fas fa-user-friends"></i><span class="hide-menu">Divisi</span></a>
            </li>
            <li><a href="{{route('detailMe')}}"><i class="fas fa-user-friends"></i><span class="hide-menu">Saya</span></a>
            </li>
        </ul>
        <!-- /.side-menu -->
    </nav>
    <!-- /.sidebar-nav -->
</aside>