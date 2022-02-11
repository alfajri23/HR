<aside class="site-sidebar scrollbar-enabled clearfix">
    
    <!-- Sidebar Menu -->
    <nav class="sidebar-nav">
        <ul class="nav in side-menu">
            <li><a href="{{route('dashboard')}}"><i class="fas fa-columns"></i> </i><span class="hide-menu">Dashboard</span></a>
            </li>
            <li><a href="{{route('rankList')}}"><i class="fas fa-medal fa-lg mr-2"></i></i><span class="hide-menu">Ranking</span></a>
            </li>
            <li class="menu-item-has-children"><a href="javascript:void(0);"><i class="fas fa-briefcase fa-lg mr-3"></i>OKR</a>
                <ul class="list-unstyled sub-menu collapse in ml-5">
                    <li><a href="{{route('detailMe')}}"><i class="fas fa-calendar-day mr-2"></i>Input Okr
                    </li>
                    <li><a href="{{route('trackList')}}"><i class="fas fa-calendar-alt mr-2"></i></i>Riwayat OKR</a>
                    </li>
                    <li><a href="{{route('resultList')}}"><i class="fas fas fa-key mr-2"></i></i>Key result anda</a>
                    </li>
                    <li><a href="{{route('trackHistoriUser')}}"><i class="fas fa-history mr-2"></i></i>Progres OKR</a>
                    </li>
                </ul>
            </li>
            
            <li class="menu-item-has-children"><a href="javascript:void(0);"><i class="far fa-calendar-minus fa-lg mr-3"></i>Perizinan</a>
                <ul class="list-unstyled sub-menu collapse in ml-5">
                    <li><a href="{{route('izinIndex')}}"><i class="fas fa-forward mr-2"></i></i>Izin</a>
                    </li>
                    <li><a href="{{route('izinSakit')}}"><i class="fas fa-head-side-cough mr-2"></i></i>Sakit</a>
                    </li>
                    <li><a href="{{route('cutiIndex')}}"><i class="far fa-copyright mr-2"></i></i>Cuti</a>
                    </li>
                    <li><a href="{{route('lemburIndex')}}"><i class="fas fa-laptop-house mr-2"></i></i>Lembur</a>
                    </li>
                    <li><a href="{{route('gantiIndex')}}"><i class="fas fa-user-clock mr-2"></i></i>Ganti jam</a>
                    </li>
                </ul>
            </li>
            
            <li><a href="{{route('ibadahInput')}}"><i class="fas fa-pray fa-lg mr-3"></i></i><span class="hide-menu">Ibadah</span></a>
            </li>
        </ul>
        <!-- /.side-menu -->
    </nav>
    <!-- /.sidebar-nav -->
</aside>