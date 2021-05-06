<?php
include_once('config.php'); 
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo PATH; ?>/img/admin.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?> </p>
                <a href="#"><i class="fa fa-circle text-success"></i><span id="spantype"> <?php echo $_SESSION['type']; ?></span></a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU NAVIGATION</li>
            <?php 
                if($_SESSION['type']=='Admin'||$_SESSION['type']=='Store'||$_SESSION['type']=='Manager')
                {
                ?>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-cubes"></i>
                    <span>Store</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> ระบบ
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo PATH; ?>/po/"><i class="fa fa-book"></i> ใบสั่งซื้อสินค้า</a></li>
                            <li><a href="<?php echo PATH; ?>/receive/"><i class="fa fa-truck"></i> ใบรับสินค้า</a></li>
                            <li><a href="<?php echo PATH; ?>/issue/"><i class="fa fa-calendar-check-o"></i> ยืนยันการส่งสินค้า</a>
                            <li><a href="<?php echo PATH; ?>/transfer/"><i class="fa fa-exchange"></i>
                                    ย้ายคลังสินค้า</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> รายงาน
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo PATH; ?>/stock_card/"><i class="fa fa-book"></i> เช็คยอดพัสดุ</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> จัดการค่าพื้นฐาน
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo PATH; ?>/inventory/"><i class="fa fa-cube"></i> ระบบจัดการพัสดุ</a>
                            </li>
                            <li><a href="<?php echo PATH; ?>/unit/"><i class="fa fa-ticket"></i> ระบบจัดการ Unit</a>
                            </li>
                            <li><a href="<?php echo PATH; ?>/supplier/"><i class="fa fa-id-card-o"></i> จัดการผู้ขาย</a>
                            </li>
                            <li><a href="<?php echo PATH; ?>/places/"><i class="fa fa-home"></i>
                                    ระบบจัดการสถานที่เก็บ</a></li>
                            <li><a href="<?php echo PATH; ?>/storage_unit/"><i class="fa fa-cubes"></i>
                                    ระบบจัดการประเภทUnit</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <?php 
                }
                if($_SESSION['type']=='Admin'||$_SESSION['type']=='Sales'||$_SESSION['type']=='Sales Leader'||$_SESSION['type']=='Manager')
                {
                ?>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Sales</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo PATH; ?>/so/"><i class="fa fa-cart-plus"></i> ใบสั่งขาย
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo PATH; ?>/stock_card/"><i class="fa fa-book"></i> เช็คยอดพัสดุ
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo PATH; ?>/customer/"><i class="fa fa-id-card-o"></i>
                            ระบบจัดการลูกค้า</a>
                    </li>
                </ul>


            </li>
            <?php 
                }
                if($_SESSION['type']=='Admin'||$_SESSION['type']=='Office'||$_SESSION['type']=='Manager')
                {
                ?>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-edit"></i>
                    <span>Office</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo PATH; ?>/so_approve/"><i class="fa fa-check-circle"></i>
                            อนุมัติขาย</a></li>
                    <li><a href="<?php echo PATH; ?>/stock_card/"><i class="fa fa-book"></i> เช็คยอดพัสดุ</a>
                    </li>
                    <li><a href="<?php echo PATH; ?>/report/sales_by_year"><i class="fa fa-bar-chart"></i>
                            รายงานการขายรายปี</a></li>
                    <li><a href="<?php echo PATH; ?>/report/sales_by_stock"><i class="fa fa-bar-chart"></i>
                            รายงานการขายรายพัสดุ</a></li>
                    <li><a href="<?php echo PATH; ?>/report/debtor"><i class="fa fa-bar-chart"></i>
                            รายงานลูกหนี้รายตัว</a></li>
                    <li><a href="<?php echo PATH; ?>/report/top_sales"><i class="fa fa-bar-chart"></i>
                    รายงานปริมาณการขายตามพัสดุ</a></li>


                </ul>


            </li>
            <?php 
                }
                if($_SESSION['type']=='Admin'||$_SESSION['type']=='Manager'||$_SESSION['type']=='Sales Leader')
                {
                ?>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-book"></i>
                    <span>Account</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo PATH; ?>/account/"><i class="fa fa-check-circle"></i>
                            อนุมัติขาย</a></li>
                    <li><a href="<?php echo PATH; ?>/stock_card/"><i class="fa fa-book"></i> เช็คยอดพัสดุ</a>
                    </li>
                </ul>


            </li>
            <?php 
                }
                if($_SESSION['type']=='Admin')
                {
                ?>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-users"></i>
                    <span>USER</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li id="menuuser"><a href="<?php echo PATH; ?>/user/"><i class="fa fa-circle-o"></i> User</a></li>

                </ul>

            </li>
            <?php
                }
                ?>

            <li class="header">SYSTEM</li>
            <li><a href="<?php echo PATH_CSS; ?>/logout.php"><i class="fa fa-sign-out  text-white"></i> <span>Log
                        Out</span></a></li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>