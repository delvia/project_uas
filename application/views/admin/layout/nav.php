<!-- Sidebar Menu -->
<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
<!-- MENU DASHBOARD -->
<a href="<?php echo base_url ('admin/dasbor') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>DASHBOARD</p>
            </a>

<!-- MENU TRANSAKSO -->
<a href="<?php echo base_url ('admin/transaksi') ?>" class="nav-link">
              <i class="fa fa-check text-aqua"></i>
              <p>TRANSAKSI</p>
            </a>

<!-- MENU PRODUK -->
<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-sitemap"></i>
              <p>
              PRODUK
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/produk') ?>" class="nav-link">
                  <i class="fa fa-table"></i>
                  <p>Data Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/produk/tambah') ?>" class="nav-link">
                  <i class="fa fa-plus"></i>
                  <p>Tambah Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/kategori') ?>" class="nav-link">
                  <i class="fa fa-tags"></i>
                  <p>Kategori Produk</p>
                </a>
              </li>
              </ul>
          </li>
              
<!-- MENU PRODUK -->
<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-sitemap"></i>
              <p>
              BERITA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/berita') ?>" class="nav-link">
                  <i class="fa fa-table"></i>
                  <p>Data Berita</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/berita/tambah') ?>" class="nav-link">
                  <i class="fa fa-plus"></i>
                  <p>Tambah Berita</p>
                </a>
              </li>
              </ul>
              </li>
             
              
<!-- MENU REKENING -->
<a href="<?php echo base_url ('admin/rekening') ?>" class="nav-link">
              <i class="fa fa-dollar text-aqua"></i>
              <p>DATA REKENING</p>
            </a>
  
<!-- MENU USER -->
<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-lock"></i>
              <p>
              PENGGUNA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/user') ?>" class="nav-link">
                  <i class="fa fa-table"></i>
                  <p>Data Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/user/tambah') ?>" class="nav-link">
                  <i class="fa fa-plus"></i>
                  <p>Tambah Pengguna</p>
                </a>
              </li>
              </ul>
          </li>
          



          <!-- MENU KONFIGURASI -->
<li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="fa fa-wrench"></i>
        <p>
        KONFIGURASI WEBSITE
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('admin/konfigurasi') ?>" class="nav-link">
            <i class="fa fa-home"></i>
            <p>Konfigurasi Umum</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('admin/konfigurasi/logo') ?>" class="nav-link">
            <i class="fa fa-image"></i>
            <p>Konfigurasi Logo</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('admin/konfigurasi/icon') ?>" class="nav-link">
            <i class="fa fa-home"></i>
            <p>Konfigurasi Icon</p>
          </a>
        </li>
            

        <li class="nav-item">
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  

       

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> <?php echo $title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              
           </div>

           <!-- /.card-header -->
           <div class="card-body">
         