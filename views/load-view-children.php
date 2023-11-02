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
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="childDatatable" class="table table-striped table-sm nowrap dt-responsive">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Birth Date</th>
                            <th>Mother's Name</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th  class="no-sort">Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


<div class="modal fade" id="viewChildModal" tabindex="-1" role="dialog" aria-labelledby="viewChildModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Child's Profile</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section>
                    <div class="container">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                                <div class="card h-100 p-2 border">
                                    <div class="card-body">
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <h5 class="mb-2 text-danger">Child Information</h5>
                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Child's Name</label>
                                                    <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-name" readonly>
                                                </div>
                                            </div>

                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Gender</label>
                                                    <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-gender" readonly>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Birth Date (YYYY-MM-DD)</label>
                                                    <input type="text" class="form-control form-control-sm" name="view-child-birthdate" id="view-child-birthdate" readonly>
                                                </div>
                                            </div>


                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Birth Time</label>
                                                    <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-birthtime" readonly>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Birth Place</label>
                                                    <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-birthplace" readonly>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Hospital</label>
                                                    <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-hospital" readonly>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Obstetrician</label>
                                                    <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-obstetrician" readonly>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Pediatrician</label>
                                                    <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-pediatrician" readonly>
                                                </div>
                                            </div>


                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                                                <h5 class="mb-2 text-danger">Child Birth Information</h5>
                                            </div>

                                            <div class="row">

                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Type of Delivery</label>
                                                        <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-tod" readonly>
                                                    </div>
                                                </div>


                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Weight (kilos)</label>
                                                        <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-weight" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Length (cm)</label>
                                                        <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-length" readonly>
                                                    </div>
                                                </div>


                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Head Circumference</label>
                                                        <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-hc" readonly>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Chest Circumference</label>
                                                        <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-cc" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Blood Type</label>
                                                        <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-bt" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Eye Color</label>
                                                        <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-ec" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Hair Color</label>
                                                        <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-haircolor" readonly>
                                                    </div>
                                                </div>


                                            </div>


                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Distinguishing Marks</label>
                                                    <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-dm" readonly>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">New Born Screening Date</label>
                                                    <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-nbsd" readonly>
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-12 mt-3">
                                                <h5 class="mb-2 text-danger">Vaccinator's Notes</h5>
                                                <div class="container-fluid">
                                                    <div class="table-responsive">
                                                        <table id="doctorNoteTable" class="table table-striped table-sm nowrap">
                                                            <thead>
                                                            <tr>
                                                                <th>Vaccinator's Name</th>
                                                                <th>Consultation Date</th>
                                                                <th>Age</th>
                                                                <th>Height</th>
                                                                <th>Weight</th>
                                                                <th>Head Circumference</th>
                                                                <th>Chest Circumference</th>
                                                                <th class="no-sort">Vaccine Administered</th>
                                                                <th>Notes</th>
                                                                <th>Next Visit</th>
                                                            </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>
<script src="js/view-children.php.js"></script>
