<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url()?>assets/gambar/logo.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata("nama"); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU</li>
      <li class="masterktg">
        <a href="<?php echo base_url() ?>masterktg">
          <i class="fa fa-th"></i> <span>Kategori Barang</span>
        </a>
      </li>
      <li class="mastersubktg">
        <a href="<?php echo base_url() ?>mastersubktg">
          <i class="fa fa-dropbox"></i> <span>Sub Kategori Barang</span>
        </a>
      </li>
      <li class="masterbrg">
        <a href="<?php echo base_url() ?>masterbrg">
          <i class="fa fa-shopping-cart"></i> <span>Barang</span>
        </a>
      </li>
    </ul>
  </section>
</aside>
