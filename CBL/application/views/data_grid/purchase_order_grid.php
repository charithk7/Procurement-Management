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
<div id="paymenmt_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>


                <h4 class="modal-title">Payment Information</h4>



            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group" ><!-- ng-class="{ 'has-error': supplier_name!='' && !supplier_name }" -->
                            <label class="control-label" > Cheque Number</label>
                            <input type="text"  ng-pattern="regexp_pattern" maxlength="20" class="form-control" id="inputError"  ng-model="cheque_number" >
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group" ><!-- ng-class="{ 'has-error': supplier_code!='' && !supplier_code }" -->
                            <label class="control-label" for="inputError">Invoice Number</label>
                            <input type="text" ng-pattern="regexp_pattern" maxlength="20" class="form-control" id="inputError" placeholder="" ng-model="invoice_number">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" ng-disabled="!cheque_number || !invoice_number" ng-click="mark_payed(payment_id)">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="info_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <button id="simplePrint" style="margin-right: 5px;"
                        class="btn btn-md btn-flat btn-default pull-right"><i class="fa fa-print"></i>
                </button>

                <button style="margin-right: 5px;" ng-click="edit_button_click(contract_bill_id)"
                        class="btn btn-md btn-flat btn-default pull-right <?php if($user_role=='user') echo 'hidden';?>"><i class="fa fa-edit"></i>
                </button>


               <!-- <button ng-repeat="i in getNumber(total_pages) track by $index" style="margin-right: 5px;"
                        class="btn btn-md btn-flat btn-default pull-right"><i class="fa fa-print"></i>
                </button>-->
                <div class="dropdown pull-right <?php if($user_role=='user') echo 'hidden';?>" style="margin-right: 5px;">
                    <button  title="Months" class="btn btn-flat btn-default dropdown-toggle"  type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="fa fa-umbrella"></i> {{reduce_rate}}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">

                        <li><a ng-click="reduce_rate='None';info_popup(contract_bill_id,pagination_bills_display_data);" href="">None</a></li>
                        <li><a ng-click="reduce_rate=0.25;info_popup(contract_bill_id,pagination_bills_display_data);" href="">0.25%</a></li>
                        <li><a ng-click="reduce_rate=0.50;info_popup(contract_bill_id,pagination_bills_display_data);" href="">0.50%</a></li>
                        <li><a ng-click="reduce_rate=0.75;info_popup(contract_bill_id,pagination_bills_display_data);" href="">0.75%</a></li>
                        <li><a ng-click="reduce_rate=1.00;info_popup(contract_bill_id,pagination_bills_display_data);" href="">1.00%</a></li>

                        <!--<li role="separator" class="divider"></li>
                        <li><a ng-click="chart_type_select('Top Products')" href="">Top Products</a></li>
                        <li><a ng-click="chart_type_select('Top Categories')" href="">Top Categories</a></li>-->
                    </ul>
                </div>

                <div ng-show="total_bills>1" class="dropdown pull-right" style="margin-right: 5px;">
                    <button  title="Months" class="btn btn-flat btn-default dropdown-toggle"  type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="fa fa-file-text-o"></i> {{pagination_bills_display_data}}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">

                        <!--<li><a ng-click="pagination_bills_display_data='All';info_popup(contract_bill_id,'All');" href="">All</a></li>-->
                        <li ng-repeat="i in bills_details track by $index"><a  ng-click="change_bills_display(i.bill);" href="">{{i.bill}}</a></li>
                    </ul>
                </div>





                <button style="margin-right: 5px;"
                        class="hidden btn btn-md btn-flat btn-default pull-right"><i class="fa fa-file-excel-o"></i>
                </button>

                <h4 class="modal-title">Payment Voucher</h4>



            </div>
            <div id="toPrint" class="modal-body">

                <div class="visible-print">
                    <center>
                        <h5><strong>CBL Cocos(Pvt) Limited</strong><br>
                            No.145, Colombo Road, Alawwa.<br>
                            Tel:037-555-0000 Fax:037-227-8261
                        </h5>
                    </center>
                    <hr>
                    <center>
                        <h3>Payment Voucher For Purchasing {{info_header_string}}
                        </h3>
                    </center>
                    <br>
                </div>

                <table class="table">

                    <tbody ng-repeat="x in info_data_header">
                    <tr>
                        <td><strong>Contract No</strong></td>
                        <td>{{x.contract_no}}</td>
                        <td><strong>Supplier</strong></td>
                        <td>{{x.supplier}}</td>
                    </tr>

                    <tr>
                        <td><strong>Created Date</strong></td>
                        <td>{{x.created_date}}</td>
                        <td><strong>Expire Date</strong></td>
                        <td>{{x.expire_date}}</td>
                    </tr>

                    <tr>
                        <td><strong>Report No</strong></td>
                        <td>{{x.report_number}}</td>
                        <td><strong>Report Date</strong></td>
                        <td>{{today}}</td>
                    </tr>

                    <tr ng-hide="!x.cheque_no">
                        <td><strong>Cheque No</strong></td>
                        <td>{{x.cheque_no}}</td>
                        <td><strong>Invoice Number</strong></td>
                        <td>{{x.invoice_number}}</td>
                    </tr>


                    </tbody>
                </table>

                <br>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Bill</th>
                                <th>Supplier</th>
                                <th>Date & Time</th>
                                <th>Vehicle</th>
                                <th>Quantity</th>
                                <th>Weight (KG)</th>
                                <th>Price (1KG)</th>
                                <th>Total</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="x in info_data_grid" >
                                <td>{{x.bill_no}}</td>
                                <td>{{x.supplier}}</td>
                                <td>{{x.r_date}}</td>
                                <td>{{x.truck_no}}</td>
                                <td>{{x.units}}</td>
                                <td>{{x.weight}}</td>
                                <td>{{x.price | number: 2 }}</td>
                                <td>{{x.total | number: 2 }}</td>

                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><Strong>TOTAL</Strong></td>
                                <td><Strong>{{total_weight }}</Strong></td>
                                <td><Strong>{{total_price | number: 2}}</Strong></td>
                                <td><Strong>{{total_all | number: 2}}</Strong></td>
                            </tr>
                            </tfoot>
                        </table>

                <div class="visible-print">
                    <br><br>
                    <div class="row">
                        <div class="col-xs-3">
                            <center>
                                <p>
                                    ......................................<br>
                                    Created By
                                </p>
                            </center>

                        </div>
                        <div class="col-xs-3">
                            <center>
                                <p>
                                    ......................................<br>
                                    Checked By
                                </p>
                            </center>
                        </div>
                        <div class="col-xs-3">
                            <center>
                                <p>
                                    ......................................<br>
                                    Approved By
                                </p>
                            </center>
                        </div>
                        <div class="col-xs-3">
                            <center>
                                <p>
                                    ......................................<br>
                                    Finance
                                </p>
                            </center>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
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

            <li><a ng-click="grid_display_data='Active';call_grid_refresh();" href="">Active</a></li>
            <li><a ng-click="grid_display_data='To Be Payed';call_grid_refresh();" href="">To Be Payed</a></li>
            <li><a ng-click="grid_display_data='Completed';call_grid_refresh();" href="">Completed</a></li>


            <!--<li role="separator" class="divider"></li>
            <li><a ng-click="chart_type_select('Top Products')" href="">Top Products</a></li>
            <li><a ng-click="chart_type_select('Top Categories')" href="">Top Categories</a></li>-->
        </ul>
    </div>
</div>

<script>
    //Initialize Print
    $("#simplePrint").click(function () {

        $("#toPrint").printThis({
            debug: false,              // show the iframe for debugging
            importCSS: true,           // import page CSS
            printContainer: true,      // grab outer container as well as the contents of the selector
            //loadCSS: "path/to/my.css", // path to additional css file
            //pageTitle: "<?php //echo $company_name; ?> - <?php //echo ucfirst(str_replace('_', ' ', $page_name)); ?>",             // add title to print page
            removeInline: false        // remove all inline styles from print elements
        });

    });

</script>