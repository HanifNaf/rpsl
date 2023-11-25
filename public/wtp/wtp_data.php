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
                cooling_water_dispersant, oxy_hg, sulfuric_acid, 
                cost_corrotion_inhibitor, cost_cooling_water_dispersant, cost_oxy_hg, cost_sulfuric_acid
                FROM cooling_tower
                ORDER BY tanggal DESC;";

$query_sungai = "SELECT sungai_id, tanggal, koagulan, flokulan, soda_ash,
                cost_koagulan, cost_flokulan, cost_soda_ash, m3_air
                FROM sungai
                ORDER BY tanggal DESC;";

$query_ro = "SELECT ro_id, tanggal, anti_scalant, alkalinity_booster, asam_s4241, asam_hcl, basa_s4243, 
                basa_caustik, cartridge_40, cartridge_30, cost_anti_scalant, cost_alkalinity_booster, 
                cost_asam_s4241, cost_asam_hcl, cost_basa_s4243, cost_basa_caustik, cost_cartridge_40, cost_cartridge_30, m3_air
                FROM ro
                ORDER BY tanggal DESC;";                

//Prepare Statements
$prep_boiler = $koneksi_wtp -> prepare($query_boiler);
$prep_ct = $koneksi_wtp -> prepare($query_ct);
$prep_sungai = $koneksi_wtp -> prepare($query_sungai);
$prep_ro = $koneksi_wtp -> prepare($query_ro);


try{
        //Connection
        $koneksi_wtp -> beginTransaction();

        $prep_boiler -> execute();
        $prep_ct -> execute();
        $prep_sungai -> execute();
        $prep_ro -> execute();

        $koneksi_wtp -> commit();

}catch(PDOException $e){
        echo "PDO Error: ". $e -> getMessage();

}finally{
        
        //Fetch Data
        $boiler_arr = $prep_boiler -> fetchAll(PDO::FETCH_ASSOC);
        $boiler_row = $koneksi_wtp -> query('select count(*) from chemical_boiler') -> fetchColumn();

        $ct_arr = $prep_ct -> fetchAll(PDO::FETCH_ASSOC);
        $ct_row = $koneksi_wtp -> query('select count(*) from cooling_tower') -> fetchColumn();
        
        $sungai_arr = $prep_sungai -> fetchAll(PDO::FETCH_ASSOC);
        $sungai_row = $koneksi_wtp -> query('select count(*) from sungai') -> fetchColumn();

        $ro_arr = $prep_ro -> fetchAll(PDO::FETCH_ASSOC);
        $ro_row = $koneksi_wtp -> query('select count(*) from ro') -> fetchColumn();
        
        ////Check Array Hasil
        //if (!$ro_arr){
        //        echo "error";
        //}else{
        //        print_r($ro_arr);
        //}
}
?>