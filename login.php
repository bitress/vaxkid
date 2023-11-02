<?php
include_once 'config/init.php';

Session::destroy('isLoggedIn');
Session::destroy('uid');
Session::destroy('role');


?>
    <div class=" p-5  text-dark jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <img src="assets/img/logo/VaxKid-logos_transparent.png" width="100">
                </div>
                <div class="col-md-8">
                    <h1 class="title">VAXKID: PATIENT’S VACCINATION RECORD FOR RHU TAGUDIN</h1>
                    <p class="sub-title">Tagudin, Ilocos Sur</p>
                </div>
            </div>
        </div>
    </div>



    <div class="container mt-4 h-100">



        <div class="row text-center">
            <div class="col-md-4">
                <h2 class="center"><i class="fa fa-search fa-5x facolor"></i></h2>
                <p><strong>Search Child</strong></p>
                <p><a class="btn btn-outline-secondary" href="search.php" role="button">Search &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2 class="center"><i class="fa fa-user-nurse fa-5x"></i></h2>
                <p><strong>Municipal Health Officer</strong></p>
                <p><a class="btn btn-outline-secondary" type="button"  data-bs-toggle="modal" data-bs-target="#mhoLogin">Login &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2 class="center"><img src="midwife.png" width="110"></h2>
                <p><strong>Midwife</strong></p>
                <p><a class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#midwifeLogin">Login &raquo;</a></p>
            </div>
        </div>

    </div>

<hr>

<div class="container">
    <footer class="footer">
        <p>&copy; VaxKid - RHU Tagudin <?= date("Y") ?></p>
    </footer>
</div>


    <div class="modal fade" id="mhoLogin" tabindex="-1" aria-labelledby="mhoLogin" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Login as MHO</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                        <div class="modal-body">
                                    <div class="card shadow-lg">
                                        <div class="card-body p-5">
                                            <form method="post" id="mho_loginForm">
                                                <label for="role99" class="fs-4 card-title fw-bold mb-4 col-form-label">Welcome to Vaxkid</label>
                                            <input type="hidden" value="mho" id="mho_role">
                                                    <div class="mb-3">
                                                        <label class="mb-2 text-muted" for="username">Username</label>
                                                        <input id="mho_username" type="text" class="form-control" name="username" value="" required autofocus  autocomplete="off"/>
                                                    </div>

                                                    <div class="mb-3">
                                                        <div class="mb-2 w-100">
                                                            <label class="text-muted" for="password">Password</label>
                                                        </div>
                                                        <input id="mho_password" type="password" class="form-control" name="password" value="" required  autocomplete="off"/>
                                                    </div>

                                                    <div class="d-flex align-items-center">
                                                        <button type="submit" id="mho_login" class="btn btn-primary ms-auto">
                                                            Login
                                                        </button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
            </div>
        </div>
        </div>



<div class="modal fade" id="midwifeLogin" tabindex="-1" aria-labelledby="midwifeLogin" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Login as Midwife</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <form method="post" id="md_loginForm">
                            <label for="role99" class="fs-4 card-title fw-bold mb-4 col-form-label">Welcome to Vaxkid</label>
                            <input type="hidden" value="midwife" id="midwife_role">

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="username">Username</label>
                                <input id="midwife_username" type="text" class="form-control" name="username" value="" required autofocus autocomplete="off"/>
                            </div>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password">Password</label>
                                </div>
                                <input id="midwife_password" type="password" class="form-control" name="password" value="" required autocomplete="off"/>
                            </div>

                            <div class="d-flex align-items-center">
                                <button type="submit" id="midwife_login" class="btn btn-primary ms-auto">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="js/login.js"></script>
