
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Search | VaxKid</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/icon/favicon.ico" />
    <link rel="shortcut icon" href="assets/img/icon/favicon.ico" type="image/x-icon">
    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="css/loader.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="assets/multi-select/css/bootstrap-multiselect.min.css">

    <style>
        .jumbotron {
            background-image: url("assets/img/y-so-serious-white.png");
        }

        .title {
            font-family: "Century Gothic";
            font-weight: bolder;
            color: black;
            text-shadow: 2px 2px cadetblue;
        }

        .sub-title {
            font-family: "Century Gothic";
            font-weight: bolder;
            color: black;

        }
    </style>

</head>
<body>

<nav class="navbar bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand link-light" href="/">
            <i class="fa fa-home" aria-hidden="true"></i> VaxKid
        </a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link link-light" aria-current="page" href="about.php">About</a>
            </li>
        </ul>
    </div>

</nav>

<div class=" p-5  text-dark jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img src="assets/img/logo/VaxKid-logos_transparent.png" width="100" alt="a">
            </div>
            <div class="col-md-8">
                <h1 class="title">VAXKID: PATIENT’S VACCINATION RECORD FOR RHU TAGUDIN</h1>
                <p class="sub-title">Tagudin, Ilocos Sur</p>
            </div>
        </div>
    </div>
</div>


<section>
    <div class="container">

        <div class="mt-4 mb-2">

           <div class="w-50">
               <label for="search">Search Child</label>
               <input id="search" type="search" class="form-control" placeholder="Search ...">
               <div id="child-list"></div>
           </div>
        </div>

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
                                    <label class="label" for="view-child-name">Birth Date</label>
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
                                        <label class="label" for="view-child-name">Weight</label>
                                        <input type="text" class="form-control form-control-sm" name="view-child-name" id="view-child-weight" readonly>
                                    </div>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 mb-3">
                                    <div class="form-group">
                                        <label class="label" for="view-child-name">Length</label>
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
                                <h5 class="mb-2 text-danger">Doctor's Notes</h5>
                                <div class="container-fluid">
                                    <div class="table-responsive">
                                        <table id="doctorNoteTable" class="table table-striped table-sm nowrap">
                                            <thead>
                                            <tr>
                                                <th>Doctor Name</th>
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

<hr>

<div class="container">
    <footer class="footer">
        <p>&copy; VaxKid - RHU Tagudin <?= date("Y") ?></p>
    </footer>
</div>

<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/datatables.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="assets/multi-select/js/bootstrap-multiselect.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

<script>
    $(document).ready(function(){
        $('#search').keyup(function(){
            var query = $(this).val();
            if(query !== '')
            {
                $.ajax({
                    url:"config/Ajax.php",
                    method: "POST",
                    data:{
                        action: 'search',
                        query: query
                    },
                    success:function(data)
                    {
                        $('#child-list').fadeIn();
                        $('#child-list').html(data);
                    }
                });
            }
        });


        $(document).on('click', 'li.view-child', function (){
            $('#search').val($(this).text());
            $('#child-list').fadeOut();
            let child_id = $(this).data('id');

            $.ajax({
                type: 'post',
                url: 'config/Ajax.php',
                data: {
                    action: 'fetchChild',
                    id: child_id
                },
                dataType: 'json',
                success: function (res) {
                    $("#view-child-name").val(res.child_firstname + ' ' + res.child_lastname);
                    $("#view-child-gender").val(res.gender);
                    $("#view-child-birthdate").val(res.birth_date);
                    $("#view-child-birthtime").val(res.birth_time);
                    $("#view-child-birthplace").val(res.birth_place);
                    $("#view-child-hospital").val(res.hospital);
                    $("#view-child-obstetrician").val(res.obstetrician);
                    $("#view-child-pediatrician").val(res.pediatrician);
                    $("#view-child-tod").val(res.typeofdelivery);
                    $("#view-child-weight").val(res.weight);
                    $("#view-child-length").val(res.length);
                    $("#view-child-hc").val(res.head_circumference);
                    $("#view-child-cc").val(res.chest_circumference);
                    $("#view-child-bt").val(res.blood_type);
                    $("#view-child-ec").val(res.eye_color);
                    $("#view-child-haircolor").val(res.hair_color);
                    $("#view-child-dm").val(res.distinguishing_marks);
                    $("#view-child-nbsd").val(res.newborn_screening_date);

                    $('#doctorNoteTable').DataTable({
                        'responsive':true,
                        'processing': false,
                        'serverSide': true,
                        'serverMethod': 'post',
                        'searching':false,
                        "bDestroy": true,
                        'ajax': {
                            'url':'config/Ajax.php',
                            "data": {
                                "child_id": res.child_id,
                                "action": 'dtChildNotes'
                            }

                        },

                        'columns': [
                            { data: 'doctor_name' },
                            { data: 'consultation_date' },
                            { data: 'age' },
                            { data: 'height' },
                            { data: 'weight' },
                            { data: 'head_circumference' },
                            { data: 'chest_circumference' },
                            { data: 'vaccine_name' },
                            { data: 'notes' },
                            { data: 'next_visit' },
                        ],


                        "columnDefs": [ {

                            "targets": 'no-sort',

                            "orderable": false,

                        } ]

                    });

                }
            });



        });

    });

</script>
</body>
</html>
