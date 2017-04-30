biziApp.controller('note_grn_addController', function ($scope,$location) {
    // create a message to display in our view
    //$(window).trigger('resize');

    var save_data = [];
    var load_data = [];

    //REGXP
    $scope.only_numbers = /^\d+$/;
    $scope.only_decimal= /^[0-9]+([,.][0-9]+)?$/;
    $scope.regexp_pattern=regexp;



    $scope.supplier_name = '';
    $scope.supplier_code = '';
    $scope.save_btn_disabled=false;
    $scope.supplier_email='';
    var begin, end;

    //$scope.regexp=new RegExp("/^[A-Za-z ][A-Za-z0-9!@#$%^&* ,.]*$/");//"/^[A-Za-z ][A-Za-z0-9!@#$%^&* ,.]*$/"
//var patternFromServer="/^[A-Za-z ][A-Za-z0-9!@#$%^&* ,.]*$/";
    $scope.regexp_pattern = regexp;

    $scope.filteredTodos = [],
        $scope.currentPage = 1,
        $scope.numPerPage = 10,
        $scope.maxSize = 5,
        $scope.itemNumber = 0;

    $scope.data_set = {form_data: [], selected: {}};
    $scope.update_data = {update_data: [], selected: {}};
    $scope.delete_data = {delete_data: [], selected: {}};


    //================ Grid  Event ========================================
    $scope.$watch('currentPage + numPerPage', function () {
        $scope.paging();
        $scope.indexStartNo = begin;
        save_data = $scope.data_set;
    });
    $scope.removeItem = function (index) {

        if (confirm("Delete This Item?") == true) {
            $scope.data_set.form_data.splice(index + $scope.indexStartNo, 1);
            $scope.paging();
        } else {

        }
    };
    //clear save Data Grid (clear button function)
    $scope.clearItems = function (index) {

        if (confirm("Clear Current Data Set?") == true) {
            $scope.data_set.form_data = [];
            $scope.paging();
        } else {

        }
    };
    // gets the template to ng-include for a table row / item
    $scope.getTemplate = function (index) {
        if (index.id === $scope.data_set.selected.id)
            return 'edit';
        else
            return 'display';
    };
    $scope.editItem = function (index) {
        $scope.data_set.selected = angular.copy(index);
        document.getElementById("save_data_grid").disabled = true;
    };
    $scope.saveItem = function (index) {
        console.log("Saving contact");
        $scope.data_set.form_data[index + $scope.indexStartNo] = angular.copy($scope.data_set.selected);
        $scope.reset();

        $scope.paging();

    };
    $scope.reset = function () {
        $scope.data_set.selected = {};
        document.getElementById("save_data_grid").disabled = false;
    };
    $scope.paging = function () {
        begin = (($scope.currentPage - 1) * $scope.numPerPage), end = begin + $scope.numPerPage;
        $scope.grid_show = $scope.data_set.form_data.slice(begin, end);

    };

    //Disable Reload if data is present
    window.onbeforeunload = function () {
        if ($scope.data_set.form_data.length > 0) {
            return "Are you sure you want to leave?";
        }
    };


    //==================================================================================

    //---------------- load dropdown------------------------------

    $scope.load_supplier_dropdown = function () {

        $.ajax({
            url: base_url+"api/http_get/load_unavailable_suppliers",
            type: "POST",
            dataType: 'json',
            //data: JSON.stringify($scope.data_set),
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {
                    $scope.$apply(function () //to reset dropdown
                    {
                        /*$scope.suppliers = [
                         {name : "Coconut", id : "1"},
                         {name : "Firewood", id : "2"}
                         ];*/

                        $scope.suppliers =response['data'];

                    });
                }

                if (response['code'] == 500) {
                    //if($scope.add_mode_enabled==true ) {
                    alert("No Suppliers Available");
                    $scope.$apply(function () //to reset dropdown
                    {

                        $location.path('note_grn');
                    });
                    // }
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);

                //alert(thrownError + " Save Failed");
                alert("Server Not Found");


            }
        });

    };




    $scope.load_supplier_dropdown();
    //--------------------------------------------------------------


$scope.get_contract_details=function()
{
   // alert($scope.supplier.id);
    $.ajax({
        url: base_url+"api/http_get/load_contract_details",
        type: "POST",
        dataType: 'json',
        data: {"supplier_id":$scope.supplier.id},
        success: function (response) {
            console.log(response);
            if (response['code'] == 201) {
                $scope.$apply(function () //to reset dropdown
                {

                    $scope.bill_details_grid =false;


                    $scope.contract_data_grid=[];
                    var data_set=response['data'];
                    $scope.contract_data_grid[0]=data_set['contract_detail'];


                    console.log($scope.contract_data_grid);

                    $scope.contract_date =response['data']['contract_detail']['created_date_time'];
                    $scope.contract_no =response['data']['contract_detail']['contract_no'];
                    $scope.contract_id =response['data']['contract_detail']['contract_id'];
                    $scope.category_id =response['data']['contract_detail']['category_id'];
                    $scope.no_of_unit =response['data']['contract_detail']['total_qty'];
                    $scope.quantity =response['data']['contract_detail']['total_weight'];
                    $scope.amount =response['data']['contract_detail']['price'];
                    $scope.category_name =response['data']['contract_detail']['category_name'];

                    $scope.contract_supplier_id =response['data']['contract_detail']['supplier_id'];
                    $scope.contract_supplier_name =response['data']['contract_detail']['name'];
                    $scope.contract_supplier_code =response['data']['contract_detail']['code'];

                    $scope.bill_no ="";
                    $scope.bill_numbers =response['data']['bill_nos'];
                });
            }

            if (response['code'] == 500) {
                alert("Supplier Load Failed");
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //alert(xhr.responseText);

            //alert(thrownError + " Save Failed");
            alert("Server Not Found");


        }
    });
};

    $scope.get_bill_details=function()
    {

        /*


         'product' =>  $data->product,
         'supplier_name' =>  $data->supplier_name,
         'supplier_code' =>  $data->supplier_code,
         'bill_no' =>  $data->bill_no,
         'received_date_time' =>  $data->received_date_time,
         'exit_date_time' =>  $data->exit_date_time,
         'truck_no' =>  $data->truck_no,
         'truck_driver' =>  $data->truck_driver,
         'first_weight' =>  $data->first_weight,
         'second_weight' =>  $data->second_weight,
         'total_qty' =>  $data->total_qty,
         'bad_qty' =>  $data->bad_qty,
         'accepted_qty' =>  $data->accepted_qty,
         'w_b_operator' =>  $data->w_b_operator*/
        $scope.product="";
        $scope.supplier_name="";
        $scope.supplier_code="";
        //$scope.bill_no="";
        $scope.exit_date_time="";
        $scope.truck_driver="";
        $scope.first_weight="";
        $scope.second_weight="";
        $scope.total_qty="";
        $scope.total_qty="";

        $.ajax({
            url: base_url+"api/http_get/load_bill_details",
            type: "POST",
            dataType: 'json',
            data: {"bill_no":$scope.bill_no.id},
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {
                    $scope.$apply(function () //to reset dropdown
                    {

                        $scope.bill_details_grid =[];
                        $scope.bill_details_grid =response['data'];

                        $scope.bill_supplier_name =response['data'][0]['supplier_name'];
                        $scope.bill_supplier_code =response['data'][0]['supplier_code'];
                        $scope.bill_product =response['data'][0]['product'];

                        $scope.vehicle_number =$scope.bill_details_grid[0]['truck_no'];
                        $scope.contract_bad_qty =$scope.bill_details_grid[0]['bad_qty'];
                        $scope.contract_total_qty = $scope.bill_details_grid[0]['total_qty'];




                    });
                }

                if (response['code'] == 500) {
                    alert("Supplier Load Failed");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);

                //alert(thrownError + " Save Failed");
                alert("Server Not Found");


            }
        });
    };


    $scope.clear_form_data = function () {
        $scope.supplier_name = '';
        $scope.contact_id = '';
        $scope.street1 = '';
        $scope.street2 = '';
        $scope.province = '';
        $scope.postal_code = '';
        $scope.supplier_TP = '';
        $scope.supplier_email = '';
        $scope.supplier_city = '';
        $scope.supplier_code = '';
    };

    $scope.add_to_grid = function () {


        $scope.data_set.form_data.push({
            supplier_id: $scope.contract_supplier_id,
            contract_no: $scope.contract_no,
            contract_id: $scope.contract_id,
            category_id: $scope.category_id,
            product: $scope.category_name,
            bill_no: $scope.bill_details_grid[0]['bill_no'],
            bill_id: $scope.bill_details_grid[0]['weigh_bill_id'],
            received_date_time: $scope.bill_details_grid[0]['received_date_time'],
            exit_date_time: $scope.bill_details_grid[0]['exit_date_time'],
            truck_no:  $scope.vehicle_number,
            price:$scope.amount,
            first_weight: $scope.bill_details_grid[0]['first_weight'],
            second_weight: $scope.bill_details_grid[0]['second_weight'],
            net_weight: $scope.bill_details_grid[0]['first_weight']-$scope.bill_details_grid[0]['second_weight'],
            wet_weight: $scope.bill_details_grid[0]['truck_no'],
            bad_qty: $scope.contract_bad_qty,
            total_qty:   $scope.contract_total_qty,
            accepted_qty:   $scope.contract_total_qty-$scope.contract_bad_qty,
            w_b_operator: $scope.bill_details_grid[0]['w_b_operator'],
            truck_driver: $scope.bill_details_grid[0]['truck_driver']
        });

        $scope.save_data_grid();


    };


    $scope.save_data_grid = function () {

        $.ajax({
            url: base_url+"api/http_post/save_received_goods",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify($scope.data_set),
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {
                    alert("Data Inserted Successfully");
                    $scope.$apply(function () //to reset dropdown
                    {
                        $scope.data_set = [];
                        $scope.data_set = {form_data: [], selected: {}};

                        $scope.showme = false;
                        $location.path('note_grn');
                    });
                    console.log($scope.data_set);
                }
                if (response['code'] == 409) {

                    $scope.$apply(function () //to reset dropdown
                    {
                        alert(response['message']);
                        $location.path('note_grn');
                    });
                }

                if (response['code'] == 500) {
                    alert(response['message']);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);

                //alert(thrownError + " Save Failed");
                alert("Server Not Found");


            }
        });

    };

    //===================================================================================


    // ----------------------------------Edit part--------------------------------------------
    $scope.load_main_data_for_edit = function (data_id, array_index) {


        // alert(data_id);
        //console.log($scope.db_data);

        if (confirm("Edit " + load_data[array_index]['person_name'] + "?") === true) {
            //load text box and dropdowns
            $scope.$apply(function () //to reset dropdown
            {
                console.log(load_data);
                $scope.supplier_name = load_data[array_index]['person_name'];
                $scope.supplier_code = load_data[array_index]['person_code'];
                $scope.supplier_ID = data_id;
                $scope.contact_id = load_data[array_index]['contact_id'];
                $scope.street1 = load_data[array_index]['street1'];
                $scope.street2 = load_data[array_index]['street2'];
                $scope.province = load_data[array_index]['province'];
                $scope.postal_code = load_data[array_index]['postal_code'];
                $scope.supplier_TP = load_data[array_index]['phone_number'];
                $scope.supplier_city = load_data[array_index]['city'];


                if (load_data[array_index]['web_address'] === null) {
                    $scope.supplier_email = '';

                }
                else {

                    $scope.supplier_email = load_data[array_index]['web_address'];
                }

                $scope.edit_mode_enabled = true;
                $scope.showme = true;


            });
        }


    };

    $scope.update_main_data = function () {
        $scope.update_data = {update_data: [], selected: {}};

        $scope.update_data.update_data.push({
            id: $scope.supplier_ID,
            contact_id: $scope.contact_id,
            supplier_name: $scope.supplier_name,
            supplier_code: $scope.supplier_code,
            street1: $scope.street1,
            street2: $scope.street2,
            province: $scope.province,
            postal_code: $scope.postal_code,
            supplier_TP: $scope.supplier_TP,
            supplier_city: $scope.supplier_city,
            supplier_email: $scope.supplier_email


        });


        //I know this is a copypaste but this function isnt right to update data,
        //use save_data_grid function instead

        $.ajax({
            url: base_url+"Inventory_update/supplier_update",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify($scope.update_data),
            success: function (response) {
                // console.log(response);
                if (response.res === 1) {
                    alert("Data Updated Successfully");
                    $scope.$apply(function () //to reset dropdown
                    {
                        // $scope.update_data = [];
                        $scope.update_data = {update_data: [], selected: {}};
                        $scope.grid_refrash();

                        $scope.showme = false;

                    });
                    // console.log($scope.data_set);
                } else {
                    alert("Update Failed");
                    $scope.update_data = {update_data: [], selected: {}};
                    $scope.grid_refrash();

                    $scope.showme = false;
                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);
                alert(thrownError + " Update Failed");

            }
        });


    };
    // ---------------------------------- END Edit part--------------------------------------------

    //--------------------------------- Delete  Part -------------------

    $scope.Delete_main_data_user = function (data_id, array_index) {

        if (confirm("Delete " + load_data[array_index]['person_name'] + "?") === true) {
            $scope.delete_data.delete_data.push({
                supplier_id: data_id,
                contact_id: load_data[array_index]['contact_id']
            });

            console.log($scope.delete_data);
            $.ajax({
                url: base_url+"Inventory_delete/supplier_delete_user",
                type: "POST",
                dataType: 'json',
                data: JSON.stringify($scope.delete_data),
                success: function (response) {
                    console.log($scope.delete_data);
                    if (response.res === 1) {
                        alert("Data Delete Successfully");
                        $scope.$apply(function () //to reset dropdown
                        {
                            // $scope.update_data = [];
                            $scope.delete_data = {delete_data: [], selected: {}};
                            $scope.grid_refrash();

                            $scope.showme = false;

                        });
                        // console.log($scope.data_set);
                    } else {
                        alert("Delete Failed");
                        $scope.delete_data = {delete_data: [], selected: {}};
                        $scope.grid_refrash();

                        $scope.showme = false;
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //alert(xhr.responseText);

                    alert(thrownError + " Delete Failed");
                    $scope.delete_data = {delete_data: [], selected: {}};
                    $scope.grid_refrash();

                }
            });
        }
    };


    //--------------------------------- END Delete  Part -------------------

    $scope.array_search = function (array, index, string) {
        for (var i = 0; i < array.length; i++) {
            if (array[i][index] === string) {
                return i;
            }

        }
    };

});