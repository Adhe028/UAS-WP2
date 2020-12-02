<nav class="navbar navbar-expand navbar-dark bg-secondary static-top">

    <a class="navbar-brand ml-5" href="<?php echo site_url('home') ?>">
    <img style="width:80px; height:40px;" src='<?= base_url('asset/img/logoo.png'); ?>' alt="" ></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>


    <!-- Navbar -->
    <ul class="navbar-nav ml-auto md-0 mr-5 float-right ">

        <li class="nav-item dropdown no-arrow ">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i> Admin
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" onclick="return confirm('yakin ingin logout?');" href="<?= site_url('login/logout');?>" >Logout</a>
            </div>
        </li>
    </ul>

</nav>


<!-- Modal -->
<div class="modal fade" id="ProfilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">Profil</h1>
      </div>
      <div class="modal-body ">
        <div class="card " style="width: 29rem;">
          <img src='<?= base_url('asset/img/ade.jpg'); ?>' class="card-img-top" alt="pp">
          <div class="card-body">
            <h3 class="card-title">Ade Kurniawan</h3>
            <p class="card-text">Adalah seorang mahasiswa yang gitu deh...</p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Kelas 5D</li>
            <li class="list-group-item">NIM 18090088</li>
            <li class="list-group-item">Alamat Randusari</li>
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>