<?php
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/koneksi.php");

//Queries
$query_boiler = "SELECT boiler_id, tanggal, alkalinity_booster, oxygen_scavenger, 
                internal_treatment, condensate_treatment, m3_air,
                cost_alkalinity_booster, cost_oxygen_scavenger, 
                cost_internal_treatment,cost_condensate_treatment, solid_additive, cost_solid_additive
                FROM chemical_boiler
                ORDER BY tanggal DESC;";

$query_ct = "SELECT cooling_tower_id, tanggal, corrotion_inhibitor,
                cooling_water_dispersant, oxy_hg, sulphuric_acid, 
                cost_corrotion_inhibitor, cost_cooling_water_dispersant, cost_oxy_hg, cost_sulphuric_acid
                FROM cooling_tower
                ORDER BY tanggal DESC;";

//Prepare Statements
$prep_boiler = $koneksi_wtp -> prepare($query_boiler);
$prep_ct = $koneksi_wtp -> prepare($query_ct);


try{
        //Connection
        $koneksi_wtp -> beginTransaction();
        $prep_boiler -> execute();
        $prep_ct -> execute();
        $koneksi_wtp -> commit();

}catch(PDOException $e){
        echo "PDO Error: ". $e -> getMessage();

}finally{
        
        //Fetch Data
        $boiler_arr = $prep_boiler -> fetchAll(PDO::FETCH_ASSOC);
        $boiler_row = $koneksi_wtp -> query('select count(*) from chemical_boiler') -> fetchColumn();

        $ct_arr = $prep_ct -> fetchAll(PDO::FETCH_ASSOC);
        $ct_row = $koneksi_wtp -> query('select count(*) from cooling_tower') -> fetchColumn();
        
        //Check Array Hasil
        //if (!$ct_arr){
        //        echo "error";
        //}else{
        //        print_r($ct_arr);
        //}
}
?>