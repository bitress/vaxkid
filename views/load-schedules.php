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
                            Schedule Lists
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">

                        <button class="btn btn-light btn-sm text-primary" type="button" data-bs-toggle="modal" data-bs-target="#create_schedule"><i class="me-1" data-feather="calendar"></i>
                            Create New Schedule</button>

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

                <table id="datatablesSchedule" class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Message</th>
                        <th>Barangay</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Message</th>
                        <th>Barangay</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    $sched = new Schedule();
                    $vac = $sched->fetch();
                    foreach ($vac as $vaccine):
                        ?>
                        <tr id="tr_<?= $vaccine['schedule_id'] ?>">
                            <td><?= $vaccine['schedule_id'] ?></td>
                            <td><?= $vaccine['message'] ?></td>
                            <td><?= $vaccine['barangay'] ?></td>
                            <td><?= date("F j, Y g:i a",strtotime($vaccine['start_date']));  ?></td>
                            <td><?= ($vaccine['status']) == 'not_sent' ? 'SMS Notice not yet sent' : 'SMS Notice has been sent'  ?></td>
                            <td>
                                <?php if ($vaccine['status'] === 'not_sent'): ?>
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark edit-schedule" data-id="<?= $vaccine['schedule_id'] ?>" href="#"><i class="fa fa-pencil"></i></button>
                                <?php endif; ?>
                                <button class="btn btn-datatable btn-icon btn-transparent-dark delete-schedule" data-id="<?= $vaccine['schedule_id'] ?>" data-name="<?= $vaccine['barangay'] ?>"><i class="fa fa-trash"></i></button>
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

<div class="modal fade" id="create_schedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="barangay">Select Barangay<span class="required">*</span></label>
                        <select id="barangay" class="form-control form-control-sm" name="barangay">
                            <?= Misc::generateBarangay(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message">Enter Schedule Message<span class="required">*</span></label>
                        <textarea id="message" name="message" rows="5" class="form-control" placeholder="Enter a message ..."></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="start-date">Enter the Start of Schedule<span class="required">*</span></label>
                                <input type="text" id="start_date" name="start_date" class="form-control form-control-sm dtp">
                            </div>
                            <div class="col-md-6">
                                <label for="end-date">Enter the End of Schedule<span class="required">*</span></label>
                                <input type="text" id="end_date" name="end_date" class="form-control form-control-sm dtp">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="setSchedule" class="btn btn-primary">Save Schedule</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_schedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Schedule<span class="required">*</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editScheduleForm">
                    <input type="hidden" id="edit_sched_id" name="schedule_id">
                    <div class="mb-3">
                        <label for="barangay">Select Barangay<span class="required">*</span></label>
                        <select id="edit_barangay" class="form-control form-control-sm" name="barangay">
                            <?= Misc::generateBarangay(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message">Enter Schedule Message<span class="required">*</span></label>
                        <textarea id="edit_message" name="message" rows="5" class="form-control" placeholder="Enter a message ..."></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="start-date">Enter the Start of Schedule<span class="required">*</span></label>
                                <input type="text" id="edit_start_date" name="start_date" class="form-control form-control-sm dtp">
                            </div>
                            <div class="col-md-6">
                                <label for="end-date">Enter the End of Schedule<span class="required">*</span></label>
                                <input type="text" id="edit_end_date" name="end_date" class="form-control form-control-sm dtp">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="editSchedule" class="btn btn-primary">Save Schedule</button>
            </div>
        </div>
    </div>
</div>

<script>

    // var dtSchedules = document.getElementById('datatablesSchedule');
    // if (dtSchedules) {
    //     new simpleDatatables.DataTable(dtSchedules);
    // }
    
        $('#datatablesSchedule').DataTable();



    $(document).on('click', '.edit-schedule', function (){
        let schedule_id = $(this).data('id');
        var view_modal = new bootstrap.Modal(document.getElementById('edit_schedule'));
        view_modal.show();
        $.ajax({
            type: 'post',
            url: 'config/Ajax.php',
            data: {
                action: 'fetchSchedule',
                schedule_id: schedule_id
            }, success: function (data){
                let sched = JSON.parse(data);
                $("#edit_sched_id").val(sched.schedule_id);
                $("#edit_barangay").val(sched.barangay);
                $("#edit_message").val(sched.message);
                $("#edit_start_date").val(sched.start_date);
                $("#edit_end_date").val(sched.end_date);
            }
        })
    });


    $("#editSchedule").on('click', function (e){

        var data = new FormData($("#editScheduleForm")[0]);
        data.append("action", "editSchedule");
        // let res = JSON.stringify(Object.fromEntries(data));
        // console.log(res);

        $.ajax({
            type: 'post',
            url: 'config/Ajax.php',
            data: data,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res === "true"){
                    notyf.success("Schedule edit is success");
                    setTimeout(function() {
                        loadViewSchedules()
                    }, 3000);

                }
            }
        });


    });

    $(document).on('click', '.delete-schedule', function (){

        let id = $(this).data('id');
        let name = $(this).data('name');

        swal({
            title: "Are you sure you want to delete "+ "'" + name + "'" + " schedule on your record.",
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
                            action: 'deleteSchedule',
                            id: id
                        },
                        success: function (res) {
                            if (res === "true"){
                                swal("Poof! The schedule has been deleted! ", {
                                    icon: "success",
                                });
                                $("#tr_"+ id).remove()
                            }
                        }
                    })


                } else {
                    swal("Nothing was deleted! ");
                }
            });

    });

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

        $("#setSchedule").on("click", function(e){

            let barangay = $("#barangay").val();
            let message = $("#message").val();
            let start_date = $("#start_date").val();
            let end_date = $("#end_date").val();

            $.ajax({
                type: 'post',
                url: 'config/Ajax.php',
                data: {
                    action: 'setSchedule',
                    message: message,
                    barangay: barangay,
                    start_date: start_date,
                    end_date: end_date
                }, success: function(res) {
                    if (res === "true"){
                        notyf.success("New Schedule is added to the record.");
                        loadViewSchedules()
                    } else {
                        notyf.error(res);
                    }
                }
            });
        });

    } );

</script>