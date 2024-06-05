<!-- Main Sidebar Container -->
@php 
        $generalSetting = get_general_settings();
        $siteLogo       = '';
        $siteficon      = '';
        $siteTitle      = '';
            if(!empty($generalSetting)){
              if(isset($generalSetting['gs_ficon'])){                
                    $siteSidebarIcon = $generalSetting['gs_sidebaricon'];
                    $siteSidebarIcon = $siteSidebarIcon ? $siteSidebarIcon : '';

                    $siteficon       = $generalSetting['gs_ficon'];
                    $siteficon       = $siteficon ? $siteficon : '';

                    $siteTitle       = $generalSetting['gs_sitetitle'];
                    $siteTitle       = $siteTitle ? $siteTitle : '';
                    
                    $gs_adminlogo       = $generalSetting['gs_adminlogo'];
                    $gs_adminlogo       = $gs_adminlogo ? $gs_adminlogo : '';
              }
            }
        @endphp
    
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}/admin" class="brand-link">
        @if(!empty($siteSidebarIcon))
          <span class="brand-text font-weight-light">
            <img src="{{ asset($siteSidebarIcon )}}" width="230px" alt="{{$siteTitle}}" class="sidebar-img" alt="sidebar-icon">
          </span>
        @else
        <span class="brand-text font-weight-light">Lact Shuttle Co</span>
        @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(isset($usermenu))
          @foreach($usermenu as $key => $menu)
            @if(in_array($key, $menus) || Auth::user()->role=="admin")
              @php
                $active_link = array();
                foreach($menu['active_link'] as $val){
                  if($val!='admin'){
                    $active_link[] = $val."/*";
                  }else{
                    $active_link[] = $val;
                  }
                }
              @endphp
              <li class="nav-item {{ (isset($menu['sub']) && !(empty($menu['sub']))) ? (((in_array(Request::path(), $menu['active_link'])) || Request::is($active_link)) ? 'has-treeview menu-open' : 'has-treeview') : '' }}">
                <a href="{{ URL($menu['link'])}}" class="nav-link {{ (in_array(Request::path(), $menu['active_link']) || Request::is($active_link)) ? 'active' : '' }}">
                  <i class="fas {{ $menu['icon']}} nav-icon"></i>
                  <p>
                    {{ $menu['value'] }}
                    @if(isset($menu['sub']) && !(empty($menu['sub'])))
                      <i class="fas fa-angle-left right"></i>
                    @endif
                  </p>
                </a>
                @if(isset($menu['sub']) && !(empty($menu['sub'])))
                <ul class="nav nav-treeview">
                    @foreach($menu['sub'] as $submenu)
                      @php
                      $subactive_link = array();
                      foreach($submenu['active_link'] as $subval){
                        if($subval!='admin'){
                          // $subactive_link[] = $subval."/*";
                          $subactive_link[] = $subval."/";
                        }else{
                          $subactive_link[] = $subval;
                        }
                      }
                      @endphp
                      <li class="nav-item">
                        <a href="{{ URL($submenu['link']) }}" class="nav-link {{ (in_array(Request::path(), $submenu['active_link']) || Request::is($subactive_link)) ? 'active' : '' }}">
                          <i class="far {{ $submenu['icon'] }} nav-icon"></i>
                          <p>{{ $submenu['value'] }}</p>
                        </a>
                      </li>
                    @endforeach
                </ul>
                @endif
              </li>
            @endif
          @endforeach
        @endif
          <li class="nav-item ">
              <a onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();" data-turbolinks="false" href="{{ route('logout') }}" class="nav-link ">
                <i class="fas fa-power-off nav-icon"></i>
                <p>Log out</p>
              </a>
          </li>
            <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
              @csrf
            </form>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>