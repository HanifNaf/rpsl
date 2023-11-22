<script>
    document.getElementById('fileInput').onchange = function () {
  		alert('Selected file: ' + this.value);
		};
</script>

<form enctype="multipart/form-data" action="tes_index.php" method="POST">
    <?php     
        for($i=1; $i<=1; $i++){ ?>
        <tr>
            <!-- Lampiran -->
            <td class="custom-black-bg">Lampiran</td>
            <td> <input type="file" name="lampiran" class="form-control" width=20%> </td>
       </tr>
    <?php } ?>
    <button type="submit" name="add" class="btn btn-primary"><i class="fas fa-save"></i> TAMBAH DATA</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $isiFile = $_FILES['lampiran'];
}
    
?>

