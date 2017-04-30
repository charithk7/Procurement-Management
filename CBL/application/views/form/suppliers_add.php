
    <section class="content">




                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <i class="fa fa-cart-arrow-down"></i>
                                <h3 class="box-title">Add Suppliers</h3> 
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
                                        <div class="form-group" ng-class="{ 'has-error': supplier_name!='' && !supplier_name }">
                                            <label class="control-label" for="inputError"> Name</label>
                                            <input type="text"  ng-pattern="regexp_pattern" maxlength="50" class="form-control" id="inputError" placeholder="Enter Supplire Name" ng-model="supplier_name" >
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-12">
                                        <div class="form-group" ng-class="{ 'has-error': supplier_code!='' && !supplier_code }">
                                            <label class="control-label" for="inputError">Code </label>
                                            <input type="text" ng-pattern="regexp_pattern" maxlength="45" class="form-control" id="inputError" placeholder="" ng-model="supplier_code">
                                        </div>
                                    </div>

                                    <!--<div class="col-lg-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label" for="inputError">Phone</label>
                                            <input type="number" min="0" max="999999999" class="form-control" id="inputError" placeholder="Enter Phone" ng-model="supplier_TP">
                                        </div>

                                    </div>-->
                                    <div class="col-lg-4 col-xs-6">
                                        <!-- phone mask -->
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input type="text" ng-model="supplier_TP" ng-pattern="regexp_pattern"  maxlength="60" placeholder="Enter Phone (Optional)" class="form-control" >
                                            </div><!-- /.input group -->
                                        </div><!-- /.form group -->
                                    </div>
                                    <div class="col-lg-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label" for="inputError">Account No</label>
                                            <input type="text" class="form-control" ng-pattern="regexp_pattern"  maxlength="20" placeholder="Enter Account No" ng-model="supplier_account">
                                        </div>

                                    </div>

                                    <div class="col-lg-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputError">Street 1</label>
                                            <input type="text" class="form-control" ng-pattern="regexp_pattern"  maxlength="50" placeholder="Enter Address " ng-model="street1">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputError">Street 2 (Optional)</label>
                                            <input type="text" class="form-control" ng-pattern="regexp_pattern"  maxlength="50" placeholder="Enter Address " ng-model="street2">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputError">City </label>
                                            <input type="text" class="form-control" ng-pattern="regexp_pattern"  maxlength="45" placeholder="Enter City" ng-model="supplier_city">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputError">Province/State (Optional)</label>
                                            <input type="text" class="form-control" ng-pattern="regexp_pattern"  maxlength="30" placeholder="Enter State " ng-model="province">
                                        </div>
                                    </div>
                                    <div class="hidden col-lg-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputError">Zip/Postal Code (Optional)</label>
                                            <input type="text" class="form-control" ng-pattern="regexp_pattern"  maxlength="10" placeholder="Enter Postal Code " ng-model="postal_code">
                                        </div>
                                    </div>




                                </div><!-- /.row -->

                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <!--Change this line-->

                                <button class="btn btn-primary " ng-disabled="!supplier_name || !supplier_code " id="add_supplier" ng-hide="edit_mode_enabled" ng-click="add_to_grid()"><i class="fa fa-plus"></i> Add</button>
                                <button class="btn btn-primary " ng-disabled="!supplier_name || !supplier_code " id="update_supplier" ng-show="edit_mode_enabled" ng-click="update_data()"><i class="fa fa-plus"></i> Update</button>
                                <!--/.Change this line-->
                                <a style="margin-left: 5px;" href="#suppliers" class="btn btn-warning"><i class="fa fa-remove"></i> Cancel</a>

                                <a style="display:none;" href="<?php echo base_url(); ?>inventory/add_model" class="btn btn-info pull-right"><i class="fa fa-edit"></i> Item Info</a>
                            </div><!-- box-footer -->
                        </div><!-- /.box -->
                    </div>
                </div><!-- /.row -->


<div ng-hide="edit_mode_enabled">

                <div class="row" id="item-grid-add-inventory" ng-show="data_set.form_data.length >= 1" ng-hide="data_set.form_data.length < 1" >
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
                                            <th><span >Name</span></th>
                                            <th><span >Code</span></th>
                                            <th><span >Address</span></th>
                                            <th><span >Phone</span></th>
                                            <th><span >Account</span></th>
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
                                    <td>{{show_supplier.street1+' ' +show_supplier.street2 +' '+show_supplier.supplier_city +' '+show_supplier.province+' '+show_supplier.postal_code }}</td>
                                    <td>{{show_supplier.phone}}</td>
                                    <td>{{show_supplier.supplier_account }}</td>
                                    <td>
                                    <div class="tools" >
                                    <span ng-click="editItem(show_supplier)" class="hidden btn-link hidden-xs" style="cursor: pointer;"> <i class="fa fa-edit"></i></span>
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

</div>


    </section><!-- /.content -->







