<?php

$arr_menus = array();
 
    $arr_menu = array(
            'icon'       => 'mdi mdi-gauge',
            'menu_title' => 'Dashboard',
            'menu_link'  => url('/home'),
            'active_function'  => '/',
            'active_parameter' => 'dashboard',
            'breadcrumbs_main' => 'dashboard',
    );

    $arr_menus[] = $arr_menu;
    ## User Module
    $arr_menu = array(
            'icon'       => 'fa-users',
            'menu_title' => 'Manage Users',
            'menu_link'  => url('user'),
            'active_function'  => 'user',
            'active_parameter' => 'user',
            'breadcrumbs_main' => 'Users',
    );
    $arr_menu['submenu_items'][] = array(
            'menu_title' => 'All Users',
            'menu_link'  =>  url('user'),
            'sub_active_function' => 'user',
            'breadcrumbs_sub' => 'Users',
    );

    $arr_menu['submenu_items'][] = array(
            'menu_title' => 'Add Users',
            'menu_link'  =>  url('user/create'),
            'sub_active_function' => 'user',
            'breadcrumbs_sub' => 'Add Users',
    );
    $arr_menus[] = $arr_menu;
    
?>

<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li class="nav-devider"></li>
        @php ($active_function = (Request::segment(1) != '') ? Request::segment(1) : '')
        
        @if(!empty($arr_menus))    
            @foreach ($arr_menus as $arr_menu)
                @php($active = ($active_function == $arr_menu['active_function']) ? 'active' : '')
                @php($has_submenu = array_key_exists('submenu_items', $arr_menu))
                <li class="{{$active}}"> 
                    <a class="@if($has_submenu == 1)has-arrow @endif waves-effect waves-dark" href="{{ $arr_menu['menu_link'] }}" aria-expanded="false">
                        <i class="fa {{ $arr_menu['icon'] }}"></i>
                        <span class="hide-menu">{{ $arr_menu['menu_title'] }}</span>
                    </a>
                    @if($has_submenu)    
                    <ul aria-expanded="false" class="collapse">
                        @foreach ($arr_menu['submenu_items'] as $arr_submenu)
                            <li>
                                <a href="{{ $arr_submenu['menu_link'] }}">
                                    {{ $arr_submenu['menu_title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>
</nav>