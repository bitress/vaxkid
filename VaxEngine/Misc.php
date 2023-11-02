<?php

class Misc
{

    /**
     * Generate Select Option for Barangay
     * @return void
     */
    public static function generateBarangay(){
        $barangay = [ "Ag-aguman", "Ambalayat", "Baracbac", "Bario-an", "Baritao", "Becques", "Bimmanga", "Bio", "Bitalag", "Borono", "Bucao East", "Bucao West", "Cabaroan", "Cabugbugan", "Cabulanglangan", "Dacutan", "Dardarat", "Del Pilar", "Farola", "Gabur", "Garitan", "Jardin", "Lacong", "Lantag", "Las-ud", "Libtong", "Lubnac", "Magsaysay", "Malacañang", "Pacac", "Pallogan", "Pula", "Pudoc East", "Pudoc West", "Quirino", "Ranget", "Rizal", "Salvacion", "San Miguel", "Sawat", "Tallaoen", "Tampugo" ];

        $select = "";
        foreach ($barangay as $bar) {
            $select .= '<option value="'. $bar .'">'. $bar .'</option>';
        }
        echo $select;
    }


    public static function getAge($dateOfBirth){
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        return $diff->format('%y year/s old, %m month/s');

    }

}