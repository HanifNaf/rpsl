<?php
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/koneksi.php");

$query_boiler = "SELECT boiler_id, tanggal, alkalinity_booster, oxygen_scavenger, 
                internal_treatment, condensate_treatment, m3_air,
                cost_alkalinity_booster, cost_oxygen_scavenger, 
                cost_internal_treatment,cost_condensate_treatment, solid_additive, cost_solid_additive
                FROM chemical_boiler
                ORDER BY tanggal DESC;";

$prep_boiler = $koneksi_wtp -> prepare($query_boiler);

try{
        $koneksi_wtp -> beginTransaction();
        $prep_boiler -> execute();
        $koneksi_wtp -> commit();

}catch(PDOException $e){
        echo "PDO Error: ". $e -> getMessage();

}finally{
        
        $boiler_arr = $prep_boiler -> fetchAll(PDO::FETCH_ASSOC);
        $boiler_row = $koneksi_wtp -> query('select count(*) from chemical_boiler') -> fetchColumn();
        
        //Check Array Hasil
        //if (!$boiler_arr){
        //        echo "error";
        //}else{
        //        print_r($boiler_arr);
        //}
}
?>