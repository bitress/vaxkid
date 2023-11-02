<?php

    include '../config/init.php';

?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            Midwife List
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">

                        <button class="btn btn-light btn-sm text-primary" type="button" data-bs-toggle="modal" data-bs-target="#add_midwife"><i class="fa fa-user-plus"></i>
                            Add Midwife</button>
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

                <table id="dtMidwives" class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Personnel Name</th>
                        <th>Position</th>
                        <th>Address</th>
                        <th>Assigned Barangay</th>
                        <th>Contact Number</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Personnel Name</th>
                        <th>Position</th>
                        <th>Address</th>
                        <th>Assigned Barangay</th>
                        <th>Contact Number</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    $mw = new Midwife();
                    $midwife = $mw->fetchMidwives(true);
                    foreach ($midwife as $m):
                    ?>
                    <tr id="tr_<?= $m['user_d'] ?>">
                        <td><?= $m['user_d'] ?></td>
                        <td><?= $m['firstname'] . ' ' . $m['middlename'] . ' ' . $m['lastname'] ?></td>
                        <td><?= $m['position'] ?></td>
                        <td><?= $m['address'] ?></td>
                        <td><?= $m['assigned_barangay'] ?></td>
                        <td><?= $m['contact_number'] ?></td>
                        <td>

                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary edit-midwife" data-id="<?= htmlentities($m['user_d'], ENT_QUOTES | ENT_HTML5) ?>"><i class="fa fa-pencil"></i></button>
                               <!-- <button type="button" class="btn btn-primary delete-midwife" data-id="<?= htmlentities($m['user_d'], ENT_QUOTES | ENT_HTML5) ?>" data-name="<?= htmlentities($m['firstname']); ?>"><i class="fa fa-trash"></i></button>--> 
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

<div class="modal fade" id="add_midwife" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Midwife</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="container-xl px mt-4">
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Account details card-->
                                    <form id="addMidwifeForm">
                                        <!-- Form Group (username)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="username">Username<span class="required">*</span> (Will be used as a login)</label>
                                            <input class="form-control" id="username" name="username" type="text" placeholder="Enter username"/>
                                        </div>

                                        <div class="row gx-3 mb-3">

                                            <div class="col-md-4">
                                                <label class="small mb-1" for="firstname">First Name<span class="required">*</span></label>
                                                <input class="form-control" id="firstname" name="firstname" type="text" placeholder="Enter personnel name" oninput="this.value = this.value.toUpperCase()" />
                                            </div>

                                            <div class="col-md-4">
                                                <label class="small mb-1" for="middlename">Middle Name<span class="required">*</span></label>
                                                <input class="form-control" id="middlename" name="middlename" type="text" placeholder="Enter personnel name" oninput="this.value = this.value.toUpperCase()" />
                                            </div>

                                            <div class="col-md-4">
                                                <label class="small mb-1" for="lastname">Last Name<span class="required">*</span></label>
                                                <input class="form-control" id="lastname" name="lastname" type="text" placeholder="Enter personnel name" oninput="this.value = this.value.toUpperCase()" />
                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <label class="small mb-1" for="position">Position<span class="required">*</span></label>
                                            <input class="form-control" id="position" name="position" type="text" placeholder="Enter position" oninput="this.value = this.value.toUpperCase()"/>
                                        </div>


                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                            <label class="small mb-1" for="contact_number">Contact Number<span class="required">*</span></label>
                                            <input class="form-control" id="contact_number" name="contact_number" type="tel" placeholder="Enter phone number" value="" />
                                        </div>
                                            <div class="col-md-6">
                                            <label class="small mb-1" for="email">Email<span class="required">*</span></label>
                                            <input class="form-control" id="email" name="email" type="email" placeholder="Enter email" value="" />
                                        </div>
                                        </div>


                                        <!-- Form Row        -->
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (organization name)-->
                                            <div class="col-md-3">
                                                <label class="small mb-1" for="assigned_barangay">Assigned Barangay</label>
                                                <select id="assigned_barangay" class="form-control form-control-sm barangay_choose" multiple data-placeholder="Choose a barangay">
                                                    <?= Misc::generateBarangay() ?>
                                                </select>
<!--                                                <input class="form-control" id="assigned_barangay" name="assigned_barangay" type="text" placeholder="Enter assigned barangay"/>-->
                                            </div>
                                            <!-- Form Group (location)-->
                                            <div class="col-md-9">
                                                <label class="small mb-1" for="address">Address<span class="required">*</span></label>
                                                <input class="form-control" id="address" name="address" type="text" placeholder="Enter address" oninput="this.value = this.value.toUpperCase()"/>
                                            </div>
                                        </div>


                                        <!-- Form Row-->
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (first name)-->
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="newpass">Create New Password<span class="required">*</span></label>
                                                <input class="form-control" id="newpass" name="newpass" type="password" placeholder="Enter your first name" />
                                            </div>
                                            <!-- Form Group (last name)-->
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="confirmpass">Confirm New Password<span class="required">*</span></label>
                                                <input class="form-control" id="confirmpass" name="confirmpass" type="password" placeholder="Enter your last name"/>
                                            </div>
                                        </div>

                                        <!-- Save changes button-->
                                        <button class="btn btn-primary" id="saveNewMidwife" type="button">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="edit_midwife" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Midwife</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="editMidwifeForm">

                        <div class="row gx-3 mb-3">

                            <input type="hidden" id="edit_midwife_id" name="id" value="">

                            <div class="col-md-4">
                                <label class="small mb-1" for="firstname">First Name</label>
                                <input class="form-control" id="edit_firstname" name="firstname" type="text" placeholder="Enter personnel name" oninput="this.value = this.value.toUpperCase()" />
                            </div>

                            <div class="col-md-4">
                                <label class="small mb-1" for="middlename">Middle Name</label>
                                <input class="form-control" id="edit_middlename" name="middlename" type="text" placeholder="Enter personnel name" oninput="this.value = this.value.toUpperCase()" />
                            </div>

                            <div class="col-md-4">
                                <label class="small mb-1" for="lastname">Last Name</label>
                                <input class="form-control" id="edit_lastname" name="lastname" type="text" placeholder="Enter personnel name" oninput="this.value = this.value.toUpperCase()"/>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="contact_number">Contact Number</label>
                                <input class="form-control" id="edit_contact_number" name="contact_number" type="tel" placeholder="Enter phone number" value="" />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="position">Position</label>
                                <input class="form-control" id="edit_position" name="position" type="text" placeholder="Enter position" oninput="this.value = this.value.toUpperCase()"/>
                            </div>
                        </div>


                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="assigned_barangay">Assigned Barangay</label>
                                <select id="edit_assigned_barangay" class="form-control form-control-sm assigned_barangay" data-placeholder="Choose a barangay..."  multiple>
                                    <?= Misc::generateBarangay() ?>
                                </select>
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="address">Address</label>
                                <input class="form-control" id="edit_address" name="address" type="text" placeholder="Enter address" oninput="this.value = this.value.toUpperCase()"/>
                            </div>
                        </div>

                        <!-- Save changes button-->
                        <button class="btn btn-primary" id="editMidwifeButton" type="button">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

<script>

    $(document).ready(function() {
                $('#dtMidwives').DataTable();
        $('.barangay_choose').chosen({width: "95%"});

    });

    // var dtMidwives = document.getElementById('dtMidwives');
    // if (dtMidwives) {
    //     new simpleDatatables.DataTable(dtMidwives);
    // }

    var notyf = new Notyf({
        duration: 1000,
        position: {
            x: 'right',
            y: 'top',
        }});

    $(document).ready(function(){

        $("#saveNewMidwife").on("click", function(){

            var data = new FormData($("#addMidwifeForm")[0]);
            data.append("action", "addMidwife");
            data.append("assigned_barangay", $("#assigned_barangay").val())

            $.ajax({
                type: 'POST',
                url: 'config/Ajax.php',
                data: data,
                contentType: false,
                processData: false,
                success: function (res) {

                    if (res === "true"){
                        notyf.success("New midwife added successfully");
                        setTimeout(function() {
                            loadViewMidwife()
                        }, 3000);
                    }

                }
            })

        });

        $('#edit_midwife').on('hide.bs.modal', function (e) {
            loadViewMidwife()
        });




        $("#editMidwifeButton").on("click", function (e){


            var midwife_data = new FormData($("#editMidwifeForm")[0]);
            midwife_data.append("action", "editMidwife");
            midwife_data.append("assigned_barangay", $("#edit_assigned_barangay").val())

            $.ajax({
                type: 'post',
                url: 'config/Ajax.php',
                data: midwife_data,
                contentType: false,
                processData: false,
                success: function (res){
                    notyf.success("Edit success");
                    setTimeout(function() {
                        loadViewMidwife()
                    }, 3000);
                }
            })


        });

    });

    $(document).on('click', '.delete-midwife', function (){

        var midwife_id = $(this).data('id');
        var name = $(this).data("name");

        swal({
            title: "Are you sure you want to delete " + "'" + name + "'" + " as a midwife? ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            . then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: 'config/Ajax.php',
                        data: {
                            action: 'deleteMidwife',
                            id: midwife_id
                        }, success: function (res){
                            if (res === "true"){
                                swal("Poof! Midwife has been deleted! ", {
                                    icon: "success",
                                });
                            }
                        }
                    });

                } else {
                    swal("Nothing was deleted!");
                }
            });
    });

    $(document).on('click', '.edit-midwife', function (){
        


        var midwife_id = $(this).data('id');
        var viewMidwifeModal = new bootstrap.Modal(document.getElementById('edit_midwife'));

        $.ajax({
            type: 'post',
            url: 'config/Ajax.php',
            data: {
                action: 'fetchMidwife',
                id: midwife_id
            }, success: function (data){
                let mw = JSON.parse(data);

                // console.log("midwife", mw.assigned_barangay)

                $("#edit_midwife_id").val(mw.user_d);
                $("#edit_firstname").val(mw.firstname);
                $("#edit_middlename").val(mw.middlename);
                $("#edit_lastname").val(mw.lastname);
                // $("#edit_assigned_barangay").val(mw.assigned_barangay);

                var values= mw.assigned_barangay;
                $.each(values.split(","), function(i,e){
                    $(".assigned_barangay option[value='" + e + "']").attr('selected', 'selected');
                });
            $('.assigned_barangay').chosen({width: "95%"});

                $("#edit_position").val(mw.position);
                $("#edit_contact_number").val(mw.contact_number);
                $("#edit_address").val(mw.address);
                viewMidwifeModal.show();
                
                        $(".assigned_barangay").removeAttr('selected');

            }
        })

    })


</script>