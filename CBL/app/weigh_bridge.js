biziApp.controller('weigh_bridgeController', function ($scope,datatables_service) {


    //Default Dates
    var default_start_date=moment().subtract(29, 'days');
    var default_end_date=moment();

    $scope.start_date = default_start_date.format('YYYY-MM-DD');
    $scope.end_date = default_end_date.format('YYYY-MM-DD');
    $scope.sub_label = 'Last 30 Days';

    $scope.grid_display_data = 'All';
    $scope.hide_date_range_button=false;



    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),//Set Default Range
            endDate: moment()
        },
        function (start, end, label) {
            //$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            //console.log(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));

            $scope.$apply(function () //to reset dropdown
            {
                if (label == "All") {
                    $scope.start_date = null;
                    $scope.end_date = null;
                } else {
                    $scope.start_date = start.format('YYYY-MM-DD');
                    $scope.end_date = end.format('YYYY-MM-DD');
                }

                $scope.sub_label = label;
                $scope.call_grid_refresh();
                //$scope.load_complete=datatables_service.grid_refresh($scope.start_date,$scope.end_date,false, $scope.grid_display_data);
            });

        }
    );


    $scope.catch_id = function (data_id,data_function) {

        if(data_function=="remove_data"){
            var r = confirm("Are you Sure you want to remove this supplier?");
            if (r == true) {
                $scope.mark_boolian(data_id,'is_removed');
            }

        }

    };


    $scope.mark_boolian=function(data_id,update_data){
        var data_set={};
        data_set['data_id']=data_id;
        data_set['boolien_id']=update_data;
        $.ajax({
            url: base_url + "api/http_put/mark_removed",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify(data_set),
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {
                    alert('Data Update Successfully');
                    $scope.load_complete=datatables_service.grid_refresh($scope.start_date,$scope.end_date,false, $scope.grid_display_data);

                } else
                    alert(response['message']);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);

                alert(thrownError + " Save  Failed");


            }
        });
    };

    $scope.catch_id = function (data_id,data_function) {
        $scope.$apply(function () //to reset dropdown
        {
            if(data_function=="mark_clear"){
                $scope.bill_id=data_id;
                $scope.data_available=false;
                $scope.bill_details=[];
                $scope.contract_data=[];
                $scope.contract_number_id='';


                $('#clear_bill_modal').modal('show');
            }
        });
    };

    $scope.validate_data = function (data_col) {

        if(data_col=="supplier"){
            $scope.bill_details['supplier_name']= $scope.contract_data['name']
        }

    };

    $scope.contract_number_id='';
    $scope.invalid_contract_no=false;
    $scope.data_available=false;
    $scope.search_contract_details=function(contract_number)
    {
        // alert($scope.supplier.id);
        $scope.bill_details=[];
        $scope.contract_data=[];
        $scope.invalid_contract_no=false;
        $.ajax({
            url: base_url+"api/http_get/load_contract_and_bill_details",
            type: "POST",
            dataType: 'json',
            data: {"contract_no":contract_number,"bill_id":$scope.bill_id},
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {
                    $scope.$apply(function () //to reset dropdown
                    {
                        $scope.data_available=true;
                        $scope.invalid_contract_no=false;

                        $scope.bill_details_grid =false;


                        $scope.contract_data_grid=[];
                        var data_set=response['data'];
                        $scope.contract_data=data_set['contract_detail'];


                       console.log($scope.contract_data_grid);

                        $scope.bill_details =response['data']['bill_details'];


                        var contract_created_date = new Date( $scope.contract_data.created_date_time);
                        var contract_expire_date = new Date( $scope.contract_data.expire_date_time);
                        var bill_date = new Date( $scope.bill_details.exit_date_time);

                        $scope.date_conflict=true;
                        if(contract_created_date <= bill_date && contract_expire_date >= bill_date){
                            $scope.date_conflict=false;
                        }
                    });
                }

                if (response['code'] == 500) {
                    $scope.$apply(function () //to reset dropdown
                    {
                        $scope.data_available=false;
                        $scope.invalid_contract_no=true;
                    });
                    //alert("Supplier Load Failed");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);

                //alert(thrownError + " Save Failed");
                alert("Server Not Found");


            }
        });
    };

    //$scope.data_set = [];
    $scope.data_set = {form_data: [], selected: {}};

    $scope.add_to_grid = function () {
        $scope.data_set = {form_data: [], selected: {}};

        $scope.data_set.form_data.push({
            supplier_id: $scope.contract_data['supplier_id'],
            contract_no: $scope.contract_data['contract_no'],
            contract_id: $scope.contract_data['contract_id'],
            category_id: $scope.contract_data['category_id'],
            product: $scope.contract_data['category_name'],
            bill_no: $scope.bill_details['bill_no'],
            bill_id: $scope.bill_details['weigh_bill_id'],
            received_date_time: $scope.bill_details['received_date_time'],
            exit_date_time: $scope.bill_details['exit_date_time'],
            truck_no:  $scope.bill_details['truck_no'],
            price:$scope.contract_data['price'],
            first_weight: $scope.bill_details['first_weight'],
            second_weight: $scope.bill_details['second_weight'],
            net_weight: $scope.bill_details['first_weight']-$scope.bill_details['second_weight'],
            wet_weight: 0,
            bad_qty: $scope.bill_details['bad_qty'],
            total_qty:   $scope.bill_details['total_qty'],
            accepted_qty:   $scope.bill_details['total_qty']-$scope.bill_details['bad_qty'],
            w_b_operator: $scope.bill_details['w_b_operator'],
            truck_driver: $scope.bill_details['truck_driver']
        });

       $scope.save_data_grid();

       // console.log($scope.data_set );

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

                        $scope.data_available=false;
                        $scope.bill_details=[];
                        $scope.contract_data=[];
                        $scope.contract_number_id='';

                        $scope.call_grid_refresh();
                        $('#clear_bill_modal').modal('hide');
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

    $scope.grid_refresh = function (start, end, init, filter) {

        var data_set = {};
        var is_succss = true;
        data_set['start_date'] = start;
        data_set['end_date'] = end;
        data_set['filter'] = filter;

        $.ajax({
            url: base_url + ajax_data_function,
            type: "POST",
            dataType: 'json',
            data: JSON.stringify(data_set),
            success: function (response) {
                //$scope.module_datatables_show=true;
                //console.log(response);
                if (response['logged_in'] == true) {
                    var res_data;
                    if (typeof response['data'] !== 'undefined') {
                        res_data = response['data'];
                    } else res_data = 0;

                    //console.log(response);
                    var no_sort_last = false;
                    if (typeof response['no_sort_last'] != 'undefined') {
                        no_sort_last = true;
                    }

                    if (init == true) {

                        //Initialize Datatables (In Custom Functions)
                        var array_column = [];
                        // array_column['class']=[];

                        array_column['title'] = response['title'];
                        if (typeof response['print'] != 'undefined') {
                            array_column['print'] = response['print'];
                        }
                        //array_column['class'][4]='hidden';

                        oTable = datatables_service.init_data_table(data_grid_id, array_column, true, no_sort_last);
                        //End Initialize Datatables (In Custom Functions)

                    }


                    if (oTable != null)oTable.fnClearTable();


                    for (var i = 0; i < res_data.length; i++) {
                        oTable.fnAddData(res_data[i], false);
                    }
                    oTable.fnDraw();


                } else location.reload();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Load Error");
                is_succss = false;
            }

        });

        // table.row.add( [ '1', '2', '3', '4','5','600','700' ] ).draw();
        current_ajax_path = ajax_data_function;
        return is_succss;

    };


    $scope.call_grid_refresh = function () {
        $scope.load_complete = $scope.grid_refresh($scope.start_date, $scope.end_date, false, $scope.grid_display_data);
    };

    $scope.module_datatables_show=true;
    $scope.load_complete=$scope.grid_refresh($scope.start_date,$scope.end_date,true, $scope.grid_display_data);
});