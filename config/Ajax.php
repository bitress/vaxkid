<?php


include_once 'init.php';

//csrf protection
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest')
//    die("Sorry bro!");

$url = parse_url( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
if( !isset( $url['host']) || ($url['host'] != $_SERVER['SERVER_NAME']))
//    die("Sorry bro!");

$action = $_POST['action'];

switch ($action){

    case 'isLoggedIn':
        $login = new Login();
        $login->checkLogin();
        break;

    case 'userLogin':
        $login = new Login();
            $res = $login->userLogin($_POST['username'], $_POST['password'], $_POST['role']);
            if ($res === true){
                echo "true";
            }
        break;
    case 'registerChild':

        // Init Child Class
        $con = new Children();
        // Concatenate the city name and province
        $birth_place = $_POST['city_name'] . ', ' . $_POST['province_name'];
        $barangay = substr($_POST['address'], 0, strpos($_POST['address'], ','));

        // Insert Child info
        if ($con->insertInfo($_POST['firstname'], $_POST['middlename'], $_POST['lastname'], $_POST['birth_date'], $_POST['birth_time'], $birth_place, $_POST['hospital'], $_POST['obstetrician'], $_POST['pediatrician'], $_POST['gender'], $_POST['mother_name'], $_POST['father_name'], $_POST['address'], $barangay, $_POST['contact_number'], $_POST['delivery_type'], $_POST['weight'], $_POST['length'], $_POST['head_circumference'], $_POST['chest_circumference'], $_POST['blood_type'], $_POST['eye_color'], $_POST['hair_color'], $_POST['distinguishing_marks'], $_POST['newborn_screening_date'])){
                    echo "true";
        }
        break;

    case 'editChild':

        $con = new Children();
            $birth_place = $_POST['province'] . ', ' . $_POST['city'];
        $barangay = substr($_POST['address'], 0, strpos($_POST['address'], ','));
            if($con->editInfo($_POST['firstname'], $_POST['middlename'], $_POST['lastname'], $_POST['birth_date'], $_POST['birth_time'], $birth_place, $_POST['gender'], $_POST['hospital'], $_POST['obstetrician'], $_POST['pediatrician'], $_POST['child_id'], $_POST['mother_name'], $_POST['father_name'], $_POST['address'], $barangay, $_POST['contact_number'], $_POST['delivery_type'], $_POST['weight'], $_POST['length'], $_POST['head_circumference'], $_POST['chest_circumference'], $_POST['blood_type'], $_POST['eye_color'], $_POST['hair_color'], $_POST['distinguishing_marks'], $_POST['newborn_screening_date'])){
                echo "true";
            }

        break;

    case 'fetchChild':
        $con = new Children();
            $con->getChildJSON($_POST['id']);
        break;
    case 'deleteChild':
        $con = new Children();
        $res = $con->deleteChild($_POST['id']);
            if ($res){
                echo "true";
            }
        break;
    case 'setSchedule':
        onlyMHO();
        $con = new Schedule();
        $res = $con->set($_POST['message'], $_POST['start_date'], $_POST['end_date'], $_POST['barangay'], false, null);
        if ($res){
            echo "true";
        }
        break;

    case 'editSchedule':
        onlyMHO();

        $con = new Schedule();
        $res = $con->edit($_POST['barangay'], $_POST['message'], $_POST['start_date'], $_POST['end_date'], $_POST['schedule_id']);
        if ($res === true){
            echo "true";
        }

        break;

    case 'fetchSchedule':
        onlyMHO();

        $con = new Schedule();
        $con->fetchById($_POST['schedule_id']);
        break;

    case 'deleteSchedule':
        onlyMHO();
        $con = new Schedule();
        $res = $con->delete($_POST['id']);
        if ($res === true){
            echo "true";
        }
        break;

    case 'addVaccine';
        onlyMHO();
        $con = new Vaccine();
        $res = $con->addVaccine($_POST['vaccine_name'], $_POST['vaccine_quantity'], $_POST['vaccine_dosage'], $_POST['vaccine_origin'], $_POST['vaccine_manufacture'], $_POST['vaccine_expiration']);
        if($res === true){
            echo "true";
        }
        break;

    case 'fetchVaccine':
        onlyMHO();
        $con = new Vaccine();
        $con->fetchVaccineById($_POST['id']);
        break;

    case 'editVaccine':
        onlyMHO();
        $con = new Vaccine();
        $res = $con->editVaccine($_POST['vaccine_name'], $_POST['vaccine_quantity'], $_POST['vaccine_dosage'], $_POST['vaccine_origin'], $_POST['vaccine_manufacture'], $_POST['vaccine_expiration'], $_POST['vaccine_id']);
        if($res === true){
            echo "true";
        }
        break;

    case 'deleteVaccine':
        onlyMHO();
        $con = new Vaccine();
        $res = $con->deleteVaccine($_POST['vaccine_id']);
        if ($res === true){
            echo "true";
        }
        break;

    case 'dtFetchChildren':
        $dt = new Datatables();
        $dt->fetchchildren();
        break;

    case 'dtChildNotes':
        $dt = new Datatables();
        $dt->fetchChildNotes();
        break;

    case 'addChildNote':
        $dn = new DoctorNotes();
        $res = $dn->add($_POST['child_id'], $_POST['doctor_name'], $_POST['consultation_date'], $_POST['age'], $_POST['height'], $_POST['weight'], $_POST['head_circumference'], $_POST['chest_circumference'], $_POST['vaccine_administered'], $_POST['notes'], $_POST['next_visit']);
        if ($res === true){
            echo "true";
        }
        break;

    case 'administerFetch':
        $dn = new DoctorNotes();

        $dn->initAdministerChild($_POST['id']);

        break;

    case 'addMidwife':

        $con = new Midwife();
        $res = $con->add($_POST['firstname'], $_POST['middlename'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['position'], $_POST['assigned_barangay'], $_POST['address'], $_POST['contact_number'], $_POST['newpass'], $_POST['confirmpass']);
            if ($res === true){
                echo "true";
            }
        break;

    case 'fetchMidwife':

        $con = new Midwife();
        $con->fetchMidwife($_POST['id']);

        break;

    case 'deleteMidwife':
        
        $con = new Midwife();
        $res = $con->delete($_POST['id']);

        if($res === true){
            echo "true";
        }

        break;
    case 'editMidwife':

        $con = new Midwife();
        $res = $con->edit($_POST['id'], $_POST['firstname'], $_POST['middlename'], $_POST['lastname'], $_POST['position'], $_POST['address'], $_POST['contact_number'], $_POST['assigned_barangay']);
        if($res === true){
            echo "true";
        }
        break;
    case 'fetchUser':
        $con = new User();
        echo json_encode($con->getUserData($_POST['id'])) ;
        break;
    case 'editUser':

        $con = new User();
        $res = $con->editUserData($_POST['username'], $_POST['email'], $_POST['newpass'], $_POST['confirmpass'], $_POST['user_id']);

        if ($res === true){
            echo "true";
        }

    case 'countYearlyVaccinated':

        $counter = new Counter();
        $counter->countVaccinatedYearly();

        break;

    case 'countAllVaccinatedInEachBarangay':

        $counter = new Counter();
        $counter->countVaccinatedInEachBarangay();

        break;

    case 'countAllUnvaccinatedInEachBarangay':

        $counter = new Counter();
        $counter->countUnvaccinatedInEachBarangay();

        break;

    case 'fetchCalendarSchedule':

        $cal = new Calendar();
        $cal->fetch();


        break;

    case 'fetchNotification':

        $sched = new Schedule();
        $sched->fetchAsNotification();

        break;
    case 'fetchLoginUser':
        $id = Session::get('uid');

        $user = new User();
       echo json_encode($user->getUserData($id));

        break;

    case 'isMidwifeLogin':
        $login = new Login();
        if ($login->isLoggedIn()){
            if (Session::get('role') === 'midwife'){
                echo "true";
            }
        }
        break;
    case 'editUserSettings':

       $login = new User();
       $res = $login->editUserSettings($_POST['username'], $_POST['firstname'], $_POST['middlename'], $_POST['lastname'], $_POST['address'], $_POST['assigned_barangay'], $_POST['email'], $_POST['contact_number'], $_POST['oldpassword'], $_POST['newpassword'], $_POST['confirmpassword'], $_POST['user_id']);

        if ($res === true){
            echo "true";
        }
        break;

    case 'search':

        $user = new Children();
        $user->searchChild($_POST['query']);

        break;
    default:
        throw new \RuntimeException('Unexpected value');
}

function onlyMHO(){
        $login = new Login();
        if( ! $login->isLoggedIn() ) exit();

        $user = new User();
        if ( ! $user->mhoAccessOnly() ) exit();
}