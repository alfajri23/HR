
<nav class="navbar">
    <!-- Logo Area -->
    <div class="navbar-header">
        <a href="{{route('dashboard')}}" class="navbar-brand">
            <h4 class="logo-expand mx-auto">HR Program</h4>
            <h4 class="logo-collapse mx-auto">HR</h4>

            <!-- <p>OSCAR</p> -->
        </a>
    </div>
    <!-- /.navbar-header -->
    
    {{-- MENU --}}
    <ul class="nav navbar-nav">
        <li class="sidebar-toggle"><a href="javascript:void(0)" class="ripple"><i class="fas fa-ellipsis-v"></i></a>
        </li>
    </ul>

    <!-- /.navbar-search -->
    <div class="spacer"></div>

    <ul class="nav navbar-nav d-none d-lg-block">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle ripple" data-toggle="dropdown">
                <i class="far fa-bell"></i> 
                <span class="badge badge-border bg-primary countNoti">{{count($noti)}}</span>
                <span class="my-0">Notifikasi</span>
            </a>
            <div class="dropdown-menu dropdown-left dropdown-card dropdown-card-dark animated flipInY">
                <div class="card">
                    <header class="card-header">New notifications 
                        <span class="countNoti" class="mr-l-10 badge badge-border badge-border-inverted bg-primary">{{count($noti)}}</span>
                    </header>
                    <ul class="list-unstyled dropdown-list-group">
                        @forelse ($noti as $n)
                            <li id="listNoti-{{$n->id}}">
                                <a href="#" class="media">
                                    <span class="d-flex"><i class="far fa-bell" style="color: gold"></i> </span>
                                    <span class="media-body">
                                        {{-- <span class="media-heading">{{$n->nama}}</span>  --}}
                                        <small style="color: ghostwhite">{{now()}}</small> 
                                        <span class="card-header">{{$n->nama}}</span>
                                        @hasrole('admin')
                                        <small>
                                            <button onclick="baca({{$n->id}})" class="btn btn-primary btn-sm">Tandai baca</button>
                                        </small> 
                                        @endhasrole
                                    </span>
                                </a>
                            </li>
                        @empty
                            <p>Tidak ada notifikasi</p>
                            
                        @endforelse
                    </ul>
                    <!-- /.dropdown-list-group -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.dropdown-menu -->
        </li>
    </ul>
    <div class="btn-list dropdown d-none d-md-flex mx-3">
        <a style="color: #858d8c;" href="javascript:void(0);" class="dropdown-toggle ripple" data-toggle="dropdown">
            <i class="fas fa-user"></i>
            Profile
        </a>
        <div class="dropdown-menu dropdown-left animated flipInY">    
            <a class="dropdown-item" href="{{route('karyawanProfile')}}">Profil saya</a>  
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
        
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</nav>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': `Bearer {{Session::get('token')}}`
        }
    });
    
    let count = $('.countNoti').innerHTML;
    
    function baca(id){
        $.ajax({
            type : 'GET',
            url  : "{{ route('notiBaca') }}",
            data : {
                id : id
            },
            dataType: 'json',
            success : (data)=>{
                console.log(data);
                $('.countNoti').html(count-1);
                $("#listNoti-"+id).remove();
            }
        });
    }
</script>