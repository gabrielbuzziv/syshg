<div class="header-section">

    <div class="logo dark-logo-bg hidden-xs hidden-sm">
        <a href="{{ action('PageController@dashboard') }}">
            <span class="brand-name">SysHG</span>
        </a>
    </div>

    <div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
        <a href="{{ action('PageController@dashboard') }}">
            <span class="brand-name">SysHG</span>
        </a>
    </div>

    <a class="toggle-btn"><i class="fa fa-outdent"></i></a>

    <div class="right-notification">
        <ul class="notification-menu">

            <li>
                <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    {{ Auth::User()->name }}
                    <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu purple pull-right">
                    <li><a href="{{ action('UserController@editPassword') }}">Alterar Senha</a></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i>Sair</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>