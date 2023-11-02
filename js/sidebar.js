

    var defaultPage = true;

    $(".load").on("click", function (){
        var load = $(this).data("load");

        $(".load").removeClass('active');
        $(".load").removeClass('disabled');


        switch (load){
            case 'dashboard':
                loadDashboard()
                $(this).addClass('active');
                $(this).addClass('disabled');
                defaultPage = false;
                break;
            case 'manage-children':
                loadManageChildren()
                $(this).addClass('active');
                $(this).addClass('disabled');
                defaultPage = false;
                break;
            case 'view-children':
                loadViewChildren()
                $(this).addClass('active');
                $(this).addClass('disabled');
                defaultPage = false;
                break;
            case 'view-vaccines':
                loadViewVaccines();
                $(this).addClass('active');
                $(this).addClass('disabled');
                defaultPage = false;
                break;
            case 'view-midwife':
                loadViewMidwife();
                $(this).addClass('active');
                $(this).addClass('disabled');
                defaultPage = false;
                break;
            case 'view-schedules':
                loadViewSchedules();
                $(this).addClass('active');
                $(this).addClass('disabled');
                defaultPage = false;
                break;
            case 'view-reports':
                loadReports();
                $(this).addClass('active');
                $(this).addClass('disabled');
                defaultPage = false;
                break;
            case 'view-users':
                loadUsers();
                $(this).addClass('active');
                $(this).addClass('disabled');
                defaultPage = false;
                break;
            case 'view-settings':
                loadSettings();
                $(this).addClass('active');
                defaultPage = false;
                break;
            case 'view-logs':
                loadActivityLog();
                $(this).addClass('active');
                defaultPage = false;
                break;
            default:
                loadDashboard();
        }


    })


    if (defaultPage){
        loadDashboard();
    }

    function loadReports(){
        $.ajax({
            type: 'post',
            url: 'views/load-report.php',
            cache: false,
            success: function (html){
                $("#main").html(html);

                // Change Document Title
                $(document).prop('title', 'Manage Reports | VaxKid');
            }
        });
    }


    function loadSettings(){
        $.ajax({
            type: 'post',
            url: 'views/account-settings.php',
            cache: false,
            success: function (html){
                $("#main").html(html);

                // Change Document Title
                $(document).prop('title', 'My Account | VaxKid');
            }
        });
    }

    function loadUsers(){
        $.ajax({
            type: 'post',
            url: 'views/load-manage-user.php',
            cache: false,
            success: function (html){
                $("#main").html(html);

                // Change Document Title
                $(document).prop('title', 'Manage Users | VaxKid');
            }
        });
    }

    function loadViewSchedules(){
        $.ajax({
            type: 'post',
            url: 'views/load-schedules.php',
            cache: false,
            success: function (html){
                $("#main").html(html);

                // Change Document Title
                $(document).prop('title', 'Manage Schedules | VaxKid');
            }
        });
    }

    function loadDashboard(){
        // $("#loader").html('<img style="display: block;  margin-left: auto; margin-right: auto;  width: 50%;" src="/assets/img/spinner.gif">');
        $.ajax({
            type: 'post',
            url: 'views/load-dashboard.php',
            // url: 'views/account-settings.php',
            cache: false,
            success: function (html){
                // $("#loader").html('');
                $("#main").html(html);

                // Change Document Title
                $(document).prop('title', 'Dashboard | VaxKid');
            }
        });
    }

    function loadManageChildren() {
        $.ajax({
            type: 'post',
            url: 'views/load-manage-children.php',
            cache: false,
            success: function (html){
                $("#main").html(html);

                // Change Document Title
                $(document).prop('title', 'Manage Children | VaxKid');
            }
        })
    }

    function loadViewChildren(){
        $.ajax({
            type: 'post',
            url: 'views/load-view-children.php',
            cache: false,
            success: function (html){
                $("#main").html(html);

                // Change Document Title
                $(document).prop('title', 'View Children | VaxKid');
            }
        })
    }

    function loadViewVaccines() {
        $.ajax({
            type: 'post',
            url: 'views/load-view-vaccines.php',
            cache: false,
            success: function (html){
                $("#main").html(html);

                // Change Document Title
                $(document).prop('title', 'Manage Vaccines | VaxKid');
            }
        })
    }

    function loadViewMidwife(){
        $.ajax({
            type: 'post',
            url: 'views/load-midwife.php',
            cache: false,
            success: function (html){
                $("#main").html(html);

                // Change Document Title
                $(document).prop('title', 'Manage Midwives | VaxKid');
            }
        })
    }

    function loadActivityLog(){
        $.ajax({
            type: 'post',
            url: 'views/load-logs.php',
            cache: false,
            success: function (html){
                $("#main").html(html);

                // Change Document Title
                $(document).prop('title', 'Activity Logs | VaxKid');
            }
        })
    }



