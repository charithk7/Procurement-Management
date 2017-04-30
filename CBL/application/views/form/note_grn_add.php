
    <section class="content">




                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <i class="fa fa-cart-arrow-down"></i>
                                <h3 class="box-title">Received Goods</h3>



                                <div class="box-tools pull-right">
                                    <!-- Buttons, labels, and many other things can be placed here! -->
                                    <!-- Here is a label for example -->
                                    <!--<span class="label label-primary">Item {{temp.length }}</span>-->
                                    <!-- This will cause the box to collapse when clicked -->



                                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">


                                    <div class="col-lg-4 col-xs-12">
                                        <div class="form-group" >
                                            <label class="control-label" for="inputError">Supplier</label>
                                            <select class="form-control" id="sel1" ng-model="supplier" ng-options="x.name for x in suppliers track by x.id" ng-change="get_contract_details()">
                                                <option value=""  disabled selected>-- Select --</option>

                                            </select>
                                        </div>
                                    </div>



                                    <div ng-hide="!contract_data_grid" class="col-lg-12 col-xs-12">
                                        <label class="control-label" for="inputError">Active Contract</label>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Supplier</th>
                                                <th>Product</th>
                                                <th>Created Date</th>
                                                <th>Expire Date</th>
                                                <th>Supply</th>
                                                <th>Price(1KG)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="x in contract_data_grid" >
                                                <td>{{x.contract_no}}</td>
                                                <td>{{x.name}} - {{x.code}}</td>
                                                <td>{{x.category_name}}</td>
                                                <td>{{x.created_date_time}}</td>
                                                <td>{{x.expire_date_time}}</td>
                                                <td>
                                                <span ng-hide="x.total_weight==0">{{x.total_weight}} KG</span>
                                                <span ng-hide="x.total_qty==0">{{x.total_qty}} QTY</span>
                                                </td>
                                                <td>{{x.price}}</td>
                                            </tr>
                                            </tbody>

                                        </table>
                                    </div>

                                </div><!-- /.row -->

                                <div ng-hide="!contract_data_grid"  class="row">
                                    <hr><br>
                                <div class="col-lg-4 col-xs-12">
                                        <div class="form-group" >
                                            <label class="control-label" for="inputError">Bill No</label>
                                            <select class="form-control" id="bill_no" ng-model="bill_no" ng-options="x.name for x in bill_numbers track by x.id" ng-change="get_bill_details()" >
                                                <option value=""  disabled selected>-- Select --</option>

                                            </select>
                                        </div>
                                    </div>



                                    <div ng-hide="!bill_details_grid">
                                        <div  class="col-lg-4 col-xs-12">
                                            <div class="form-group" ng-class="bill_supplier_name!=contract_supplier_name? 'has-error' : 'has-success'" >
                                                <label class="control-label" for="inputError">Supplier Name</label>
                                                <input type="text" ng-pattern="regexp_pattern" maxlength="50" class="form-control"  placeholder="" ng-model="bill_supplier_name">
                                            </div>
                                        </div>

                                        <div  class="col-lg-4 col-xs-12">
                                            <div class="form-group" ng-class="bill_supplier_code!=contract_supplier_code? 'has-error' : 'has-success'">
                                                <label class="control-label" for="inputError">Supplier Code</label>
                                                <input type="text" ng-pattern="regexp_pattern" maxlength="45" class="form-control" placeholder="" ng-model="bill_supplier_code">
                                            </div>
                                        </div>

                                        <div  class="col-lg-4 col-xs-12">
                                            <div class="form-group" ng-class="bill_product!=category_name? 'has-error' : 'has-success'">
                                                <label class="control-label" for="inputError">Product</label>
                                                <input type="text" class="form-control"  ng-pattern="regexp_pattern"  maxlength="50" placeholder="" ng-model="bill_product">
                                            </div>
                                        </div>

                                        <div ng-show="category_id==1">



                                            <div  class="col-lg-4 col-xs-12">
                                                <div class="form-group" >
                                                    <label class="control-label" for="inputError">Total Qty</label>
                                                    <input type="text" ng-pattern="only_numbers" maxlength="11" class="form-control"  placeholder="" ng-model="contract_total_qty">
                                                </div>
                                            </div>

                                            <div  class="col-lg-4 col-xs-12">
                                                <div class="form-group" >
                                                    <label class="control-label" for="inputError">Bad Qty</label>
                                                    <input type="text" ng-pattern="only_numbers" maxlength="11" class="form-control"  placeholder="" ng-model="contract_bad_qty">
                                                </div>
                                            </div>


                                        </div>

                                    </div>

                                    <div ng-hide="!bill_details_grid" class="col-lg-12 col-xs-12">
                                        <label class="control-label" for="inputError">Weigh Bill Details</label>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Product</th>
                                                <th>Arrival</th>
                                                <th>Exit</th>
                                                <th>Vehicle</th>
                                                <th>Weight</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="x in bill_details_grid" >
                                                <td>{{x.bill_no}}</td>
                                                <td ng-class="bill_product!=category_name? 'text-danger' : 'text-success'">{{x.product}}</td>
                                                <td>{{x.received_date_time}}</td>
                                                <td>{{x.exit_date_time}}</td>
                                                <td>{{x.truck_no}}</td>
                                                <td>{{x.first_weight-x.second_weight }}</td>
                                            </tr>
                                            </tbody>

                                        </table>
                                    </div>


                                    <!--<div class="col-lg-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label" for="inputError">Phone</label>
                                            <input type="number" min="0" max="999999999" class="form-control" id="inputError" placeholder="Enter Phone" ng-model="supplier_TP">
                                        </div>

                                    </div>-->




                                </div><!-- /.row -->



                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <!--Change this line-->

                                <button ng-disabled="bill_supplier_name!=contract_supplier_name || bill_supplier_code!=contract_supplier_code || bill_product!=category_name" class="btn btn-primary " id="add_supplier" ng-hide="edit_mode_enabled" ng-click="add_to_grid()"><i class="fa fa-plus"></i> Add</button>
                                <!--/.Change this line-->

                                <a style="margin-left: 5px;" href="#note_grn" class="btn btn-warning"><i class="fa fa-remove"></i> Cancel</a>

                                <a style="display:none;" href="<?php echo base_url(); ?>inventory/add_model" class="btn btn-info pull-right"><i class="fa fa-edit"></i> Item Info</a>
                            </div><!-- box-footer -->
                        </div><!-- /.box -->
                    </div>
                </div><!-- /.row -->




                <div class="row hidden" id="item-grid-add-inventory" ng-show="data_set.form_data.length >= 1" ng-hide="data_set.form_data.length < 1" >
                    <div class="col-lg-12 col-xs-12">

                        <div class="box box-success" >
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Data List</h3>
                                <div class="box-tools pull-right">
                                    <span class="label label-primary">{{data_set.form_data.length}} Items</span>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">


                                <table class="table table-hover table-responsive data-grid">

                                    <thead>
                                        <tr>
                                            <th style="width:10px;">#</th>
                                            <th><span >Supplier</span></th>
                                            <th><span >Date</span></th>
                                            <th><span >No Of Units</span></th>
                                            <th><span >Unit Price</span></th>
                                            <th style="width: 50px;"></th>
                                        <tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="show_supplier in grid_show" ng-include="getTemplate(show_supplier)">
                                        </tr>
                                    </tbody>
                                </table>

                                <!--Tabel Data build-->
                                <script type="text/ng-template" id="display">
                                    <td>{{ $index+indexStartNo+1}}</td>
                                    <td>{{show_supplier.supplier_name}}</td>
                                    <td>{{show_supplier.supplier_code}}</td>
                                    <td>{{show_supplier.street1+' ' +show_supplier.street2}}</td>
                                    <td>{{show_supplier.supplier_city }}</td>

                                    <td>
                                    <div class="tools" >
                                    <span ng-click="editItem(show_supplier)" class="btn-link hidden-xs" style="cursor: pointer;"> <i class="fa fa-edit"></i></span>
                                    &nbsp;
                                    <span class="btn-link" style="cursor: pointer;" data-ng-click="removeItem(grid_show.indexOf(show_supplier))" ><i class="fa fa-trash-o"></i></span>
                                    </div>
                                    </td>
                                </script>
                                <script type="text/ng-template" id="edit">
                                    <td>{{ $index+indexStartNo+1}}</td>
                                    <td><input type="text" ng-model="data_set.selected.supplier_name" /></td>

                                    <td>{{ data_set.selected.supplier_code }}</td>
                                    <td><input type="text" ng-model="data_set.selected.address" /></td>
                                    <td><input type="text" ng-model="data_set.selected.supplier_city" /></td>
                                    <td><input readonly type="text" ng-model="data_set.selected.phone" /></td>
                                    <td><input readonly type="email" ng-model="data_set.selected.email" /></td>

                                    <td>
                                    <div class="tools-expand">
                                    <span ng-click="saveItem(grid_show.indexOf(show_supplier))" class="btn-link " style="cursor: pointer;"> <i class="fa fa-floppy-o"></i></span>
                                    &nbsp;
                                    <span ng-click="reset()" class="btn-link" style="cursor: pointer;" ><i class="fa fa-remove"></i></span>
                                    </div>
                                    </td>
                                </script>
                                <!--/Table Data build-->
                            </div><!-- /.box-body -->
                            <div class="box-footer clearfix no-border">





                                <div class="box-tools pull-right">
                                    <!--<ul class="pagination pagination-sm inline" >
                                      <li><a href="#">&laquo;</a></li>
                                      <li><a href="#">1</a></li>
                                      <li><a href="#">2</a></li>
                                      <li><a href="#">3</a></li>
                                      <li><a href="#">&raquo;</a></li>
                                    </ul>-->
                                    <div id="pagination_add" ng-show="data_set.form_data.length > 10" ng-hide="data_set.form_data.length <= 10">
                                        <pagination class="pagination pagination-sm inline"
                                                    total-items="data_set.form_data.length"
                                                    max-size="maxSize"
                                                    boundary-links="False"
                                                    first-text="First"
                                                    previous-text="Previous"
                                                    next-text="Next"
                                                    last-text="Last"
                                                    ng-model="currentPage">
                                        </pagination>
                                    </div>
                                </div>

                                <div class="visible-xs"><br><hr></div>
                                <button class="btn btn-success " id="save_data_grid" ng-disabled="save_btn_disabled" ng-click="save_btn_disabled=true;save_data_grid()"><i class="fa fa-floppy-o"></i> Save</button>
                                <button class="btn btn-danger " ng-click="clearItems()"><i class="fa fa-trash"></i> Clear</button>


                            </div><!-- /.box-footer -->
                        </div><!-- /.box -->
                        <div class="hidden overlay"> <!--Loading GIF-->
                            <i class="fa fa-refresh fa-spin"></i>
                        </div><!--/.Loading GIF-->
                    </div><!-- /.col -->
                </div><!-- /.row -->




    </section><!-- /.content -->







