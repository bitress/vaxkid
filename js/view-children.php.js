$( function() {
    $( ".dtp" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });

    $('#childDatatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        serverMethod: 'post',
        ajax: {
            url:'config/Ajax.php',
            data: {
                action: 'dtFetchChildren'
            }
        },
        columns: [
            { data: 'child_firstname' },
            { data: 'birth_date' },
            { data: 'mother_name' },
            { data: 'contact_number' },
            { data: 'address' },
            { data: 'btn' }
        ],
        columnDefs: [ {
            "target": "no-sort",
            "orderable": false
        } ]
    });

    $(document).on('click', '.view-child', function (){

        let child_id = $(this).data('id');
        let view_modal = new bootstrap.Modal(document.getElementById('viewChildModal'));
        view_modal.show();

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

} );