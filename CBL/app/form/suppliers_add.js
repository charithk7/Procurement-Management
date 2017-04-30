biziApp.controller('suppliers_addController', function ($scope,$location,$routeParams) {
    // create a message to display in our view
    //$(window).trigger('resize');

    var save_data = [];
    var load_data = [];

    $scope.regexp_pattern=regexp;


    $scope.save_btn_disabled=false;

    $scope.supplier_name = '';
    $scope.contact_id = '';
    $scope.street1 = '';
    $scope.street2 = '';
    $scope.province = '';
    $scope.postal_code = '';
    $scope.supplier_TP = '';
    $scope.supplier_account = '';
    $scope.supplier_city = '';
    $scope.supplier_code = '';

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




    $scope.clear_form_data = function () {
        $scope.supplier_name = '';
        $scope.contact_id = '';
        $scope.street1 = '';
        $scope.street2 = '';
        $scope.province = '';
        $scope.postal_code = '';
        $scope.supplier_TP = '';
        $scope.supplier_account = '';
        $scope.supplier_city = '';
        $scope.supplier_code = '';
    };

    $scope.save_data_grid = function () {

        $.ajax({
            url: base_url+"api/http_post/save_suppliers",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify($scope.data_set),
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {
                    alert("Data Saved Successfully");
                    $scope.$apply(function () //to reset dropdown
                    {
                        $scope.data_set = [];
                        $scope.data_set = {form_data: [], selected: {}};

                        $scope.showme = false;

                        $location.path('suppliers');

                    });
                    console.log($scope.data_set);
                }

                if (response['code'] == 500) {
                    alert("Save Failed");
                    $scope.data_set = [];
                    $scope.data_set = {form_data: [], selected: {}};

                    $scope.showme = false;
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);

                //alert(thrownError + " Save Failed");
                alert("Server Not Found");


            }
        });


    };
    $scope.add_to_grid = function () {
        if (typeof ($scope.array_search($scope.data_set.form_data, 'supplier_code', $scope.supplier_code)) != 'undefined') {
            alert("This Supplier Code is  Already in Grid");
        }

        else
        {
           /* $.ajax({
                url: base_url + "inventory_load/search_duplicates",
                type: "POST",
                dataType: 'json',
                data: {
                    "col": 'person_id',
                    "table": 'nsinm_person',
                    "search_col": 'person_code',
                    "search_data": $scope.supplier_code
                },
                success: function (response) {
                    console.log(response);
                    if (response['status'] == 0) {
                        $scope.$apply(function () //to reset dropdown
                        {
                            //Change this array according to the page
                            $scope.data_set.form_data.push({
                                id: $scope.itemNumber++,
                                supplier_name: $scope.supplier_name,
                                street1: $scope.street1,
                                street2: $scope.street2,
                                province: $scope.province,
                                postal_code: $scope.postal_code,
                                phone: $scope.supplier_TP,
                                email: $scope.supplier_email,
                                supplier_city: $scope.supplier_city,
                                supplier_code: $scope.supplier_code,
                                company_id: company_id,
                                user_id: user_id
                            });
                            $scope.clear_form_data();

                            $scope.paging();
                            $scope.currentPage = Math.ceil($scope.data_set.form_data.length / $scope.numPerPage);
                        });
                    } else {
                        alert("already add this Supplier ");
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //alert(xhr.responseText);

                    alert(thrownError + " Save Failed");


                }
            }); */

                //Change this array according to the page
                $scope.data_set.form_data.push({
                    id: $scope.itemNumber++,
                    supplier_name: $scope.supplier_name,
                    street1: $scope.street1,
                    street2: $scope.street2,
                    province: $scope.province,
                    postal_code: $scope.postal_code,
                    phone: $scope.supplier_TP,
                    supplier_account: $scope.supplier_account,
                    supplier_city: $scope.supplier_city,
                    supplier_code: $scope.supplier_code,
                    company_id: company_id,
                    user_id: user_id
                });
                $scope.clear_form_data();

                $scope.paging();
                $scope.currentPage = Math.ceil($scope.data_set.form_data.length / $scope.numPerPage);

        }

    };

    $scope.update_data = function () {

//Change this array according to the page
        $scope.data_set.form_data.push({
            id: $scope.itemNumber++,
            supplier_name: $scope.supplier_name,
            street1: $scope.street1,
            street2: $scope.street2,
            province: $scope.province,
            postal_code: $scope.postal_code,
            phone: $scope.supplier_TP,
            supplier_account: $scope.supplier_account,
            supplier_city: $scope.supplier_city,
            supplier_code: $scope.supplier_code,
            supplier_id: $routeParams.id
        });

        $.ajax({
            url: base_url+"api/http_put/edit_supplier",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify($scope.data_set),
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {
                    alert("Data Saved Successfully");
                    $scope.$apply(function () //to reset dropdown
                    {
                        $scope.data_set = [];
                        $scope.data_set = {form_data: [], selected: {}};

                        $scope.showme = false;

                        $location.path('suppliers');

                    });
                    console.log($scope.data_set);
                }

                if (response['code'] == 500) {
                    alert("Save Failed");
                    $scope.data_set = [];
                    $scope.data_set = {form_data: [], selected: {}};

                    $scope.showme = false;
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

    $scope.edit_data_load=function(data_id){

        var data_set={};
        data_set['data_id']=data_id;


        $.ajax({
            url: base_url + "api/http_get/load_suppliers_edit",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify(data_set),
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {

                    console.log(response['data']);
                    $scope.$apply(function () //to reset dropdown
                    {
                        $scope.supplier_name = response['data']['first_name'];
                       // $scope.contact_id = response['data'][''];
                        $scope.street1 = response['data']['street_1'];
                        $scope.street2 = response['data']['street_2'];
                        $scope.province = response['data']['province'];
                       // $scope.postal_code = response['data'][''];
                        $scope.supplier_TP = response['data']['phone'];
                        $scope.supplier_account = response['data']['account_number'];
                        $scope.supplier_city = response['data']['city'];
                        $scope.supplier_code = response['data']['code'];
                    });
                    // console.log($scope.data_set);
                } else
                    alert("No Data Available");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);

                alert(thrownError + " Save  Failed");


            }
        });

    };

    if($routeParams.state=='add'){
        //alert($routeParams.id);
    }

    if($routeParams.state=='edit') {
        $scope.edit_mode_enabled=true;
        $scope.edit_data_load($routeParams.id);
    }
    //--------------------------------- END Delete  Part -------------------

    $scope.array_search = function (array, index, string) {
        for (var i = 0; i < array.length; i++) {
            if (array[i][index] === string) {
                return i;
            }

        }
    };

});