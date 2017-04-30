<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hawk
 * Date: 9/11/2016
 * Time: 11:00 AM
 */
?>



<!-- Modal -->
<div id="info_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <button id="simplePrint" style="margin-right: 5px;"
                        class="hidden btn btn-md btn-flat btn-default pull-right"><i class="fa fa-print"></i>
                </button>

                <button style="margin-right: 5px;"
                        class="hidden btn btn-md btn-flat btn-default pull-right"><i class="fa fa-file-excel-o"></i>
                </button>

                <button style="margin-right: 5px;" ng-click="enable_edit=true"
                        class="btn btn-md btn-flat btn-default pull-right <?php if($user_role=='user') echo 'hidden';?>"><i class="fa fa-edit"></i>
                </button>

                <h4 class="modal-title">Bill Details</h4>



            </div>
            <div id="toPrint" class="modal-body">

                <div class="visible-print">
                    <center><h2>Bill Details</h2></center>
                    <br>
                </div>

                <table class="table">

                    <tbody>
                    <tr>
                        <td><strong>Contract No</strong></td>
                        <td>{{info_data.contract_no}}</td>
                        <td><strong>Supplier</strong></td>
                        <td>{{info_data.supplier}}</td>
                    </tr>

                    <tr>
                        <td><strong>Arrival</strong></td>
                        <td>{{info_data.received_date_time}}</td>
                        <td><strong>Exit</strong></td>
                        <td>{{info_data.exit_date_time}}</td>
                    </tr>

                    <tr>
                        <td><strong>Bill No</strong></td>
                        <td>{{info_data.bill_no}}</td>
                        <td><strong>Product</strong></td>
                        <td>{{info_data.product}}</td>
                    </tr>

                    <tr>
                        <td><strong>Vehicle</strong></td>
                        <td>{{info_data.truck_no}}</td>
                        <td><strong>Driver</strong></td>
                        <td>{{info_data.truck_driver}}</td>
                    </tr>

                    <tr>
                        <td><strong>First Weight</strong></td>
                        <td>
                            <div ng-show="enable_edit" class="form-group" ng-class="txt_second_weight>txt_first_weight ? 'has-error' : 'has-success'">
                                <input type="number"  class="form-control input-sm" ng-model="txt_first_weight"/>
                            </div>
                            <span ng-hide="enable_edit">{{info_data.first_weight}}</span>
                        </td>
                        <td><strong>Second Weight</strong></td>
                        <td>
                            <div ng-show="enable_edit" class="form-group" ng-class="txt_second_weight>txt_first_weight ? 'has-error' : 'has-success'">
                                <input type="number" class="form-control input-sm"  ng-model="txt_second_weight"/>
                            </div>
                            <span ng-hide="enable_edit">{{info_data.second_weight}}</span>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>1Kg Price</strong></td>
                        <td>
                            <div ng-show="enable_edit" class="form-group" ng-class="!txt_kg_price ? 'has-error' : 'has-success'">
                                <input type="number" class="form-control input-sm"  ng-model="txt_kg_price">
                            </div>
                            <span ng-hide="enable_edit">{{info_data.price}}</span>
                        </td>
                        <td><strong>Net Weight</strong></td>
                        <td>
                            <span ng-hide="enable_edit">{{info_data.net_weight}}</span>
                            <span ng-show="enable_edit">{{txt_first_weight-txt_second_weight}}</span>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Total Qty</strong></td>
                        <td>
                            <div ng-show="enable_edit" class="form-group" ng-class="txt_total_qty<txt_bad_qty ? 'has-error' : 'has-success'">
                                <input type="number"  class="form-control input-sm"  ng-model="txt_total_qty">
                            </div>
                            <span ng-hide="enable_edit">{{info_data.total_qty}}</span>
                        </td>
                        <td><strong>Bad Qty</strong></td>
                        <td>
                            <div ng-show="enable_edit" class="form-group" ng-class="txt_bad_qty>txt_total_qty ? 'has-error' : 'has-success'">
                                <input type="number"  class="form-control input-sm"  ng-model="txt_bad_qty">
                            </div>
                            <span ng-hide="enable_edit">{{info_data.bad_qty}}</span>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Accepted Qty</strong></td>
                        <td>{{txt_total_qty-txt_bad_qty}}</td>
                        <td><strong>TOTAL</strong></td>
                        <td><strong>{{info_data.total}}</strong></td>
                    </tr>

                    </tbody>
                </table>




            </div>
            <div class="modal-footer">
                <button ng-show="enable_edit"
                        type="button" class="btn btn-danger"
                        ng-disabled="
                        !txt_kg_price ||
                        !txt_first_weight ||
                        !txt_second_weight ||
                        !txt_total_qty ||
                        !txt_bad_qty ||
                        txt_total_qty<txt_bad_qty ||
                        txt_second_weight>txt_first_weight"
                        ng-click="edit_grn_info(edit_data_id)">Update
                </button>
                <button ng-show="enable_edit" type="button" class="btn btn-warning" ng-click="enable_edit=false">Cancel</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>

    </div>
</div>


