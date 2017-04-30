biziApp.controller('note_grnController', function ($scope,datatables_service) {


    //Default Dates
    var default_start_date=moment().subtract(29, 'days');
    var default_end_date=moment();

    $scope.start_date = default_start_date.format('YYYY-MM-DD');
    $scope.end_date = default_end_date.format('YYYY-MM-DD');
    $scope.sub_label = 'Last 30 Days';

    $scope.grid_display_data = 'Active';
    $scope.hide_date_range_button=false;

    $scope.txt_first_weight=0;
    $scope.txt_second_weight=0;
    $scope.txt_kg_price=0;
    $scope.txt_total_qty=0;
    $scope.txt_bad_qty=0;

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
                //$scope.call_grid_refresh();
                $scope.load_complete=datatables_service.grid_refresh($scope.start_date,$scope.end_date,false);
            });

        }
    );

    $scope.catch_id = function (data_id,data_function) {
        if (data_function == "info_popup") {
            $scope.get_grn_info(data_id);
        }
    };

    $scope.get_grn_info=function(data_id)
    {
        var data_set={};
        data_set['data_id']=data_id;

        $.ajax({
            url: base_url+"api/http_get/load_grn_details",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify(data_set),
            success: function (response) {
                //console.log(response);
                if (response['code'] == 201) {

                    $scope.info_data=[];



                    $scope.enable_edit=false;
                    $scope.edit_data_id=data_id;

                    $scope.$apply(function () //to reset dropdown
                    {
                        $scope.info_data=response['data'];
                        $scope.txt_first_weight=parseInt(response['data']['first_weight']);
                        $scope.txt_second_weight=parseInt(response['data']['second_weight']);
                        $scope.txt_kg_price=parseInt(response['data']['price']);
                        $scope.txt_total_qty=parseInt(response['data']['total_qty']);
                        $scope.txt_bad_qty=parseInt(response['data']['bad_qty']);

                        $('#info_modal').modal('show');
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

    $scope.edit_grn_info=function(data_id)
    {

        $scope.data_set = {form_data: [], selected: {}};

        $scope.data_set.form_data.push({
            first_weight: $scope.txt_first_weight,
            second_weight:  $scope.txt_second_weight,
            price: $scope.txt_kg_price,
            total_qty: $scope.txt_total_qty,
            bad_qty: $scope.txt_bad_qty,
            data_id: data_id
        });


        $.ajax({
            url: base_url+"api/http_put/edit_bill_data",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify($scope.data_set),
            success: function (response) {
                //console.log(response);
                if (response['code'] == 201) {
                    $scope.get_grn_info(data_id);
                    $scope.load_complete=datatables_service.grid_refresh($scope.start_date,$scope.end_date,false);
                }

                if (response['code'] == 500) {
                    alert("Update Failed");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);

                //alert(thrownError + " Save Failed");
                alert("Server Not Found");


            }
        });
    };

    $scope.module_datatables_show=true;
    $scope.load_complete=datatables_service.grid_refresh($scope.start_date,$scope.end_date,true);
});