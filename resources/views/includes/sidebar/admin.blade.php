<aside class="site-sidebar scrollbar-enabled clearfix">
    
    <!-- Sidebar Menu -->
    <nav class="sidebar-nav">
        <ul class="nav in side-menu">
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
            <li class="menu-item-has-children"><a href="javascript:void(0);"><i class="fas fa-forward fa-lg mr-3"></i>Izin</a>
                <ul class="list-unstyled sub-menu collapse in ml-5">
                    <li><a href="{{route('izinAdmin')}}"><i class="fas fa-forward mr-2"></i></i>Izin bulan ini</a>
                    </li>
                    <li><a href="{{route('izinHistori')}}"><i class="fas fa-history mr-2"></i></i>Riwayat izin</a>
                    </li>
                </ul>
            </li>
            <li class="menu-item-has-children"><a href="javascript:void(0);"><i class="far fa-copyright fa-lg mr-3"></i>Cuti</a>
                <ul class="list-unstyled sub-menu collapse in ml-5">
                    <li><a href="{{route('cutiAdmin')}}"><i class="far fa-copyright mr-2"></i></i>Cuti bulan ini</a>
                    </li>
                    <li><a href="{{route('cutiHistori')}}"><i class="fas fa-history mr-2"></i></i>Riwayat cuti</a>
                    </li>
                </ul>
            </li>
            <li class="menu-item-has-children"><a href="javascript:void(0);"><i class="fas fa-laptop-house fa-lg mr-3"></i>Lembur</a>
                <ul class="list-unstyled sub-menu collapse in ml-5">
                    <li><a href="{{route('lemburAdmin')}}"><i class="fas fa-laptop-house mr-2"></i></i>Lembur bulan ini</a>
                    </li>
                    <li><a href="{{route('lemburHistori')}}"><i class="fas fa-history mr-2"></i></i>Riwayat lembur</a>
                    </li>
                </ul>
            </li>
            <li class="menu-item-has-children"><a href="javascript:void(0);"><i class="fas fa-user-clock fa-lg mr-3"></i>Ganti jam</a>
                <ul class="list-unstyled sub-menu collapse in ml-5">
                    <li><a href="{{route('gantiAdmin')}}"><i class="fas fa-user-clock mr-2"></i></i>Ganti bulan ini</a>
                    </li>
                    <li><a href="{{route('gantiHistori')}}"><i class="fas fa-history mr-2"></i></i>Riwayat ganti jam</a>
                    </li>
                </ul>
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