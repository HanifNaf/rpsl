<?php
    //Cek Jika Input Kosong
    function EmptyToNull($value){
        if (!$value){
            $value = null;
            return $value;
        } else {
            return $value;
        }
    }
?>