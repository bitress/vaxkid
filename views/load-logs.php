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
                            Activity Logs
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">

                <table class="table table-condensed g-0" id="logss">
                    <?php

                    $logs = new Activity();
                    $activity = $logs->fetch();

                    foreach ($activity as $act){

                    ?>
                    <tr>
                        <td><?php echo $act['firstname'] .' '. $act['middlename'] . ' '. $act['lastname'] .' ' . $act['activity'] . ' on '. date('l F jS, Y \a\t g:ia', strtotime($act['date_created'])); ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>

            </div>
        </div>
    </div>
</main>
<script>
    var vaccinesDTB = document.getElementById('logss');
    if (vaccinesDTB) {
        new simpleDatatables.DataTable(vaccinesDTB, {
            hiddenHeader: true,
            searchable: false,
            header: false,
            perPageSelect: false

        });
    }
</script>

