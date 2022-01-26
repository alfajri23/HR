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
            <li><a href="{{route('dashboard')}}"><i class="fas fa-columns fa-lg mr-1"></i> </i><span class="hide-menu">Dashboard</span></a>
            </li>
            <li><a href="{{route('rankList')}}"><i class="fas fa-medal fa-lg mr-2"></i></i><span class="hide-menu">Ranking</span></a>
            </li>
            <li><a href="{{route('karyawanAdmin')}}"><i class="fas fa-user-friends fa-lg mr-1"></i><span class="hide-menu">Karyawan</span></a>
            </li>
            <li><a href="{{route('divisiAdmin')}}"><i class="fas fa-building fa-lg mr-3"></i></i><span class="hide-menu">Divisi</span></a>
            </li>
            <li><a href="{{route('ibadahList')}}"><i class="fas fa-pray fa-lg mr-3"></i></i><span class="hide-menu">Ibadah</span></a>
            </li>
            {{-- <li class="menu-item-has-children"><a href="javascript:void(0);"><i class="fas fa-briefcase fa-lg mr-3"></i>OKR</a>
                <ul class="list-unstyled sub-menu collapse in ml-5">
                    <li><a href="{{route('detailMe')}}"><i class="fas fa-calendar-day mr-2"></i>OKR Bulan ini
                    </li>
                    <li><a href="{{route('trackList')}}"><i class="fas fa-calendar-alt mr-2"></i></i>Riwayat OKR</a>
                    </li>
                    <li><a href="{{route('resultList')}}"><i class="fas fas fa-key mr-2"></i></i>Key result anda</a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li><a href="{{route('karyawanProfile')}}"><i class="fas fa-user fa-lg mr-3"></i><span class="hide-menu">Profile</span></a>
            </li> --}}
            
            
        </ul>
        <!-- /.side-menu -->
    </nav>
    <!-- /.sidebar-nav -->
</aside>