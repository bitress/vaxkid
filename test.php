<?php


$barangay = [ "Ag-aguman", "Ambalayat", "Baracbac", "Bario-an", "Baritao", "Becques", "Bimmanga", "Bio", "Bitalag", "Borono", "Bucao East", "Bucao West", "Cabaroan", "Cabugbugan", "Cabulanglangan", "Dacutan", "Dardarat", "Del Pilar", "Farola", "Gabur", "Garitan", "Jardin", "Lacong", "Lantag", "Las-ud", "Libtong", "Lubnac", "Magsaysay", "Malacañang", "Pacac", "Pallogan", "Pula", "Pudoc East", "Pudoc West", "Quirino", "Ranget", "Rizal", "Salvacion", "San Miguel", "Sawat", "Tallaoen", "Tampugo" ];
$selected = ['Bio', "Tampugo"];
$select = "";

foreach ($barangay as $bar) {
    $selectedAttribute = in_array($bar, $selected) ? ' selected' : '';
    $select .= '<option value="'. $bar .'"'. $selectedAttribute .'>'. $bar .'</option>';
}
echo $select;