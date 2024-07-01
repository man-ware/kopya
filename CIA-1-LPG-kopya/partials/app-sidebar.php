<div class="dashboard_sidebar" id="dashboard_sidebar">
    <h3 class="dashboard_logo" id="dashboard_logo">IMS</h3>
    <div class="dashboard_sidebar_user">
        <img src="css\user\user.png" alt="User image." id="userImage"/>
        <span id="userRole"><?= $user['first_name']. ' ' . $user['last_name'] ?></span>
    </div>
        <div class="dashboard_sidebar_menus" >
            <ul class="dashboard_menu_lists" >
           <!--  class="menuActive" -->
           <li class="liMainMenu">
                    <a href="./dashboard.php"><i class="fa-solid fa-gauge"></i> <span class="menuText"> Dashboard</span></a>
                </li>


                <li class="liMainMenu">
                    <a href="./pos.php"><i class="fa-solid fa-gauge"></i> <span class="menuText"> Point of Sales</span></a>
                </li>
                
                
                <li class="liMainMenu">
                    <a href="javascript:void(0);" class="showHideSubMenu">
                        <i class="fa-solid fa-truck showHideSubMenu"></i> 
                        <span class="menuText showHideSubMenu"> Customer Orders</span>
                        <i class="fa-solid fa-angle-down mainMenuIconArrow showHideSubMenu"></i> 
                    </a>
                    <ul class="subMenus">
                        <li><a class="subMenuLink" href="#"><i class="fa fa-circle-o"></i> View Customer Orders</a></li>
                        <li><a class="subMenuLink" href="#"><i class="fa fa-circle-o"></i> Add Customer Orders</a></li>
                    </ul> 
                </li>
                
                
                <li class="liMainMenu">
                    <a href="javascript:void(0);" class="showHideSubMenu">
                        <i class="fa-solid fa-tag showHideSubMenu"></i> 
                        <span class="menuText showHideSubMenu"> Products</span>
                        <i class="fa-solid fa-angle-down mainMenuIconArrow showHideSubMenu"></i> 
                    </a>
                    <ul class="subMenus">
                        <li><a class="subMenuLink" href="./product-view.php"><i class="fa fa-circle-o"></i> View Products</a></li>
                        <li><a class="subMenuLink" href="./product-add.php"><i class="fa fa-circle-o"></i> Add Products</a></li>
                    </ul> 
                </li>
                
                
                <li class="liMainMenu">                    
                    <a href="javascript:void(0);" class="showHideSubMenu">
                        <i class="fa-solid fa-truck showHideSubMenu"></i> 
                        <span class="menuText showHideSubMenu"> Suppliers</span>
                        <i class="fa-solid fa-angle-down mainMenuIconArrow showHideSubMenu"></i> 
                    </a>
                    <ul class="subMenus">
                        <li><a class="subMenuLink" href="#"><i class="fa fa-circle-o"></i> View Suppliers</a></li>
                        <li><a class="subMenuLink" href="#"><i class="fa fa-circle-o"></i> Add Suppliers</a></li>
                    </ul> 
                </li>
                
                
                <li class="liMainMenu">
                    <a href="javascript:void(0);" class="showHideSubMenu">
                        <i class="fa-solid fa-truck showHideSubMenu"></i> 
                        <span class="menuText showHideSubMenu"> Purchase Orders</span>
                        <i class="fa-solid fa-angle-down mainMenuIconArrow showHideSubMenu"></i> 
                    </a>
                    <ul class="subMenus">
                        <li><a class="subMenuLink" href="#"><i class="fa fa-circle-o"></i> View Purchase Orders</a></li>
                        <li><a class="subMenuLink" href="#"><i class="fa fa-circle-o"></i> Add Purchase Orders</a></li>
                    </ul> 
                </li>
                
                
                <li class="liMainMenu">
                    <a href="#"><i class="fa-solid fa-gauge"></i> <span class="menuText"> Reports</span></a>
                </li>
                
                
                <li class="liMainMenu showHideSubMenu">
                    <a href="javascript:void(0);" class="showHideSubMenu">
                        <i class="fa-solid fa-user-plus showHideSubMenu"></i> 
                        <span class="menuText showHideSubMenu"> Users</span>
                        <i class="fa-solid fa-angle-down mainMenuIconArrow showHideSubMenu"></i> 
                    </a>
                    <ul class="subMenus">
                        <li><a class="subMenuLink" href="./users-view.php"><i class="fa fa-circle-o"></i> View Users</a></li>
                        <li><a class="subMenuLink" href="./users-add.php"><i class="fa fa-circle-o"></i> Add Users</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>
</div>