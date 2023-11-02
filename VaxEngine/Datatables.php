<?php

class Datatables
{

    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->user = new User();
    }

    public function fetchchildren(){

        $u = $this->user->getData();

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value
        $searchArray = array();

        if ($u['role'] === 'midwife'){
            $barangay = $u['assigned_barangay'];
            $barangay = explode(",", $barangay);
            $barangay_query = "";
            foreach ($barangay as $bar){
                $barangay_query .= " OR barangay = '$bar'";
            }
        } else {
            $barangay_query = "";
        }



        // Search
        $searchQuery = " ";
        if($searchValue != ''){
            $searchQuery = " AND (
           child_firstname LIKE :child_firstname OR child_middlename LIKE :child_middlename OR child_lastname LIKE :child_lastname
           ) ";
            $searchArray = array(
                'child_firstname'=>"%$searchValue%",
                'child_middlename'=>"%$searchValue%",
                'child_lastname'=>"%$searchValue%"
            );
        }

        // Total number of records without filtering
        $stmt = $this->db->prepare("SELECT COUNT(*) AS allcount FROM `child_info` ");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        // Total number of records with filtering
        $stmt = $this->db->prepare("SELECT COUNT(*) AS allcount FROM `child_info` WHERE 1 ". $barangay_query ." ".$searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        // Fetch records
        if ($u['role'] == 'midwife') {
            $stmt = $this->db->prepare("SELECT * FROM `child_info` WHERE barangay = '1' " . $barangay_query . " " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");
        } else {
            $stmt = $this->db->prepare("SELECT * FROM `child_info` WHERE 1 " . $barangay_query . " " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

        }
        // Bind values
        foreach ($searchArray as $key=>$search) {
            $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        $data = array();

        foreach ($empRecords as $row) {
            $data[] = array(
                "child_firstname"=>$row['child_firstname'],
                "birth_date"=>$row['birth_date'],
                "mother_name"=>$row['mother_name'],
                "contact_number"=>$row['contact_number'],
                "address"=>$row['address'],
                "btn"=> '<button class="btn btn-success btn-sm view-child" data-id="'. htmlentities($row['child_id'], ENT_QUOTES | ENT_HTML5) .'"><i class="fa fa-eye"></i></button>'
            );
        }

        // Response
        $response = array(
            "draw" => (int)$draw,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }

    public function fetchChildNotes()
    {

        $id = $_POST['child_id'];
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        $searchArray = array();

        // Search
        $searchQuery = " ";
        if($searchValue != ''){
            $searchQuery = " AND (
           child_firstname LIKE :child_firstname ) ";
            $searchArray = array(
                'child_firstname'=>"%$searchValue%",
            );
        }

        // Total number of records without filtering
        $stmt = $this->db->prepare("SELECT COUNT(*) AS allcount FROM `doctor_notes` WHERE child_id = '$id'");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        // Total number of records with filtering
        $stmt = $this->db->prepare("SELECT COUNT(*) AS allcount FROM doctor_notes INNER JOIN child_info ON child_info.child_id = doctor_notes.child_id INNER JOIN vaccines ON vaccines.id = doctor_notes.vaccine_administered WHERE doctor_notes.child_id = '$id' ".$searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        // Fetch records
        $stmt = $this->db->prepare("SELECT doctor_notes.*, child_info.birth_date, vaccines.* FROM doctor_notes INNER JOIN child_info ON child_info.child_id = doctor_notes.child_id INNER JOIN vaccines ON vaccines.id = doctor_notes.vaccine_administered WHERE doctor_notes.child_id = '$id' ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

        // Bind values
        foreach ($searchArray as $key=>$search) {
            $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        $data = array();

        foreach ($empRecords as $row) {

            $age = Misc::getAge($row['birth_date']);
            $data[] = array(
                "doctor_name"=>$row['doctor_name'],
                "consultation_date"=>$row['consultation_date'],
                "age"=> $age,
                "height"=> $row['height'],
                "weight"=> $row['weight'],
                "head_circumference"=> $row['head_circumference'],
                "chest_circumference"=> $row['chest_circumference'],
                "vaccine_name"=>$row['name'],
                "notes"=>$row['notes'],
                "next_visit"=>$row['next_visit'],
            );
        }

        // Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);



    }


    public function fetchAllChildNotes()
    {

        $id = $_POST['child_id'];
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        $searchArray = array();

        // Search
        $searchQuery = " ";
        if($searchValue != ''){
            $searchQuery = " AND (
           child_firstname LIKE :child_firstname ) ";
            $searchArray = array(
                'child_firstname'=>"%$searchValue%",
            );
        }

        // Total number of records without filtering
        $stmt = $this->db->prepare("SELECT COUNT(*) AS allcount FROM `doctor_notes` WHERE child_id = '$id'");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        // Total number of records with filtering
        $stmt = $this->db->prepare("SELECT COUNT(*) AS allcount FROM doctor_notes INNER JOIN child_info ON child_info.child_id = doctor_notes.child_id INNER JOIN vaccines ON vaccines.id = doctor_notes.vaccine_administered WHERE doctor_notes.child_id = '$id' ".$searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        // Fetch records
        $stmt = $this->db->prepare("SELECT * FROM doctor_notes INNER JOIN child_info ON child_info.child_id = doctor_notes.child_id INNER JOIN vaccines ON vaccines.id = doctor_notes.vaccine_administered WHERE doctor_notes.child_id = '$id' ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

        // Bind values
        foreach ($searchArray as $key=>$search) {
            $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        $data = array();

        foreach ($empRecords as $row) {

            $age = Misc::getAge($row['birth_date']);
            $data[] = array(
                "doctor_name"=>$row['doctor_name'],
                "consultation_date"=>$row['consultation_date'],
                "age"=> $age,
                "height"=> $row['height'],
                "weight"=> $row['weight'],
                "head_circumference"=> $row['head_circumference'],
                "chest_circumference"=> $row['chest_circumference'],
                "vaccine_name"=>$row['name'],
                "notes"=>$row['notes'],
                "next_visit"=>$row['next_visit'],
            );
        }

        // Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);



    }

}