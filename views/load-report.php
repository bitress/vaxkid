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
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Reports
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">

<!--                        <button class="btn btn-light btn-sm text-primary" type="button" data-bs-toggle="modal" data-bs-target="#printReportModal"><i class="me-1" data-feather="user-plus"></i>-->
<!--                            Generate Reports</button>-->

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">


                <form action="functions/print_schedule.php" method="post">
                    <div class="mb-3">
                        <label for="barangay">Select Barangay</label>
                        <select name="barangay" id="barangay" class="form-control">
                            <option selected value="All">All</option>
                            <?= Misc::generateBarangay(); ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status">Select what to display</label>
                        <select name="display" id="whatToDisplay" class="form-control" onchange="checkOption()">
                            <option selected disabled>--- Select ---</option>
                            <optgroup label="What to display?">
                                <option value="Vaccination">Vaccination</option>
                                <option value="Schedule">Schedule</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="mb-3" id="vaccinationStatus">
                        <label for="status">Select Vaccination Status</label>
                        <select name="type" id="status" class="form-control">
                            <option selected disabled>--- Select ---</option>
                            <optgroup label="Vaccination Status">
                                <option value="All">All</option>
                                <option value="vaccinated">Vaccinated</option>
                                <option value="not_vaccinated">Not Vaccinated</option>
                            </optgroup>
                        </select>
                    </div>

                        <div class="mb-3" id="scheduleStatus">
                            <label for="schedule">Select Schedule</label>
                            <select id="time" name="type" class="form-control">
                            <optgroup label="Vaccination Schedule">
                                <option value="Today">Schedule Today</option>
                                <option value="Upcoming">Upcoming Schedule</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-sm">Print to PDF</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</main>


<script>

        var reportDT = document.getElementById('datatablesSimple');
        if (reportDT) {
            new simpleDatatables.DataTable(reportDT);
        }


        $(document).ready(function (){
            $("#vaccinationStatus").hide();
            $("#scheduleStatus").hide();
        })


            function checkOption(){


                var conceptName = $('#whatToDisplay').find(":selected").val();
                if (conceptName == "Vaccination"){
                    $("#vaccinationStatus").show();
                    $("#scheduleStatus").hide();
                    $("#time").val([]);
                } else if (conceptName == "Schedule"){
                    $("#scheduleStatus").show();
                    $("#vaccinationStatus").hide();
                    $("#status").val([]);

                }
            }


</script>