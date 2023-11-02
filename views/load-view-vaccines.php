<?php


include_once '../config/init.php';

?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Vaccine List
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">

                        <button class="btn btn-light btn-sm text-primary" type="button" data-bs-toggle="modal" data-bs-target="#add_vaccine"><i class="me-1" data-feather="user-plus"></i>
                            Add Vaccine</button>

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
                <table id="vaccines_datatable" class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vaccine Name</th>
                        <th>Quantity</th>
                        <th>Origin</th>
                        <th>Manufacture Date</th>
                        <th>Expiration Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Vaccine Name</th>
                        <th>Quantity</th>
                        <th>Origin</th>
                        <th>Manufacture Date</th>
                        <th>Expiration Date</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    <?php

                    $vaccine = new Vaccine();
                    $vac = $vaccine->getAllVaccines();

                    foreach ($vac as $vaccine):

                        ?>

                        <tr id="tr_<?= $vaccine['id'] ?>">
                            <td><?= $vaccine['id'] ?></td>
                            <td><?= $vaccine['name'] ?></td>
                            <td><?= $vaccine['quantity'] ?></td>
                            <td><?= $vaccine['origin'] ?></td>
                            <td><?= $vaccine['manufacture_date'] ?></td>
                            <td><?= $vaccine['expiration_date'] ?></td>
                            <td>
                                <button class="btn btn-datatable btn-icon btn-transparent-dark edit-vaccine" data-id="<?= $vaccine['id'] ?>"><i class="fa fa-pencil"></i></button>
                           <!--     <button class="btn btn-datatable btn-icon btn-transparent-dark delete-vaccine" data-id="<?= $vaccine['id'] ?>" data-name="<?= $vaccine['name'] ?>"><i class="fa fa-trash"></i></button> -->
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


<div class="modal fade" id="add_vaccine" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Vaccine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addVaccineForm">

                    <div class="mb-3">
                        <label for="vaccine_name">Enter Vaccine Name<span class="required">*</span></label>
                        <select class="form-control form-control-sm" name="vaccine_name">
                            <option selected disabled>-- Select Vaccine --</option>
                            <?php
                                $vaccines = array("BCG", "Hep B", "OPV 1", "OPV 2", "OPV 3", "IPV 1", "IPV 2", "MCV 1", "MCV 2", "PENTA 1", "PENTA 2", "PENTA 3", "PCV 1", "PCV 2", "PCV 3");
                                foreach ($vaccines as $v):
                            ?>
                            <option value="<?= $v; ?>"><?= $v ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="vaccine_quantity">Enter Vaccine Quantity<span class="required">*</span></label>
                        <input type="number" name="vaccine_quantity" id="vaccine_quantity" class="form-control form-control-sm" placeholder="Enter Vaccine Quantity">
                    </div>
                    <div class="mb-3">
                        <label for="vaccine_quantity">Enter Vaccine Dosage</label>
                        <input type="text" name="vaccine_dosage" id="vaccine_dosage" class="form-control form-control-sm" placeholder="Enter Vaccine Dosage">
                    </div>
                    <div class="mb-3">
                        <label for="vaccine_quantity">Enter Vaccine Origin</label>
                        <input type="text" name="vaccine_origin" id="vaccine_origin" class="form-control form-control-sm" placeholder="Enter Vaccine Origin" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="mb-3">
                        <label for="vaccine_manufacture">Enter Vaccine Manufacture Date<span class="required">*</span></label>
                        <input type="text" name="vaccine_manufacture" id="vaccine_manufacture" class="form-control form-control-sm dtp" placeholder="Enter Vaccine Manufacture Date">
                    </div>
                    <div class="mb-3">
                        <label for="vaccine_expiration">Enter Vaccine Expiration Date<span class="required">*</span></label>
                        <input type="text" name="vaccine_expiration" id="vaccine_expiration" class="form-control form-control-sm dtp" placeholder="Enter Vaccine Expiration Date">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="addVaccineButton" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_vaccine" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Vaccine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editVaccineForm">

                    <input type="hidden" id="edit_vaccine_id" name="vaccine__id">

                    <div class="mb-3">
                        <label for="vaccine_name">Vaccine Name</label>
                        <input type="text" name="vaccine_name" id="edit_vaccine_name" class="form-control form-control-sm" placeholder="Enter Vaccine Name" oninput="this.value = this.value.toUpperCase()" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="vaccine_quantity">Enter Vaccine Quantity</label>
                        <input type="number" name="vaccine_quantity" id="edit_vaccine_quantity" class="form-control form-control-sm" placeholder="Enter Vaccine Quantity">
                    </div>
                    <div class="mb-3">
                        <label for="vaccine_quantity">Enter Vaccine Dosage</label>
                        <input type="text" name="vaccine_dosage" id="edit_vaccine_dosage" class="form-control form-control-sm" placeholder="Enter Vaccine Dosage">
                    </div>
                    <div class="mb-3">
                        <label for="vaccine_quantity">Enter Vaccine Origin</label>
                        <input type="text" name="vaccine_origin" id="edit_vaccine_origin" class="form-control form-control-sm" placeholder="Enter Vaccine Origin" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="mb-3">
                        <label for="vaccine_manufacture">Enter Vaccine Manufacture Date</label>
                        <input type="text" name="vaccine_manufacture" id="edit_vaccine_manufacture" class="form-control form-control-sm dtp" placeholder="Enter Vaccine Manufacture Date">
                    </div>
                    <div class="mb-3">
                        <label for="vaccine_expiration">Enter Vaccine Expiration Date</label>
                        <input type="text" name="vaccine_expiration" id="edit_vaccine_expiration" class="form-control form-control-sm dtp" placeholder="Enter Vaccine Expiration Date">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="editVaccineButton" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>


<script>

    // var vaccinesDTB = document.getElementById('vaccines_datatable');
    // if (vaccinesDTB) {
    //     new simpleDatatables.DataTable(vaccinesDTB);
    // }


    var notyf = new Notyf({
        duration: 1000,
        position: {
            x: 'right',
            y: 'top',
        }});

    $( function() {
        
            $('#vaccines_datatable').DataTable();

        $( ".dtp" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });

        $("#addVaccineButton").on("click", function (e){


            var vaccine_data = new FormData($("#addVaccineForm")[0]);
            vaccine_data.append("action", "addVaccine");

            $.ajax({
                type: 'post',
                url: 'config/Ajax.php',
                data: vaccine_data,
                contentType: false,
                processData: false,
                success: function (res){
                    notyf.success("New Vaccine is successfully added to the record.");
                    setTimeout(function() {
                        loadViewVaccines();
                    }, 3000);
                }
            })


        });

        $(document).on('click', '.delete-vaccine', function (){

            let vaccine_id = $(this).data('id');
            let vaccine_name = $(this).data('name');

            swal({
                title: "Are you sure you want to delete " + "'" + vaccine_name + "'" + " in the vaccine list?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                . then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: 'config/Ajax.php',
                            type: 'post',
                            data: {
                                action: 'deleteVaccine',
                                vaccine_id: vaccine_id
                            },
                            success: function (res) {
                                if (res === "true"){
                                    notyf.success("Vaccine deleted successfully");
                                    $("#tr_"+ vaccine_id).remove()
                                }
                            }
                        })

                    } else {
                        swal("Nothing was deleted!");
                    }
                });



        });


        $("#editVaccineButton").on("click", function (e){

            var view_modal = new bootstrap.Modal(document.getElementById('edit_vaccine'));

            var vaccine_data = new FormData($("#editVaccineForm")[0]);
            vaccine_data.append("action", "editVaccine");
            vaccine_data.append("vaccine_id", $("#edit_vaccine_id").val())

            $.ajax({
                type: 'post',
                url: 'config/Ajax.php',
                data: vaccine_data,
                contentType: false,
                processData: false,
                success: function (res){
                    notyf.success("Edit success");
                    setTimeout(function() {
                        loadViewVaccines();
                    }, 3000);
                    view_modal.hide();

                }
            })


        });

        /**
         * Show Vaccine data to form
         */
        $(document).on('click', '.edit-vaccine', function (){
            let vaccine_id = $(this).data('id');
            var view_modal = new bootstrap.Modal(document.getElementById('edit_vaccine'));

            $.ajax({
                type: 'post',
                url: 'config/Ajax.php',
                data: {
                    action: 'fetchVaccine',
                    id: vaccine_id
                }, success: function (data){
                    let vac = JSON.parse(data);
                    $("#edit_vaccine_id").val(vac.id);
                    $("#edit_vaccine_name").val(vac.name);
                    $("#edit_vaccine_expiration").val(vac.expiration_date);
                    $("#edit_vaccine_manufacture").val(vac.manufacture_date);
                    $("#edit_vaccine_quantity").val(vac.quantity);
                    $("#edit_vaccine_dosage").val(vac.dosage);
                    $("#edit_vaccine_origin").val(vac.origin);

                    view_modal.show();
                }
            })

        })
    })

</script>
