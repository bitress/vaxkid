<?php

include_once '../config/init.php';

$id = Session::get('uid');

$user = new User();
$row = $user->getUserData($id);
?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Account Settings - Profile
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">


        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form id="saveSettingsForm">
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="username">Username<span class="required">*</span> (how your name will appear to other users on the site)</label>
                                <input class="form-control" id="username" name="username" type="text" placeholder="Enter your username" value="<?= $row['username'] ?>" />
                            </div>
                            <!-- Form Row-->
                            <div class="row mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-3">
                                    <label class="small mb-1" for="firstname">First name<span class="required">*</span></label>
                                    <input class="form-control" id="firstname" name="firstname" type="text" placeholder="Enter your first name" value="<?= $row['firstname'] ?>"oninput="this.value = this.value.toUpperCase()"/>
                                </div>             .
                                <!-- Form Group (first name)-->
                                <div class="col-md-4">
                                    <label class="small mb-1" for="middlename">Middle name<span class="required">*</span></label>
                                    <input class="form-control" id="middlename" name="middlename" type="text" placeholder="Enter your middle name" value="<?= $row['middlename'] ?>"oninput="this.value = this.value.toUpperCase()" />
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-4">
                                    <label class="small mb-1" for="lastname">Last name<span class="required">*</span></label>
                                    <input class="form-control" id="lastname" name="lastname" type="text" placeholder="Enter your last name" value="<?= $row['lastname'] ?>" oninput="this.value = this.value.toUpperCase()"/>
                                </div>
                            </div>
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="address">Address<span class="required">*</span></label>
                                    <input class="form-control" id="address" name="address" type="text" placeholder="Enter your organization name" value="<?= $row['address'] ?>"oninput="this.value = this.value.toUpperCase()" />
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="assigned">Assigned Barangay<span class="required">*</span></label>
                                    <select name="assigned" class="form-control-sm form-control assigned_barangay" id="assigned" multiple>
                                        <?php
                                        $barangay = [ "Ag-aguman", "Ambalayat", "Baracbac", "Bario-an", "Baritao", "Becques", "Bimmanga", "Bio", "Bitalag", "Borono", "Bucao East", "Bucao West", "Cabaroan", "Cabugbugan", "Cabulanglangan", "Dacutan", "Dardarat", "Del Pilar", "Farola", "Gabur", "Garitan", "Jardin", "Lacong", "Lantag", "Las-ud", "Libtong", "Lubnac", "Magsaysay", "Malacañang", "Pacac", "Pallogan", "Pula", "Pudoc East", "Pudoc West", "Quirino", "Ranget", "Rizal", "Salvacion", "San Miguel", "Sawat", "Tallaoen", "Tampugo" ];
                                        $selected = explode(",", $row['assigned_barangay']);
                                        $select = "";

                                        foreach ($barangay as $bar) {
                                            $selectedAttribute = in_array($bar, $selected) ? ' selected' : '';
                                            $select .= '<option value="'. $bar .'"'. $selectedAttribute .'>'. $bar .'</option>';
                                        }
                                        echo $select;
                                        ?>
                                    </select>

                                    <!--                                    <input class="form-control assigned_barangay" id="assigned" name="assigned" type="text" placeholder="Enter your location" value="--><?//= $row['assigned_barangay'] ?><!--" />-->
                                </div>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email address<span class="required">*</span></label>
                                <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email address" value="<?= $row['email'] ?>" />
                            </div>
                            <!-- Form Row-->

                                <div class="mb-3">
                                    <label class="small mb-1" for="contact_number">Phone number<span class="required">*</span></label>
                                    <input class="form-control" id="contact_number" name="contact_number" type="tel" placeholder="Enter your phone number" value="<?= $row['contact_number'] ?>" />
                                </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="oldpassword">Old Password</label>
                                    <input type="password" name="oldpassword" id="oldpassword" class="form-control">
                                    <div id="oldpassword" class="form-text">
                                        Leave it blank, if you don't want to change your password
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="newpassword">New Password</label>
                                    <input type="password" name="newpassword" id="newpassword" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="confirmpassword">Repeat New Password</label>
                                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
                                </div>
                            </div>

                            <!-- Save changes button-->
                            <button class="btn btn-primary" id="saveSettingsBTN" type="button">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>

    $(document).ready(function() {
        $('.assigned_barangay').chosen({width: "95%"});
    });

    var notyf = new Notyf({
        duration: 1000,
        position: {
            x: 'right',
            y: 'top',
        }});

    $("#saveSettingsBTN").on('click', function (){

        var data = new FormData($("#saveSettingsForm")[0]);
        data.append("action", "editUserSettings");
        data.append("user_id", <?= $row['user_d'] ?>);
        data.append("assigned_barangay", $("#assigned").val())



        $.ajax({
            type: 'post',
            url: 'config/Ajax.php',
            data: data,
            contentType: false,
            processData: false,
            success: function (e) {
                if (e === "true"){
                    notyf.success("Account Updated Successfully");
                    $("#oldpassword").val('');
                    $("#newpassword").val('');
                    $("#confirmpassword").val('');
                } else {
                    notyf.error(e)
                }
            }
        })

    });

</script>