<aside class="site-sidebar scrollbar-enabled clearfix">
    
    <!-- Sidebar Menu -->
    <nav class="sidebar-nav">
        <ul class="nav in side-menu">
            <li><a href="{{route('dashboard')}}"><i class="fas fa-columns"></i> </i><span class="hide-menu">Dashboard</span></a>
            </li>
            <li><a href="{{route('rankList')}}"><i class="fas fa-medal fa-lg mr-2"></i></i><span class="hide-menu">Ranking</span></a>
            </li>
            {{-- <li><a href="{{route('detailMe')}}"><i class="fas fa-user-friends"></i><span class="hide-menu">Saya</span></a>
            </li> --}}
            <li class="menu-item-has-children"><a href="javascript:void(0);"><i class="fas fa-briefcase fa-lg mr-3"></i>OKR</a>
                <ul class="list-unstyled sub-menu collapse in ml-5">
                    <li><a href="{{route('detailMe')}}"><i class="fas fa-calendar-day mr-2"></i>OKR Bulan ini
                    </li>
                    <li><a href="{{route('trackList')}}"><i class="fas fa-calendar-alt mr-2"></i></i>Riwayat OKR</a>
                    </li>
                    <li><a href="{{route('resultList')}}"><i class="fas fas fa-key mr-2"></i></i>Key result anda</a>
                    </li>
                   
                </ul>
            </li>
            <li><a href="{{route('karyawanProfile')}}"><i class="fas fa-user fa-lg mr-3"></i><span class="hide-menu">Profile</span></a>
            </li>
            
        </ul>
        <!-- /.side-menu -->
    </nav>
    <!-- /.sidebar-nav -->
</aside>