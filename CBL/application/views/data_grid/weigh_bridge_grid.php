<?php
/**
 * Created by IntelliJ IDEA.
 * User: Eagle
 * Date: 11/3/2016
 * Time: 2:28 PM
 */

?>

<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hawk
 * Date: 9/11/2016
 * Time: 11:00 AM
 */
?>


<section class="hidden content-header">
    <h1>
        Contracts
        <small class="hidden">Received Goods</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Purchase Orders</li>
    </ol>
</section>

<!-- Modal -->
<div id="clear_bill_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>


                <h4 class="modal-title">Clear Bill</h4>



            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group" ng-class="invalid_contract_no? 'has-error' : ''"><!--ng-class="invalid_contract_no? 'has-error' : 'has-success'"-->
                        <label class="control-label" for="inputError">Contract ID</label>
                        <div class="input-group" >

                                <input type="text" class="form-control" placeholder="" ng-model="contract_number_id">
                                <span class="input-group-btn">
                                <button class="btn btn-default btn-flat" ng-disabled="!contract_number_id" type="button" ng-click="search_contract_details(contract_number_id)">Find</button>
                              </span>
                        </div>
                        </div>
                    </div>

                    <div ng-show="data_available" class="col-xs-12">

                        <!--<label class="control-label" for="inputError">Active Contract</label>-->
                        <table class="table table-bordered">

                            <thead>
                            <tr>
                                <th></th>
                                <th>Contract</th>
                                <th>Bill</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr class="text-primary">
                                <td><strong>ID</strong></td>
                                <td>{{contract_data.contract_no}}</td>
                                <td>{{bill_details.bill_no}}</td>

                            </tr>
                            <tr ng-class="contract_data.name!=bill_details.supplier_name? 'text-danger' : 'text-success'">
                                <td><strong>Supplier</strong>
                                <td>{{contract_data.name}}</td>
                                <td>{{bill_details.supplier_name}}</td>
                                <td>
                                    <button ng-class="contract_data.name!=bill_details.supplier_name? 'btn-warning' : 'btn-success disabled'"
                                            ng-click="bill_details.supplier_name=contract_data.name" class="btn  btn-flat btn-xs" title="Information">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr ng-class="contract_data.code!=bill_details.supplier_code? 'text-danger' : 'text-success'">
                                <td><strong>Supplier Code</strong>
                                <td>{{contract_data.code}}</td>
                                <td>{{bill_details.supplier_code}}</td>
                                <td>
                                    <button ng-class="contract_data.code!=bill_details.supplier_code? 'btn-warning' : 'btn-success disabled'"
                                            ng-click="bill_details.supplier_code=contract_data.code" class="btn  btn-flat btn-xs" title="Information">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr ng-class="contract_data.category_name!=bill_details.product? 'text-danger' : 'text-success'">
                                <td><strong>Supply</strong></td>
                                <td>{{contract_data.category_name}}</td>
                                <td>{{bill_details.product}}</td>
                                <td>
                                    <button ng-class="contract_data.product!=bill_details.category_name? 'btn-warning' : 'btn-success disabled'"
                                            ng-click="bill_details.category_name=contract_data.product" class="btn  btn-flat btn-xs" title="Information">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr ng-class="date_conflict? 'text-danger' : 'text-success'">
                                <td><strong>Date</strong></td>
                                <td>{{contract_data.created_date_time}}</td>
                                <td rowspan="0"><span style="position: relative;top:17px;">{{bill_details.exit_date_time}}</span></td>
                                <td rowspan="0">
                                    <span style="position: relative;top:17px;">
                                         <button ng-class="date_conflict? 'btn-warning' : 'btn-success disabled'"
                                                 ng-click="date_conflict=false" class="btn  btn-flat btn-xs" title="Information">
                                        <i class="fa fa-check"></i>
                                    </button>
                                    </span></td>

                            </tr>
                            <tr ng-class="date_conflict? 'text-danger' : 'text-success'">
                                <td><strong>Expire</strong></td>
                                <td>{{contract_data.expire_date_time}}</td>
                            </tr>


                            </tbody>

                        </table>
                    </div>
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                        ng-disabled="contract_data.name!=bill_details.supplier_name
                            || contract_data.code!=bill_details.supplier_code
                            || contract_data.category_name!=bill_details.product
                            || date_conflict
                            || !data_available
"
                        ng-click="add_to_grid()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<div id="custom_buttons_template" class="hidden" >
    <div class="dropdown pull-right" style="margin-right: 5px;">
        <button class="btn btn-flat btn-default dropdown-toggle"  type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fa fa-line-chart"></i> {{grid_display_data}}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

            <li><a ng-click="grid_display_data='All';call_grid_refresh();hide_date_range_button=false" href="">All</a></li>
            <li><a ng-click="grid_display_data='Cleared';call_grid_refresh();hide_date_range_button=false" href="">Cleared</a></li>
            <li><a ng-click="grid_display_data='Not Cleared';call_grid_refresh();hide_date_range_button=true" href="">Not Cleared</a></li>

            <!--<li role="separator" class="divider"></li>
            <li><a ng-click="chart_type_select('Top Products')" href="">Top Products</a></li>
            <li><a ng-click="chart_type_select('Top Categories')" href="">Top Categories</a></li>-->
        </ul>
    </div>
</div>


