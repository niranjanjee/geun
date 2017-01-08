<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>
        <li class="treeview">
          <a href="/admin/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span>User Management</span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/admin/users"><i class="fa fa-circle-o"></i> Users</a></li>
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span>Sale Stores</span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/admin/salestores"><i class="fa fa-circle-o"></i>Sale Stores</a></li>
			<li class="active"><a href="/admin/category"><i class="fa fa-circle-o"></i>Categories</a></li>
            </li>
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-user-secret" aria-hidden="true"></i>
            <span>Admin Management</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/adminusers"><i class="fa fa-circle-o"></i>User List</a></li>
            <li><a href="/admin/adminusers/adduser"><i class="fa fa-circle-o"></i> Add User</a></li>
            </li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->