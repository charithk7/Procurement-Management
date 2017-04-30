biziApp.controller('purchase_orderController', function ($scope,$location,datatables_service) {

    //Default Dates
    var default_start_date=moment().subtract(29, 'days');
    var default_end_date=moment();

    $scope.start_date = default_start_date.format('YYYY-MM-DD');
    $scope.end_date = default_end_date.format('YYYY-MM-DD');
    $scope.sub_label = 'Last 30 Days';

    $scope.today = server_date_formatted;

    $scope.grid_display_data = 'Active';
    $scope.hide_date_range_button=false;

    $scope.total_pages=0;

    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 14 Days': [moment().subtract(15, 'days'), moment()],
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
            });

        }
    );

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



    $scope.catch_id = function (data_id,data_function) {
       if(data_function=="info_popup"){
           $scope.info_popup(data_id,'All');
           $scope.reduce_rate='None';
       }

       if(data_function=="mark_payed"){
           /*var r = confirm("Are you Sure you want to mark this contract as payed?");
           if (r == true) {
               $scope.mark_payed(data_id);
           }*/
           $scope.cheque_number='';
           $scope.invoice_number='';
           $scope.payment_id=data_id;
           $('#paymenmt_modal').modal('show');

       }
       if(data_function=="disable_data"){
           var r = confirm("Are you Sure you want to disable the contract?");
           if (r == true) {
               $scope.mark_boolian(data_id,'is_disabled');
           }

       }

        if(data_function=="mark_complete"){
            var r = confirm("Are you Sure you want to complete this contract?");
            if (r == true) {
                $scope.mark_boolian(data_id,'is_complete');
            }

        }
    };

    $scope.info_data_grid=[];

    $scope.mark_payed=function(data_id){
        var data_set={};
        data_set['data_id']=data_id;
        data_set['cheque_number']= $scope.cheque_number;
        data_set['invoice_number']= $scope.invoice_number;

        $.ajax({
            url: base_url + "api/http_put/payment_info",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify(data_set),
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {
                    alert('Data Update Successfully');
                    $scope.call_grid_refresh();
                    $('#paymenmt_modal').modal('hide');
                } else
                    alert(response['message']);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);

                alert(thrownError + " Save  Failed");


            }
        });
    };

    $scope.mark_boolian=function(data_id,update_data){
        var data_set={};
        data_set['data_id']=data_id;
        data_set['boolien_id']=update_data;
        $.ajax({
            url: base_url + "api/http_put/mark_payed",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify(data_set),
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {
                    alert('Data Update Successfully');
                    $scope.call_grid_refresh();

                } else
                    alert(response['message']);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);

                alert(thrownError + " Save  Failed");


            }
        });
    };

    $scope.edit_button_click=function(data_id){
        $('#info_modal').modal('hide');
        var r = confirm("WARNING : This Contract Has Active Bills, Are you sure you want to continue?");
        if (r == true) {
            $location.path('purchase_order_add/amend/'+data_id);
        }
    };

    $scope.contract_bill_id="";
    $scope.pagination_bills_display_data='All';
    $scope.reduce_rate='None';

    $scope.info_popup=function(data_id,bill_no){

        $scope.contract_bill_id=data_id;
        var data_set={};
        data_set['data_id']=data_id;
        data_set['bill_no']=bill_no;


        $scope.pagination_bills_display_data=bill_no;
        $.ajax({
            url: base_url + "api/http_get/load_payment_voucher",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify(data_set),
            success: function (response) {
                console.log(response);
                if (response['code'] == 201) {
                    //alert(response['message']);
                    $scope.$apply(function () //to reset dropdown
                    {


                        $scope.info_data_grid=response['data'];
                        $scope.info_data_header=response['data_header'];

                        console.log($scope.info_data_header);
                        if($scope.info_data_header[0]['category_id']==2){
                            $scope.info_header_string="Firewood";
                        }else {
                            $scope.info_header_string="Coconut";

                        }

                        //$scope.reduce_rate=0.25;
                        if($scope.reduce_rate!='None'){
                            $scope.total_weight_percent=(response['data_total']['total_weight']*$scope.reduce_rate)/100;
                            $scope.total_weight=response['data_total']['total_weight']-$scope.total_weight_percent +' (-'+$scope.reduce_rate+'%)';

                            $scope.total_price=response['data_total']['total_price'];
                            $scope.total_all=(response['data_total']['total_weight']-$scope.total_weight_percent) * response['data_total']['total_price'];
                        }else{
                            $scope.total_weight=response['data_total']['total_weight'];
                            $scope.total_price=response['data_total']['total_price'];
                            $scope.total_all=response['data_total']['total_sum'];
                        }




                        //alert(response['data_total']['no_of_pages']);
                        //.total_pages =response['data_total']['no_of_pages'];
                        $scope.total_bills =response['data_total']['no_of_bills'];

                        $scope.bills_details =response['data_total']['all_bills'];

                        /* for(var x=1;x<=response['data_total']['no_of_pages'];x++){
                             alert(x);
                         }*/
                        $('#info_modal').modal('show');
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

    $scope.change_bills_display=function(bill_no){

        if(bill_no=='All'){
            //$scope.info_popup( $scope.contract_bill_id,$scope.pagination_display_data);

            $scope.info_popup( $scope.contract_bill_id,'');
            $scope.pagination_bills_display_data='All'

        }else{
            //$scope.pagination_bills_display_data='All';
            //$scope.pagination_bills_display_data=bill_no;
            $scope.info_popup( $scope.contract_bill_id,bill_no);

        }

    };

    $scope.module_datatables_show = true;
    $scope.load_complete = $scope.grid_refresh($scope.start_date, $scope.end_date, true, $scope.grid_display_data);

});