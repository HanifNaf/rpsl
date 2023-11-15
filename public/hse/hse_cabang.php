<?php
require_once ("../../config/config.php");
require_once (SITE_ROOT."/src/header-admin.php");
require_once (SITE_ROOT."/src/footer-admin.php");
?>

<style> 
  body {
  background: url("../assets/img/hse2.jpg")
    no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  font-family: "HelveticaNeue", "Arial", sans-serif;
  }

  .card-body:hover{
  filter: invert(1);
  }
</style>



<body>
<div class="container">
  <div class="text-right">
    <img src="<?= SITE_URL?>/public/assets/img/rpsl1.png" style="width: 110px; filter: drop-shadow(3px 4px 3px black)">
  </div>
</div>

  <br><br><br><br><br><br><br><br><br><br><br><br><br>

<div class="container">
  <div class="row">
    <div class="col-sm">
      <a href="<?= SITE_URL?>/public/hse/kecelakaan_kerja" target="_blank" style="text-decoration: none;">
      <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-body">
          <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.887 21.98c.076.026.15.027.226 0C13.084 21.65 20 19.018 20 11.253V4.304a.4.4 0 0 0-.303-.389l-7.6-1.903a.4.4 0 0 0-.194 0l-7.6 1.903A.4.4 0 0 0 4 4.304v6.948c0 7.687 6.918 10.387 7.887 10.728ZM12 7a1 1 0 0 1 1 1v2h2a1 1 0 1 1 0 2h-2v2a1 1 0 1 1-2 0v-2H9a1 1 0 1 1 0-2h2V8a1 1 0 0 1 1-1Z" /></svg>
          <h1 class="card-title" style="display: inline;"></h1>
          <p class="card-text">KECELAKAAN KERJA</p>
        </div>
      </div>
      </a>
    </div>

    <div class="col-sm">
      <a href="<?= SITE_URL?>/public/hse/pengawasan" target="_blank" style="text-decoration: none;">
      <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
        <div class="card-body">
          <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.887 21.98c.076.026.15.027.226 0C13.084 21.65 20 19.018 20 11.253V4.304a.4.4 0 0 0-.303-.389l-7.6-1.903a.4.4 0 0 0-.194 0l-7.6 1.903A.4.4 0 0 0 4 4.304v6.948c0 7.687 6.918 10.387 7.887 10.728ZM12 7a1 1 0 0 1 1 1v2h2a1 1 0 1 1 0 2h-2v2a1 1 0 1 1-2 0v-2H9a1 1 0 1 1 0-2h2V8a1 1 0 0 1 1-1Z" /></svg>
          <h1 class="card-title" style="display: inline;"></h1>
          <p class="card-text">PENGAWASAN PEKERJAAN</p>
        </div>
      </div>
      </a>
    </div>

    <div class="col-sm">
      <a href="<?= SITE_URL?>/public/hse/potensi_bahaya" target="_blank" style="text-decoration: none;">
      <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
        <div class="card-body">
          <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.887 21.98c.076.026.15.027.226 0C13.084 21.65 20 19.018 20 11.253V4.304a.4.4 0 0 0-.303-.389l-7.6-1.903a.4.4 0 0 0-.194 0l-7.6 1.903A.4.4 0 0 0 4 4.304v6.948c0 7.687 6.918 10.387 7.887 10.728ZM12 7a1 1 0 0 1 1 1v2h2a1 1 0 1 1 0 2h-2v2a1 1 0 1 1-2 0v-2H9a1 1 0 1 1 0-2h2V8a1 1 0 0 1 1-1Z" /></svg>
          <h1 class="card-title" style="display: inline;"></h1>
          <p class="card-text">POTENSI BAHAYA</p>
        </div>
      </div>
      </a>
    </div>

    <div class="col-sm">
      <a href="<?= SITE_URL?>/public/hse/pelanggaran" target="_blank" style="text-decoration: none;">
      <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
        <div class="card-body">
          <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.887 21.98c.076.026.15.027.226 0C13.084 21.65 20 19.018 20 11.253V4.304a.4.4 0 0 0-.303-.389l-7.6-1.903a.4.4 0 0 0-.194 0l-7.6 1.903A.4.4 0 0 0 4 4.304v6.948c0 7.687 6.918 10.387 7.887 10.728ZM12 7a1 1 0 0 1 1 1v2h2a1 1 0 1 1 0 2h-2v2a1 1 0 1 1-2 0v-2H9a1 1 0 1 1 0-2h2V8a1 1 0 0 1 1-1Z" /></svg>
          <h1 class="card-title" style="display: inline;"></h1>
          <p class="card-text">PELANGGARAN</p>
        </div>
      </div>
      </a>
    </div>
  </div>
</div>

</body>