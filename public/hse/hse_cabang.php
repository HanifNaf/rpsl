<?php
require_once ("../../config/config.php");
require_once (SITE_ROOT."/src/header-admin.php");
require_once (SITE_ROOT."/src/footer-admin.php");
?>

<style> 
  body {
  background: url("../assets/img/bchse.png")
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
          <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 60 60"><path fill="#FFFFFF" d="M61,35.85v-7.7L52.31,26.7a20.38,20.38,0,0,0-2.21-5.31l5.13-7.18L49.79,8.77,42.61,13.9a20.38,20.38,0,0,0-5.31-2.21L35.85,3h-7.7L26.7,11.69a20.38,20.38,0,0,0-5.31,2.21L14.21,8.77,8.77,14.21l5.13,7.18a20.38,20.38,0,0,0-2.21,5.31L3,28.15v7.7l8.69,1.45a20.38,20.38,0,0,0,2.21,5.31L8.77,49.79l5.44,5.44,7.18-5.13a20.38,20.38,0,0,0,5.31,2.21L28.15,61h7.7l1.45-8.69a20.38,20.38,0,0,0,5.31-2.21l7.18,5.13,5.44-5.44L50.1,42.61a20.38,20.38,0,0,0,2.21-5.31ZM32,47A15,15,0,1,1,47,32,15,15,0,0,1,32,47Zm2-17h5v4H34v5H30V34H25V30h5V25h4ZM32,19A13,13,0,1,0,45,32,13,13,0,0,0,32,19Zm9,17H36v5H28V36H23V28h5V23h8v5h5Z" /></svg>
          <h1 class="card-title" style="display: inline;"></h1>
          <p class="card-text">KECELAKAAN KERJA</p>
        </div>
      </div>
      </a>
    </div>

    <div class="col-sm">
      <a href="<?= SITE_URL?>/public/hse/pengawasan" target="_blank" style="text-decoration: none;">
      <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
        <div class="card-body">
          <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 60 60"><path fill="#FFFFFF" d="M61,35.85v-7.7L52.31,26.7a20.38,20.38,0,0,0-2.21-5.31l5.13-7.18L49.79,8.77,42.61,13.9a20.38,20.38,0,0,0-5.31-2.21L35.85,3h-7.7L26.7,11.69a20.38,20.38,0,0,0-5.31,2.21L14.21,8.77,8.77,14.21l5.13,7.18a20.38,20.38,0,0,0-2.21,5.31L3,28.15v7.7l8.69,1.45a20.38,20.38,0,0,0,2.21,5.31L8.77,49.79l5.44,5.44,7.18-5.13a20.38,20.38,0,0,0,5.31,2.21L28.15,61h7.7l1.45-8.69a20.38,20.38,0,0,0,5.31-2.21l7.18,5.13,5.44-5.44L50.1,42.61a20.38,20.38,0,0,0,2.21-5.31ZM32,47A15,15,0,1,1,47,32,15,15,0,0,1,32,47Zm2-17h5v4H34v5H30V34H25V30h5V25h4ZM32,19A13,13,0,1,0,45,32,13,13,0,0,0,32,19Zm9,17H36v5H28V36H23V28h5V23h8v5h5Z" /></svg>
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
          <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 60 60"><path fill="#FFFFFF" fill="#FFFFFF" d="M61,35.85v-7.7L52.31,26.7a20.38,20.38,0,0,0-2.21-5.31l5.13-7.18L49.79,8.77,42.61,13.9a20.38,20.38,0,0,0-5.31-2.21L35.85,3h-7.7L26.7,11.69a20.38,20.38,0,0,0-5.31,2.21L14.21,8.77,8.77,14.21l5.13,7.18a20.38,20.38,0,0,0-2.21,5.31L3,28.15v7.7l8.69,1.45a20.38,20.38,0,0,0,2.21,5.31L8.77,49.79l5.44,5.44,7.18-5.13a20.38,20.38,0,0,0,5.31,2.21L28.15,61h7.7l1.45-8.69a20.38,20.38,0,0,0,5.31-2.21l7.18,5.13,5.44-5.44L50.1,42.61a20.38,20.38,0,0,0,2.21-5.31ZM32,47A15,15,0,1,1,47,32,15,15,0,0,1,32,47Zm2-17h5v4H34v5H30V34H25V30h5V25h4ZM32,19A13,13,0,1,0,45,32,13,13,0,0,0,32,19Zm9,17H36v5H28V36H23V28h5V23h8v5h5Z" /></svg>
          <h1 class="card-title" style="display: inline;"></h1>
          <p class="card-text">POTENSI BAHAYA</p>
        </div>
      </div>
      </a>
    </div>

    <div class="col-sm">
      <a href="<?= SITE_URL?>/public/hse/pelanggaran" target="_blank" style="text-decoration: none;">
      <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-body">
          <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 60 60"><path fill="#FFFFFF" d="M61,35.85v-7.7L52.31,26.7a20.38,20.38,0,0,0-2.21-5.31l5.13-7.18L49.79,8.77,42.61,13.9a20.38,20.38,0,0,0-5.31-2.21L35.85,3h-7.7L26.7,11.69a20.38,20.38,0,0,0-5.31,2.21L14.21,8.77,8.77,14.21l5.13,7.18a20.38,20.38,0,0,0-2.21,5.31L3,28.15v7.7l8.69,1.45a20.38,20.38,0,0,0,2.21,5.31L8.77,49.79l5.44,5.44,7.18-5.13a20.38,20.38,0,0,0,5.31,2.21L28.15,61h7.7l1.45-8.69a20.38,20.38,0,0,0,5.31-2.21l7.18,5.13,5.44-5.44L50.1,42.61a20.38,20.38,0,0,0,2.21-5.31ZM32,47A15,15,0,1,1,47,32,15,15,0,0,1,32,47Zm2-17h5v4H34v5H30V34H25V30h5V25h4ZM32,19A13,13,0,1,0,45,32,13,13,0,0,0,32,19Zm9,17H36v5H28V36H23V28h5V23h8v5h5Z" /></svg>
          <h1 class="card-title" style="display: inline;"></h1>
          <p class="card-text">PELANGGARAN</p>
        </div>
      </div>
      </a>
    </div>
  </div>
</div>

</body>