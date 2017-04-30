biziApp.controller('suppliersController', function ($scope,datatables_service) {

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
                    $scope.load_complete=datatables_service.grid_refresh($scope.start_date,$scope.end_date,false);

                } else
                    alert(response['message']);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);

                alert(thrownError + " Save  Failed");


            }
        });
    };

    $scope.module_datatables_show=true;
    $scope.load_complete=datatables_service.grid_refresh($scope.start_date,$scope.end_date,true);
});