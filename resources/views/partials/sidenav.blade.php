<div class="sidebar-left">
    <!--responsive view logo start-->
    <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
        <a href="{{ action('PageController@dashboard') }}">
            <span class="brand-name">SysHG</span>
        </a>
    </div>

    <div class="sidebar-left-info">
        <ul class="nav nav-pills nav-stacked side-navigation">
            <li>
                <h3 class="navigation-title">Administrativo</h3>
            </li>
            <li class="{{ checkUrl(['/']) }}">
                <a href="{{ action('PageController@dashboard')  }}">
                    <i class="fa fa-home"></i><span>Dashboard</span>
                </a>
            </li>
            @role('users')
            <li class="menu-list {{ checkUrl(['users', 'roles', 'permissions']) }}">
                <a href=""><i class="fa fa-users"></i><span>Usuários</span></a>
                <ul class="child-list">
                    <li><a href="{{ action('UserController@index') }}" class="{{ checkUrl(['users']) }}">Usuários</a>
                    </li>
                    @role('roles')
                    <li><a href="{{ action('RoleController@index') }}" class="{{ checkUrl(['roles']) }}">Funções</a>
                    </li>
                    @endrole
                    @role('permissions')
                    <li><a href="{{ action('PermissionController@index') }}" class="{{ checkUrl(['permissions']) }}">Permissões</a>
                    </li>
                    @endrole
                </ul>
            </li>
            @endrole
            @role('empresas')
            <li class="{{ checkUrl(['empresas']) }}">
                <a href="{{ action('EmpresaController@index') }}">
                    <i class="fa fa-building-o"></i><span>Empresas</span>
                </a>
            </li>
            @endrole
            @role('ordens' || 'orcamentos')
            <li>
                <h3 class="navigation-title">Serviços</h3>
            </li>
            @role('orcamentos')
            <li class="menu-list {{ checkUrl(['orcamentos', 'orcamentos/enviados']) }}"><a href=""><i
                            class="fa fa-usd"></i><span>Orçamentos</span></a>
                <ul class="child-list">
                    <li><a href="{{ action('OrcamentoController@index') }}" class="{{ checkUrl(['orcamentos']) }}">Orçamentos</a>
                    </li>
                    @role('enviados')
                    <li><a href="{{ action('EmailController@index') }}" class="{{ checkUrl(['orcamentos/enviados']) }}">Enviados</a>
                    </li>
                    @endrole
                </ul>
            </li>
            @endrole
            @role('ordem-compra')
            <li class="menu-list {{ checkUrl(['ordens-compra', 'ordens-compra/relatorio']) }}">
                <a href="">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Ordens de Compra</span>
                </a>
                <ul class="child-list">
                    <li>
                        <a href="{{ action('OrdemCompraController@index') }}" class="{{ checkUrl(['ordens-compra']) }}">
                            Ordem de Compra
                        </a>
                    </li>
                    @permission('lancar-ordem-compra')
                    <li>
                        <a href="{{ action('OrdemCompraController@relatorio') }}"
                           class="{{ checkUrl(['ordens-compra/relatorio']) }}">
                            Relatórios
                        </a>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endrole

            @role('marketing')
            <li class="menu-list">
                <a href="#"><i class="fa fa-list"></i> Marketing</a>
                <ul class="child-list">
                    <li>
                        <a href="{{ action('ContatoController@index') }}">Contatos</a>
                        <a href="{{ action('ListaController@index') }}">Lista de Contatos</a>
                        <a href="">E-mails</a>
                    </li>
                </ul>
            </li>
            @endrole

            @endrole
            @role('log')
            <li>
                <h3 class="navigation-title">Registros</h3>
            </li>
            <li class="menu-list {{ checkUrl(['logs/orcamentos', 'logs/ordem-compras']) }}">
                <a href=""><i class="fa fa-users"></i><span>Logs</span></a>
                <ul class="child-list">
                    @permission('log-orcamento')
                    <li><a href="{{ action('LogController@orcamento') }}" class="{{ checkUrl(['logs/orcamentos']) }}">Log
                            de Orçamentos</a></li>
                    @endpermission
                    @permission('log-ordem-compra')
                    <li><a href="{{ action('LogController@ordemCompra') }}"
                           class="{{ checkUrl(['logs/ordem-compras']) }}">Log de Ordens de Compra</a></li>
                    @endpermission
                </ul>
            </li>
            @endrole

        </ul>

    </div>
</div>