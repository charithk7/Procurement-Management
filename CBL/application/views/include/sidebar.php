<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!--<div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url(); ?>assets/admin/dist/img/user.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php// echo $first_name; ?> <?php //echo $last_name; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->


        <!-- search form -->
        <form ng-submit="submit(search_text)" ng-controller="searchController" class="hidden sidebar-form">
            <div class="input-group">
                <input type="text"   name="search_text" ng-model="search_text" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit"  id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>



                <li class="hidden" ng-class="{ active: isCurrentPath('/dashboard') }"><a href="#/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>


                <li ng-class="{ active: isCurrentPath('/purchase_order') }"><a href="#purchase_order"><i class="fa fa-suitcase"></i> <span>Contracts</span></a></li>


                <li ng-class="{ active: isCurrentPath('/note_grn') }"><a href="#note_grn"><i class="fa fa-truck"></i> <span>Deliveries</span></a></li>

                <li ng-class="{ active: isCurrentPath('/weigh_bridge') }"><a href="#weigh_bridge"><i class="fa fa-balance-scale"></i> <span>Weigh Bridge</span></a></li>

                <li ng-class="{ active: isCurrentPath('/suppliers') }"><a href="#suppliers"><i class="fa fa-users"></i> <span>Suppliers</span></a></li>


            <li class="header hidden">OTHER</li>

            <!--<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>-->
            <li class="hidden"><a href="#"><i class="fa fa-question text-yellow"></i> <span>Help</span></a></li>
            <li class="hidden"><a href="#"><i class="fa fa-info text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>