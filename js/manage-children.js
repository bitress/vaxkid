// window.addEventListener('DOMContentLoaded', event => {
//     const childDatatable = document.getElementById('childDatatable');
//     if (childDatatable) {
//         new simpleDatatables.DataTable(childDatatable);
//     }
// });

// var dataTable = new simpleDatatables.DataTable("#childDatatable", {})

var notyf = new Notyf({
    duration: 1000,
    position: {
        x: 'right',
        y: 'top',
    }});

$(document).ready(function (){
    $('#childDatatable').DataTable();


    $("#saveChildButton").on('click', function (e){
        var data = new FormData($("#addChildForm")[0]);
        data.append("action", "registerChild");
        data.append('region_name', $("#select_region option:selected").text());
        data.append('province_name', $("#select_province option:selected").text());
        data.append('city_name', $("#select_city option:selected").text());

        $.ajax({
            type: 'post',
            url: 'config/Ajax.php',
            data: data,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res === "true"){
                    notyf.success("Child is successfully added to the record");
                    setTimeout(function() {
                        loadManageChildren()
                    }, 3000);

                }
            }
        });


    });
});


    $("#editChildButton").on('click', function (e){
        var data = new FormData($("#editChildForm")[0]);
        data.append("action", "editChild");

        $.ajax({
            type: 'post',
            url: 'config/Ajax.php',
            data: data,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res === "true"){
                    notyf.success("Child edit is success");
                    setTimeout(function() {
                        loadManageChildren()
                    }, 3000);

                }
            }
        });


    });




$(document).on('click', '.delete-child', function (){

    let child_id = $(this).data('id');
    let child_name = $(this).data('name');

            swal({
                title: "Are you sure you want to delete "+ child_name + " on your record.",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode:true,
            })
        .then((willDelete)=>{
            if(willDelete){
                $.ajax({
                    url: 'config/Ajax.php',
                    type: 'post',
                    data: {
                        action: 'deleteChild',
                        id: child_id
                    },
                    success: function (res) {
                        if (res === "true"){

                            swal("Child deleted successfully!",{
                                icon:"success",
                            });

                            $("#tr_"+ child_id).remove()
                        }
                    }
                })

            }else{
                swal("Nothing was deleted!");
            }
        });



});

$(document).on('click', '.administer-child', function (){
    var child_id = $(this).data("id");

    var administerModal = new bootstrap.Modal(document.getElementById('administerChildModal'));
    administerModal.show();
    $("#vaccine_administered").empty();

    $.ajax({
        type: 'post',
        url: 'config/Ajax.php',
        data: {
            action: 'administerFetch',
            id: child_id
        }, success: function (res){
            var $child = JSON.parse(res);

            $("#dn_childname").text($child.child_name)
            $("#age").val($child.age)
            $("#consultation_date").val($child.consultation_date)
            $("#administerchild_id").val($child.child_id)
            // $(".#test").html($child.option)
            $("#vaccine_administered").append($child.option)

            $("#vaccine_administered").trigger("liszt:updated");
            $("#vaccine_administered").trigger("chosen:updated");

            $('#vaccine_administered').chosen({width: "95%"});

        }
    })





});

$(document).on('click', '.edit-child', function (){

    let child_id = $(this).data('id');
    var view_modal = new bootstrap.Modal(document.getElementById('editChildModal'));
    view_modal.show();
    $.ajax({
        type: 'post',
        url: 'config/Ajax.php',
        data: {
            action: 'fetchChild',
            id: child_id
        },
        success: function (res){
            let child = JSON.parse(res);

            var placeOfBirth = child.birth_place.split(",");
            var city = placeOfBirth.splice(0,1).join("");
            var province = placeOfBirth.join(",")


            $("#edit_child_id").val(child.child_id)
            $("#edit_firstname").val(child.child_firstname)
            $("#edit_middlename").val(child.child_middlename)
            $("#edit_lastname").val(child.child_lastname)
            $(".edit_birth_date").val(child.birth_date)
            $("#edit_birth_time").val(child.birth_time)
            $("#edit_gender").val(child.gender)
            $("#edit_town").val(city)
            $("#edit_province").val(province)
            $("#edit_hospital").val(child.hospital)
            $("#edit_obstetrician").val(child.obstetrician)
            $("#edit_pediatrician").val(child.pediatrician)
            $("#edit_mother").val(child.mother_name)
            $("#edit_father").val(child.father_name)
            $("#edit_address").val(child.address)
            $("#edit_contact").val(child.contact_number)
            $("#edit_delivery_type").val(child.typeofdelivery)
            $("#edit_weight").val(child.weight)
            $("#edit_length").val(child.length)
            $("#edit_head_circumference").val(child.head_circumference)
            $("#edit_chest_circumference").val(child.chest_circumference)
            $("#edit_blood_type").val(child.blood_type)
            $("#edit_eye_color").val(child.eye_color)
            $("#edit_hair_color").val(child.hair_color)
            $("#edit_distinguishing_marks").val(child.distinguishing_marks)
            $("#edit_newborn_screening_date").val(child.newborn_screening_date)



        }
    })



});


var my_handlers = {

    fill_provinces:  function(){

        var region_code = $(this).val();
        $('#select_province').ph_locations('fetch_list', [{"region_code": region_code}]);

    },

    fill_cities: function(){

        var province_code = $(this).val();
        $('#select_city').ph_locations( 'fetch_list', [{"province_code": province_code}]);

    }
};

$(function(){
    $('#select_region').on('change', my_handlers.fill_provinces);
    $('#select_province').on('change', my_handlers.fill_cities);

    $('#select_region').ph_locations({'location_type': 'regions'});
    $('#select_province').ph_locations({'location_type': 'provinces'});
    $('#select_city').ph_locations({'location_type': 'cities'});

    $('#select_region').ph_locations('fetch_list');                                                });