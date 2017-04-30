biziApp.controller('purchase_order_addController', function ($scope,$location,$routeParams) {
    // create a message to display in our view
    //$(window).trigger('resize');

    //REGXP
    $scope.only_numbers = /^\d+$/;
    $scope.only_decimal= /^[0-9]+([,.][0-9]+)?$/;
    $scope.regexp_pattern=regexp;



    $scope.contract_no="";

    $scope.array_category = {
        category:[],
        select_category:{}
};

    $scope.array_supplier = {
        suppliers: [],
        select_Supplier: {}
    };

    /*$scope.category = [
        {name: "Coconut", id: "1"},
        {name: "Firewood", id: "2"}
    ];*/

    var save_data = [];
    var load_data = [];

    $scope.selected_supplier = '';
    $scope.selected_category = '';
    $scope.total_units = '';
    $scope.total_weight = '';
    $scope.kg_price='';
    //$scope.expire_date='';
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
    $scope.load_supplier_dropdown = function (data_id) {


        var data_set={};
        data_set['data_id']=data_id;

        $.ajax({
            url: base_url+"api/http_get/load_available_suppliers",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify(data_set),
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
                    if($scope.add_mode_enabled==true ) {
                        alert("No Suppliers Available");
                        $scope.$apply(function () //to reset dropdown
                        {

                            $location.path('purchase_order');
                        });
                    }
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);

                //alert(thrownError + " Save Failed");
                alert("Server Not Found");


            }
        });

    };

    $scope.load_category_dropdown = function () {

        $.ajax({
            url: base_url+"api/http_get/load_categories",
            type: "POST",
            dataType: 'json',
            //data: JSON.stringify(data_set),
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {
                    $scope.$apply(function () //to reset dropdown
                    {
                        /*$scope.suppliers = [
                         {name : "Coconut", id : "1"},
                         {name : "Firewood", id : "2"}
                         ];*/

                        $scope.category =response['data'];

                    });
                }

                if (response['code'] == 500) {
                    if($scope.add_mode_enabled==true ) {
                        alert("No Category Available");
                        $scope.$apply(function () //to reset dropdown
                        {

                            $location.path('purchase_order');
                        });
                    }
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
        $scope.array_supplier.select_Supplier = {};
        $scope.array_category.select_category = {};
        $scope.total_units = '';
        $scope.total_weight = '';
        $scope.kg_price='';
    };

    $scope.save_data_grid = function () {

        $.ajax({
            url: base_url+"api/http_post/save_contract",
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

                        $location.path('purchase_order');

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

    $scope.update_data_grid = function () {

        $.ajax({
            url: base_url+"api/http_put/edit_contract",
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

                        $location.path('purchase_order');

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

    $scope.enable_suppliers=function(){
        $.ajax({
            url: base_url + "api/http_put/enable_suppliers",
            type: "POST",
            dataType: 'json',
            //data: JSON.stringify(data_set),
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {

                    console.log(response['data']);
                    $scope.$apply(function () //to reset dropdown
                    {


                    });
                    // console.log($scope.data_set);
                }
                if (response['code'] == 304) {

                }
                $scope.load_supplier_dropdown(false);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);

                alert(thrownError + " Save  Failed");


            }
        });

    };

    $scope.edit_data_load=function(data_id){

        var data_set={};
        data_set['data_id']=data_id;


        $.ajax({
            url: base_url + "api/http_get/load_contracts_edit",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify(data_set),
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {

                    console.log(response['data']);
                    $scope.$apply(function () //to reset dropdown
                    {
                        if( $scope.amend_mode_enabled==true) {
                            $scope.total_units = response['data']['total_qty'];
                            $scope.total_weight = response['data']['total_weight'];
                            $scope.kg_price = response['data']['price'];
                            $scope.contract_no = response['data']['contract_no'];

                            var first_three_str = $scope.contract_no.substring(0, 3);

                            if(first_three_str=="SUB"){
                                $scope.sub_contract_mode_enabled=true;

                            }
                        }

                        $scope.contract_no = response['data']['contract_no'];
                        $scope.load_supplier_dropdown(response['data']['supplier_id']);

                        $scope.array_supplier.select_Supplier = {
                            'id': response['data']['supplier_id'],
                            'name': response['data']['first_name']
                        };
                        $scope.array_category.select_category = {
                            'id': response['data']['category_id'],
                            'name': response['data']['category_id']
                        };



                        $( "#datepicker" ).datepicker( "setDate", response['data']['expire_date_time'] );

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


    $scope.amend_data = function () {


        $scope.hide_data_grid=true;
        var contract_display='';
        if( $scope.total_units!=''){
            contract_display= $scope.total_units+" QTY";
        }else{
            contract_display= $scope.total_weight+" KG";
        }

        //Change this array according to the page
        $scope.data_set.form_data.push({
            id: $scope.itemNumber++,
            contract_display:contract_display,
            supplier_id:$scope.array_supplier.select_Supplier.id,
            supplier_name:$scope.array_supplier.select_Supplier.name,
            category_id: $scope.array_category.select_category.id,
            category_name: $scope.array_category.select_category.name,
            total_units: $scope.total_units,
            total_weight: $scope.total_weight,
            kg_price: $scope.kg_price,
            modify_id:$routeParams.id,
            amend_mode:$scope.amend_mode_enabled,
            contract_no: $scope.contract_no,
            expire_date: $( "#datepicker" ).val()
        });
        $scope.clear_form_data();
        $scope.update_data_grid();

        //$scope.paging();
        //$scope.currentPage = Math.ceil($scope.data_set.form_data.length / $scope.numPerPage);

        // }

    };

    $scope.add_to_grid = function () {

        if($scope.searchForId($scope.data_set.form_data,$scope.array_supplier.select_Supplier.id)===false) {

            var contract_display = '';
            if ($scope.total_units != '') {
                contract_display = $scope.total_units + " QTY";
            } else {
                contract_display = $scope.total_weight + " KG";
            }

            //Change this array according to the page
            $scope.data_set.form_data.push({
                id: $scope.itemNumber++,
                contract_display: contract_display,
                supplier_id: $scope.array_supplier.select_Supplier.id,
                supplier_name: $scope.array_supplier.select_Supplier.name,
                category_id: $scope.array_category.select_category.id,
                category_name: $scope.array_category.select_category.name,
                total_units: $scope.total_units,
                total_weight: $scope.total_weight,
                kg_price: $scope.kg_price,
                contract_no: $scope.contract_no,
                expire_date: $("#datepicker").val()
            });


            $scope.clear_form_data();


            $scope.paging();
            $scope.currentPage = Math.ceil($scope.data_set.form_data.length / $scope.numPerPage);


            // }
        }else {
            alert('Supplier Already Has A Record In Data grid');
        }

    };

    $scope.searchForId =function (array,search) {

        var return_flag=false;

        //alert(search);
        for (var i = 0; i < array.length; i++) {
            console.log(array[i]);
            if(array[i]['supplier_id']===search){
                return_flag= true;
                //alert('found');
                break;

            }
            //Do something
        }

        return return_flag;
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

    $scope.load_category_dropdown();

    if($routeParams.state=='add'){
        //alert($routeParams.id);
        $scope.add_mode_enabled=true;
        $scope.enable_suppliers();
    }

    $scope.amend_mode_enabled=false;
    if($routeParams.state=='amend') {
        $scope.amend_mode_enabled=true;
        $scope.edit_data_load($routeParams.id);
    }

    if($routeParams.state=='sub_contract') {
        $scope.sub_contract_mode_enabled=true;
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