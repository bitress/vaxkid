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
                            Users List
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                                <div class="table-responsive">

                <table id="users_dtable" class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    <?php

                    $user = new User();
                    $u = $user->getAllUserData();
                    foreach ($u as $rhu):
                        ?>

                        <tr>
                            <td><?= $rhu['user_d'] ?></td>
                            <td><?= $rhu['username'] ?></td>
                            <td><?= $rhu['email'] ?></td>
                            <td><?= $rhu['role'] ?></td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary edit-user" data-id="<?= htmlentities($rhu['user_d']) ?>"><i class="fa fa-pencil"></i></button>
                              <!--      <button type="button" class="btn btn-primary delete-user" data-id="<?= htmlentities($rhu['user_d']) ?>" data-name="<?= htmlentities($rhu['username']); ?>"><i class="fa fa-trash"></i></button> -->
                                </div>
                            </td>
                        </tr>

                    <?php  endforeach; ?>

                    </tbody>
                </table>
            </div>
            </div>

        </div>
    </div>
</main>


<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="container-xl px mt-4">
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Account details card-->
                            <form id="editUserForm">
                                <!-- Form Group (username)-->
                                <input type="hidden" id="user_id" name="user_id">
                                <div class="mb-3">
                                    <label class="small mb-1" for="username">Username<span class="required">*</span> (Will be used as a login)</label>
                                    <input class="form-control" id="username" name="username" type="text" placeholder="Enter username"/>
                                </div>

                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email<span class="required">*</span></label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Enter email" value="" />
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
                                <button class="btn btn-primary" id="editNewUser" type="button">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>

    // var vaccinesDTB = document.getElementById('users_dtable');
    // if (vaccinesDTB) {
    //     new simpleDatatables.DataTable(vaccinesDTB);
    // }


    var notyf = new Notyf({
        duration: 1000,
        position: {
            x: 'right',
            y: 'top',
        }});


    $(document).ready(function (e){
        
            $('#users_dtable').DataTable();

        $(document).on('click', '.edit-user', function (){
            var editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            var user_id = $(this).data('id');
            editModal.show();
            $.ajax({
                type: 'post',
                url: 'config/Ajax.php',
                data: {
                    action: 'fetchUser',
                    id: user_id
                }, success: function (res){
                    var user = JSON.parse(res);
                    $("#email").val(user.email)
                    $("#username").val(user.username)
                    $("#user_id").val(user.user_d)

                }
            })
        });


        $(document).on('click', '.delete-user', function (){

            var user_id = $(this).data('id');
            var name = $(this).data("name");

            swal({
                title: "Are you sure you want to delete " + "'" + name + "'" + " as a user? ",
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
                                id: user_id
                            }, success: function (res){
                                if (res === "true"){
                                    swal("Poof! Midwife has been deleted! ", {
                                        icon: "success",
                                    });
                                    setTimeout(function() {
                                        loadUsers();
                                    }, 3000);

                                }
                            }
                        });

                    } else {
                        swal("Nothing was deleted!");
                    }
                });



        });

        $("#editNewUser").on("click", function (e){

            var user_data = new FormData($("#editUserForm")[0]);
            user_data.append("action", "editUser");


            $.ajax({
                type: 'post',
                url: 'config/Ajax.php',
                data: user_data,
                contentType: false,
                processData: false,
                success: function (res){
                    notyf.success("Edit success");
                    setTimeout(function() {
                        loadUsers();
                    }, 3000);
                }
            })

        });


    });

</script>
