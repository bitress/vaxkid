<?php

include_once '../config/init.php';

if (!$login->isLoggedIn()){
    header("Location: index.html");
    die();
}

$counter = new Counter();
?>
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            Dashboard
                        </h1>
                        <div class="page-header-subtitle">A Vaccination Record For RHU Tagudin</div>
                    </div>
                    <div class="col-12 col-xl-auto mt-4">
                                                <span id="datetime"></span>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <!-- Example Colored Cards for Dashboard Demo-->
        <div class="row">
            <div class="col-lg-6 col-xl-6 mb-4">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Children Vaccinated (Overall)</div>
                                <div class="text-lg fw-bold"><?= $counter->vaccinatedKidsOverAll() ?></div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="users"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">

                      <a class="text-white stretched-link" href="functions/print_schedule.php?barangay=All&display=Vaccination&type=vaccinated">View Report</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6 mb-4">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Children Not Vaccinated (Overall)</div>
                                <div class="text-lg fw-bold"><?= $counter->unvaccinatedKidsOverAll() ?></div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="user-minus"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                      <a class="text-white stretched-link" href="functions/print_schedule.php?barangay=All&display=Vaccination&type=not_vaccinated">View Report</a> 
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Example Charts for Dashboard Demo-->
        <div class="row">
            <div class="col-xl-6 mb-4">
                <div class="card card-header-actions">
                    <div class="card-header">
                        Vaccinated Children Each Barangay
                    </div>
                    <div class="card-body">
                        <p class="text-muted text-xs m-0"><small>If barangay not shown in graph, it is because there is no child found in that barangay.</small></p>
                        <div id="myChart"></div>
                        <!--                        <div class="chart-pie"><canvas id="myChart" width="100%" height="50"></canvas></div>-->
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mb-4">
                <div class="card card-header-actions h-100">
                    <div class="card-header">
                        Not Vaccinated Children Each Barangay
                    </div>
                    <div class="card-body">
                        <p class="text-muted text-xs m-0"><small>If barangay not shown in graph, it is because there is no child found in that barangay.</small></p>
                        <div id="unvaccinatedBaragayCharts"></div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 mb-4">
                <div class="card card-header-actions h-100">
                    <div class="card-header">
                        Vaccination Yearly
                    </div>
                    <div class="card-body">
                        <div id="vaccinationYearly"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="card card-header-actions h-100">
                    <div class="card-header">
                        Vaccination Schedule
                    </div>
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</main>
<script>

    $(document).ready(function (){

        $.ajax({
            url: 'config/Ajax.php',
            type: 'POST',
            data: {
                action: 'fetchCalendarSchedule'
            }, success: function (res) {

                var eventData = JSON.parse(res)

                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    editable: true,
                    displayEventTime: false,
                    selectable: true,
                    events: eventData
                });
                calendar.render();

            }
        })
    })










    var datetime = null,
        date = null;
    var update = function () {
        date = moment(new Date())
        datetime.html(date.format('dddd, MMMM Do YYYY, h:mm:ss a'));
    };
    $(document).ready(function(){
        datetime = $('#datetime')
        update();
        setInterval(update, 1000);
    });




    $(document).ready(function (){




                var vaccinatedBarangayoptions = {
                    series: [
                        {
                            data: <?php echo "[" . implode(",",    $counter->countVaccinatedInEachBarangay()) . "]"; ?>
                        }
                    ],
                    legend: {
                        show: false
                    },
                    animations: {
                      enabled: false
                    },
                    chart: {
                        height: 500,
                        type: 'treemap'
                    },
                    noData: {
                        text: 'No Data to Show'
                    },
                    colors:
                        ["#8a3282","#f64cfa","#60ca76","#2e4569","#9d8499","#210f7a","#99189d","#0630b1","#813a14","#ecf806","#d7b59f","#57d06e","#f1e122","#e5db04","#326791","#059b89","#0385ad","#235e91","#aacde5","#7b4781","#2dd718","#2f45f6","#773126","#d10447","#59fe14","#a81a4a","#5b758c","#bbdebf","#5c69f5","#b3f612","#9fe8d2","#4a4521","#3b9760","#169712","#0e5b37","#ef0fd7","#4dc066","#bbc5a0","#774903","#b1868c","#d6b926","#9e2cf7","#678234","#0a0d66"],
                    plotOptions: {
                        treemap: {
                            distributed: true,
                            enableShades: true
                        }
                    }
                  };

                var vaccinatedBarangay = new ApexCharts(document.querySelector("#myChart"), vaccinatedBarangayoptions);
                $("#myChart").html('')
                vaccinatedBarangay.render();

                var unvaccinatedBarangayOpts = {
                    series: [
                        {
                            data: <?php echo "[" . implode(",",    $counter->countUnvaccinatedInEachBarangay()) . "]"; ?>
                        }
                    ],
                    legend: {
                        show: false
                    },
                    animations: {
                        enabled: false
                    },
                    chart: {
                        height: 500,
                        type: 'treemap'
                    },
                    noData: {
                        text: 'No Data to Show'
                    },
                    colors:
                        ["#8a3282","#f64cfa","#60ca76","#2e4569","#9d8499","#210f7a","#99189d","#0630b1","#813a14","#ecf806","#d7b59f","#57d06e","#f1e122","#e5db04","#326791","#059b89","#0385ad","#235e91","#aacde5","#7b4781","#2dd718","#2f45f6","#773126","#d10447","#59fe14","#a81a4a","#5b758c","#bbdebf","#5c69f5","#b3f612","#9fe8d2","#4a4521","#3b9760","#169712","#0e5b37","#ef0fd7","#4dc066","#bbc5a0","#774903","#b1868c","#d6b926","#9e2cf7","#678234","#0a0d66"],
                    plotOptions: {
                        treemap: {
                            distributed: true,
                            enableShades: true
                        }
                    }
                };
                var unvaccinatedBarangay = new ApexCharts(document.querySelector("#unvaccinatedBaragayCharts"), unvaccinatedBarangayOpts);

                unvaccinatedBarangay.render();


        $.ajax({
            url: 'config/Ajax.php',
            type: 'POST',
            data: {
                action: 'countYearlyVaccinated'
            },
            beforeSend: function (){
                $("#vaccinationYearly").html('<i class="fa fa-spinner fa-spin fa-xl"></i> Chart is loading. Please wait')
            },
            success: function (res){
                
                var data = JSON.parse(res);
                
                var yeare = [];
                var counte = [];
                for(var i = 0; i < data.year.length; ++i) {
                    yeare.push(data.year[i]) ;
                    counte.push(data.count[i]) ;

                }

                var options = {
                    series: [{
                        name: "Year",
                        data: counte
                    }],
                    chart: {
                        type: 'area',
                        height: 350,
                        zoom: {
                            enabled: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'straight'
                    },

                    title: {
                        text: 'Child Vaccination Yearly',
                        align: 'left'
                    },
                    labels: yeare,
                    xaxis: {
                        type: 'year',
                    },
                    yaxis: {
                        opposite: true
                    },
                    legend: {
                        horizontalAlign: 'left'
                    },
                    noData: {
                        text: 'No Data to Show'
                    }
                };
                var chart = new ApexCharts(document.querySelector("#vaccinationYearly"), options);
                $("#vaccinationYearly").html('')
                chart.render();

            }
        });
    })
</script>
