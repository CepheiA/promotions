    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{$dots}{PATH_COMPONENTS}/theme/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Alexander Pierce</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Buscar...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
          </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">MÓDULOS</li>
          <li class="treeview {if $active eq 'promotion'}active{/if}">
            <a href="../promociones/">
              <i class="fa fa-cart-arrow-down"></i> <span>Promociones</span>
            </a>           
          </li>

          <li class="treeview {if $active eq 'user'}active{/if}">
            <a href="../usuarios/">
              <i class="fa fa-user-plus"></i> <span>Usuarios</span>
            </a>           
          </li>

          <li class="treeview {if $active eq 'search'}active{/if}">
            <a href="../buscador/">
              <i class="fa fa-search"></i> <span>Buscador</span>
            </a>           
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>