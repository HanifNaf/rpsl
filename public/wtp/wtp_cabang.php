<?php
require_once ("../../config/config.php");
require_once (SITE_ROOT."/src/header-admin.php");
require_once (SITE_ROOT."/src/footer-admin.php");
?>

<style> 
  body {
  background: url("../assets/img/wtp.jpg")
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

  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<center>
<div class="container" >
  <div class="row">
    <div class="col-sm">
      <a href="<?= SITE_URL?>/public/operasional/operasional" target="_blank" style="text-decoration: none;">
      <div class="card text-white" style="background-color: #004225; max-width: 18rem;">
         <div class="card-body">
          <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 100 100"><path fill="#FFFFFF" d="M65.8,55.2H34.2L17.6,81.8c-0.7,1-0.4,2-0.1,2.6c0.2,0.5,0.9,1.3,2.2,1.3h60.6c1.2,0,1.9-0.7,2.2-1.3     c0.3-0.5,0.6-1.5-0.1-2.6L65.8,55.2z"/><path fill="#FFFFFF"  d="M92.5,75.6L67.1,34.8c-0.7-1.2-1.1-2.6-1.1-4V9.3h2.7c1.9,0,3.4-1.5,3.4-3.4s-1.5-3.4-3.4-3.4H31.4C29.5,2.5,28,4,28,5.9     s1.5,3.4,3.4,3.4h2.7v21.5c0,1.4-0.4,2.8-1.1,4L7.5,75.6c-2.8,4.5-2.9,9.9-0.4,14.5c2.6,4.6,7.2,7.4,12.5,7.4h60.6     c5.3,0,10-2.8,12.5-7.4C95.4,85.5,95.2,80.1,92.5,75.6z M86.9,86.9c-1.4,2.4-3.8,3.9-6.6,3.9H19.7c-2.8,0-5.3-1.5-6.6-3.9     c-1.4-2.4-1.3-5.3,0.2-7.7l25.4-40.8c1.4-2.3,2.2-4.9,2.2-7.6V9.3h18.4v21.5c0,2.7,0.7,5.3,2.2,7.6l25.4,40.8     C88.2,81.5,88.3,84.4,86.9,86.9z" /></svg>
          <h1 class="card-title" style="display: inline;"></h1>
          <p class="card-text">PENGGUNAAN CHEMICAL</p>
        </div>
      </div>
      </a>
    </div>

    <div class="col-sm">
      <a href="<?= SITE_URL?>/public/operasional/operasional_maintenance" target="_blank" style="text-decoration: none;">
      <div class="card text-white" style="background-color: #007FFF; max-width: 18rem;">
        <div class="card-body">
          <svg style="width:40px;height:40px; float: right; margin-top: 5px;" viewBox="0 0 100 100"><path fill="#FFFFFF" d="M94.25,52.91a36.53,36.53,0,0,1-49,34.32h-.07a.75.75,0,0,0-.45,1.42,38,38,0,0,0,27-71.1L71.3,19A36.35,36.35,0,0,1,94.25,52.91Z"/><path fill="#FFFFFF" d="M55.06,59.84a.75.75,0,0,1,1.5.08,22.09,22.09,0,0,1-.73,4.7,12.11,12.11,0,0,0,1.91.17A11.89,11.89,0,0,0,69.62,52.91a11.72,11.72,0,0,0-1.21-5.21.76.76,0,0,1,.35-1,.75.75,0,0,1,1,.35,13.21,13.21,0,0,1,1.36,5.87A13.39,13.39,0,0,1,57.74,66.29a13.11,13.11,0,0,1-2.36-.22,19,19,0,0,1-6.06,8.48c.64.24,1.28.47,1.94.66l.9,5H63.32l.91-5a22.75,22.75,0,0,0,4.69-1.95l4.15,2.87L81,68.24l-2.87-4.15a23.07,23.07,0,0,0,2-4.69l5-.91V47.33l-5-.9a23.4,23.4,0,0,0-2-4.7L81,37.58l-7.89-7.89-4.15,2.87a23.28,23.28,0,0,0-4.69-1.94l-.91-5H52.16l-.9,5A23.45,23.45,0,0,0,47.57,32a91.87,91.87,0,0,1,4.54,8.76,13.35,13.35,0,0,1,12.32.52.75.75,0,0,1,.27,1,.74.74,0,0,1-1,.27,11.89,11.89,0,0,0-11-.45,57.3,57.3,0,0,1,2.65,7.64.76.76,0,0,1-.54.92.75.75,0,0,1-.91-.54C49.43,33.13,33.65,14.56,30.48,11c-4,4.54-27.94,32.81-24.22,52,1.17,6,5,10.57,11.36,13.62a30.08,30.08,0,0,0,25.72,0C50.75,73,54.7,67.37,55.06,59.84Z" /></svg>
          <h1 class="card-title" style="display: inline;"></h1>
          <p class="card-text">PRODUKSI AIR</p>
        </div>
      </div>
      </a>
    </div>
  </div>
</div>
</center>

</body>