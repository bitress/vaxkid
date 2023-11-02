<?php

include_once '../config/init.php';

if (!$login->isLoggedIn()){
    header("Location: login.php");
}

?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Children List
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <button class="btn btn-light btn-sm text-primary" type="button" data-bs-toggle="modal" data-bs-target="#add_child"><i class="me-1" data-feather="user-plus"></i>Add New Child</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table id="childDatatable" class="table table-striped table-sm nowrap responsive dt-responsive">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Birth Date</th>
                        <th>Mother's Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Birth Date</th>
                        <th>Mother's Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php

                    /** @var User $u */
                    if ($u['role'] === 'midwife'){
                        $children = new Children();
                        $child = $children->getAllChildren($u['assigned_barangay']);
                    } else {
                        $children = new Children();
                        $child = $children->getAllChildren();
                    }
                    foreach ($child as $c):
                        ?>
                        <tr id="tr_<?= $c['child_id'] ?>">
                            <td>
                                <?= htmlentities($c['child_firstname'], ENT_QUOTES | ENT_HTML5); ?>
                            </td>
                            <td>
                                <?= htmlentities($c['child_middlename'], ENT_QUOTES | ENT_HTML5); ?>
                            </td>
                            <td>
                                <?= htmlentities($c['child_lastname'], ENT_QUOTES | ENT_HTML5); ?>
                            </td>
                            <td>
                                <?= htmlentities($c['birth_date'], ENT_QUOTES | ENT_HTML5) ?>
                            </td>
                            <td>
                                <?= htmlentities($c['mother_name'], ENT_QUOTES | ENT_HTML5) ?>
                            </td>
                            <td> <?= htmlentities($c['contact_number'], ENT_QUOTES | ENT_HTML5) ?></td>

                            <td> <?= htmlentities($c['address'], ENT_QUOTES | ENT_HTML5) ?></td>

                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-primary edit-child" data-id="<?= htmlentities($c['child_id'], ENT_QUOTES | ENT_HTML5) ?>"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-outline-danger delete-child" data-id="<?= htmlentities($c['child_id'], ENT_QUOTES | ENT_HTML5) ?>" data-name="<?= htmlentities($c['child_firstname']); ?>"><i class="fa fa-trash"></i></button>
                                    <button type="button" class="btn btn-outline-success administer-child" data-age="<?= Misc::getAge($c['birth_date']) ?>" data-id="<?= htmlentities($c['child_id'], ENT_QUOTES | ENT_HTML5) ?>">Administer</button>
                                </div>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>
                </table>
                </div>
            </div>

        </div>
    </div>
</main>


<div class="modal fade" id="add_child" tabindex="-1" role="dialog" aria-labelledby="add_child" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a Child</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addChildForm" name="addChildForm">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Child Information</h2>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="firstname">First Name<span class="required">*</span></label>
                                    <input class="form-control form-control-sm" name="firstname" type="text" placeholder="Enter Child First Name" oninput="this.value = this.value.toUpperCase()">
                                </div>

                                <div class="col-md-4">
                                    <label for="firstname">Middle Name</label>
                                    <input class="form-control form-control-sm" name="middlename" type="text" placeholder="Enter Child Middle Name" oninput="this.value = this.value.toUpperCase()">
                                </div>

                                <div class="col-md-4">
                                    <label for="firstname">Last Name<span class="required">*</span></label>
                                    <input class="form-control form-control-sm" name="lastname" type="text" placeholder="Enter Child Last Name" oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <label for="child_name">Child's Birth Date<span class="required">*</span></label>
                                    <input class="form-control form-control-sm dtp" name="birth_date" type="text" id="birthdate_picker" placeholder="Enter Birth Date (Ex. yyyy/mm/dd)">
                                </div>
                                <div class="col-md-3">
                                    <label for="child_name">Time of Birth<span class="required">*</span></label>
                                    <input class="form-control form-control-sm" name="birth_time" type="time" placeholder="Enter child name">
                                </div>
                                <div class="col-md-3">
                                    <label for="child_name">Gender<span class="required">*</span></label>
                                    <select name="gender" class="form-control form-control-sm">
                                        <option disabled selected>Choose Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="child_name">Child's Birth Place<span class="required">*</span></label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="select_region">Region<span class="required">*</span></label><select class="form-select form-select-sm" name="region" id="select_region"></select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="select_province">Province<span class="required">*</span></label><select class="form-select form-select-sm" name="province" id="select_province"></select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="select_city">City/Town<span class="required">*</span></label><select class="form-select form-select-sm" name="city" id="select_city"></select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Hospital<span class="required">*</span></label>
                                <input class="form-control form-control-sm" name="hospital" type="text" placeholder="Enter Hospital (if applicable)" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Obstetrician</label>
                                <input class="form-control form-control-sm" name="obstetrician" type="text" placeholder="Enter Obstetrician (if applicable)" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Pediatrician</label>
                                <input class="form-control form-control-sm" name="pediatrician" type="text" placeholder="Enter Pediatrician (if applicable)" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <h2>Child Guardian Information</h2>

                            <div class="mb-3">
                                <label for="child_name">Mother's Name<span class="required">*</span></label>
                                <input class="form-control form-control-sm" name="mother_name" type="text" placeholder="Enter Mother's Name" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Father's Name</label>
                                <input class="form-control form-control-sm" name="father_name" type="text" placeholder="Enter Father's Name" oninput="this.value = this.value.toUpperCase()">
                            </div>


                            <h2>Contact Information</h2>

                            <div class="mb-3">
                                <label for="child_name">Address<span class="required">*</span></label>
                                <input class="form-control form-control-sm" name="address" type="text" placeholder="Enter Address (Ex. Quirino, Tagudin, Ilocos Sur)" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Contact Number<span class="required">*</span></label>
                                <input class="form-control form-control-sm" name="contact_number" type="number" placeholder="Enter Contact Number">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h2>Child Birth Information</h2>
                            <div class="mb-3">
                                <label for="child_name">Type of Delivery<span class="required">*</span></label>
                                <input class="form-control form-control-sm" name="delivery_type" type="text" placeholder="Enter Child Type of Delivery" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Weight<span class="required">*</span></label>
                                <input class="form-control form-control-sm" name="weight" type="text" placeholder="Enter Child's Weight">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Length</label>
                                <input class="form-control form-control-sm" name="length" type="text" placeholder="Enter Child's Length">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Head Circumference</label>
                                <input class="form-control form-control-sm" name="head_circumference" type="text" placeholder="Enter Child's Head Circumference">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Chest Circumference</label>
                                <input class="form-control form-control-sm" name="chest_circumference" type="text" placeholder="Enter Child's Chest Circumference">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Blood Type</label>
                                <input class="form-control form-control-sm" name="blood_type" type="text" placeholder="Enter Child's Blood Type" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Eye Color</label>
                                <input class="form-control form-control-sm" name="eye_color" type="text" placeholder="Enter Child's Eye Color" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Hair Color</label>
                                <input class="form-control form-control-sm" name="hair_color" type="text" placeholder="Enter Child's Hair Color" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Distinguishing Marks</label>
                                <input class="form-control form-control-sm" name="distinguishing_marks" type="text" placeholder="Enter Distinguishing Marks"oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Newborn Screening Date<span class="required">*</span></label>
                                <input class="form-control form-control-sm dtp" id="nsd_datepicker" name="newborn_screening_date" type="text" placeholder="Enter Newborn Screening Date">
                            </div>

                        </div>
                    </div>

            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" id="saveChildButton" type="button">Save</button></div>
        </div>
        </form>
    </div>
</div>

<!--Edit Child Modal-->

<div class="modal fade" id="editChildModal" tabindex="-1" role="dialog" aria-labelledby="add_child" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit a Child</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editChildForm" name="editChildForm">
                    <div class="row">
                        <input type="hidden" id="edit_child_id" name="child_id">
                        <div class="col-md-6">
                            <h2>Child Information</h2>

                            <div class="row mb-3">

                                <div class="col-md-4">
                                    <label for="edit_firstname">First Name</label>
                                    <input class="form-control form-control-sm"  id="edit_firstname" name="firstname" type="text" placeholder="Enter Child First Name" oninput="this.value = this.value.toUpperCase()">
                                </div>

                                <div class="col-md-4">
                                    <label for="firstname">Middle Name</label>
                                    <input class="form-control form-control-sm" id="edit_middlename" name="middlename" type="text" placeholder="Enter Child Middle Name" oninput="this.value = this.value.toUpperCase()">
                                </div>

                                <div class="col-md-4">
                                    <label for="firstname">Last Name</label>
                                    <input class="form-control form-control-sm" id="edit_lastname" name="lastname" type="text" placeholder="Enter Child Last Name" oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="edit_birth_date">Child's Birth Date</label>
                                    <input class="form-control form-control-sm dtp edit_birth_date" name="birth_date" type="text" id="birthdate_picker" placeholder="Enter Birth Date (Ex. yyyy/mm/dd)">
                                </div>
                                <div class="col-md-4">
                                    <label for="edit_birth_time">Time of Birth</label>
                                    <input id="edit_birth_time" class="form-control form-control-sm" name="birth_time" type="time" placeholder="Enter child name">
                                </div>
                                <div class="col-md-4">
                                    <label for="edit_gender">Gender</label>
                                    <select id="edit_gender" name="gender" class="form-control form-control-sm">
                                        <option disabled selected>Choose Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Child's Birth Place</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="edit_province">Province</label>
                                        <input id="edit_province" type="text" class="form-control form-control-sm" name="province">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_town">City/Town</label>
                                        <input id="edit_town" type="text" class="form-control form-control-sm" name="city">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Hospital</label>
                                <input id="edit_hospital" class="form-control form-control-sm" name="hospital" type="text" placeholder="Enter Hospital (if applicable)" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Obstetrician</label>
                                <input id="edit_obstetrician" class="form-control form-control-sm" name="obstetrician" type="text" placeholder="Enter Obstetrician (if applicable)" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="child_name">Pediatrician</label>
                                <input id="edit_pediatrician" class="form-control form-control-sm" name="pediatrician" type="text" placeholder="Enter Pediatrician (if applicable)" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <h2>Child Guardian Information</h2>

                            <div class="mb-3">
                                <label for="edit_mother">Mother's Name</label>
                                <input id="edit_mother" class="form-control form-control-sm" name="mother_name" type="text" placeholder="Enter Mother's Name" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="edit_father">Father's Name</label>
                                <input id="edit_father" class="form-control form-control-sm" name="father_name" type="text" placeholder="Enter Father's Name" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <h2>Contact Information</h2>

                            <div class="mb-3">
                                <label for="edit_address">Address</label>
                                <input id="edit_address" class="form-control form-control-sm" name="address" type="text" placeholder="Enter Address" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="edit_contact">Contact Number</label>
                                <input id="edit_contact" class="form-control form-control-sm" name="contact_number" type="text" placeholder="Enter Contact Number">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h2>Child Birth Information</h2>
                            <div class="mb-3">
                                <label for="edit_delivery_type">Type of Delivery</label>
                                <input id="edit_delivery_type" class="form-control form-control-sm" name="delivery_type" type="text" placeholder="Enter Child Type of Delivery" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="edit_weight">Weight</label>
                                <input id="edit_weight" class="form-control form-control-sm" name="weight" type="text" placeholder="Enter Child's Weight">
                            </div>

                            <div class="mb-3">
                                <label for="edit_length">Length</label>
                                <input id="edit_length" class="form-control form-control-sm" name="length" type="text" placeholder="Enter Child's Length">
                            </div>

                            <div class="mb-3">
                                <label for="edit_head_circumference">Head Circumference</label>
                                <input id="edit_head_circumference" class="form-control form-control-sm" name="head_circumference" type="text" placeholder="Enter Child's Head Circumference">
                            </div>

                            <div class="mb-3">
                                <label for="edit_chest_circumference">Chest Circumference</label>
                                <input id="edit_chest_circumference" class="form-control form-control-sm" name="chest_circumference" type="text" placeholder="Enter Child's Chest Circumference">
                            </div>

                            <div class="mb-3">
                                <label for="edit_blood_type">Blood Type</label>
                                <input id="edit_blood_type" class="form-control form-control-sm" name="blood_type" type="text" placeholder="Enter Child's Blood Type" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="edit_eye_color">Eye Color</label>
                                <input id="edit_eye_color" class="form-control form-control-sm" name="eye_color" type="text" placeholder="Enter Child's Eye Color" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="edit_hair_color">Hair Color</label>
                                <input id="edit_hair_color" class="form-control form-control-sm" name="hair_color" type="text" placeholder="Enter Child's Hair Color" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="edit_distinguishing_marks">Distinguishing Marks</label>
                                <input id="edit_distinguishing_marks" class="form-control form-control-sm" name="distinguishing_marks" type="text" placeholder="Enter Distinguishing Marks" oninput="this.value = this.value.toUpperCase()">
                            </div>

                            <div class="mb-3">
                                <label for="edit_newborn_screening_date">Newborn Screening Date</label>
                                <input id="edit_newborn_screening_date" class="form-control form-control-sm dtp" name="newborn_screening_date" type="text" placeholder="Enter Newborn Screening Date">
                            </div>

                        </div>


                    </div>

            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" id="editChildButton" type="button">Save</button></div>
        </div>
        </form>
    </div>
</div>


<div class="modal fade" id="administerChildModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dn_childname"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="card-body">

                        <form id="administerForm">
                            <input type="hidden" name="administerchild_id" id="administerchild_id">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="doctor_name">Enter Vaccinator's Name</label>
                                    <input type="text" name="doctor_name" id="doctor_name" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="consultation_date">Consultation Date</label>
                                    <input type="text" name="consultation_date" id="consultation_date" value="" class="form-control form-control-sm">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="age">Age</label>
                                    <input type="text" name="age" id="age" value="" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-3">
                                    <label for="height">Height</label>
                                    <input type="text" name="height" id="height" class="form-control form-control-sm">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="weight">Weight</label>
                                    <input type="text" name="weight" id="weight" class="form-control form-control-sm">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="head_circumference">Head Circumference</label>
                                    <input type="text" name="head_circumference" id="head_circumference" class="form-control form-control-sm">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="chest_circumference">Chest Circumference</label>
                                    <input type="text" name="chest_circumference" id="chest_circumference" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label for="vaccine_administered">Vaccine Administered</label>
                                    <select multiple="multiple" id="vaccine_administered" class="form-control vaccinetoadminister form-control-sm">
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="next_visit">Next Visit</label>
                                    <input type="text" name="next_visit" id="next_visit" class="form-control form-control-sm dtp">
                                </div>

                            </div>

                            <div class="mb-3">
                                <label for="notes">Notes</label>
                                <textarea name="notes" id="notes" class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <button type="button" id="adchild" class="btn btn-secondary">Administer Child</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<script type="text/javascript" src="js/manage-children.js"></script>
<script>


    var notyf = new Notyf({
        duration: 1000,
        position: {
            x: 'right',
            y: 'top',
        }});

    $( function() {
        $( ".dtp" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });

        $("#adchild").on('click', function (){




            var data = new FormData($("#administerForm")[0]);
            data.append("action", "addChildNote");
            data.append("child_id", $("#administerchild_id").val());
            data.append("vaccine_administered", $("#vaccine_administered").val())

            // let res = JSON.stringify(Object.fromEntries(data));
            // alert(res);

            $.ajax({
                type: 'post',
                url: 'config/Ajax.php',
                data: data,
                contentType: false,
                processData: false,
                success: function (e) {
                    if (e === "true"){
                        notyf.success("Child Administered Successfully");
                    } else {
                        notyf.error(e)
                    }
                }
            })

        });
    });
</script>