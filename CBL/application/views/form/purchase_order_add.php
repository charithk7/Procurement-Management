
    <section class="content">




                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <i class="fa fa-cart-arrow-down"></i>
                                <h3 class="box-title">Add Contract</h3>
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
                                        <div class="form-group">
                                            <label class="control-label" for="inputError">Available Suppliers</label>
                                            <select ng-disabled="sub_contract_mode_enabled==true || amend_mode_enabled==true" class="form-control" ng-model="array_supplier.select_Supplier" ng-options="x.name for x in suppliers track by x.id" >
                                                <option disabled value="">--Select--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label"  for="inputError">Product</label>
                                            <select ng-disabled="sub_contract_mode_enabled==true" class="form-control" ng-model="array_category.select_category" ng-options="x.name for x in category track by x.id ">
                                                <option disabled value="">--Select--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-12" ng-show="array_category.select_category.id==2">
                                        <div class="form-group">
                                            <label class="control-label"  for="inputError">Total Weight</label>
                                            <input type="text" ng-pattern="only_numbers" maxlength="11" class="form-control" id="inputError" placeholder="" ng-model="total_weight">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-12" ng-show="array_category.select_category.id==1" >
                                        <div class="form-group">
                                            <label class="control-label" for="inputError">No Of Coconuts</label>
                                            <input type="text" ng-pattern="only_numbers" maxlength="11" class="form-control" id="inputError" placeholder="" ng-model="total_units">
                                        </div>
                                    </div>

                                    <!--<div class="col-lg-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label" for="inputError">Phone</label>
                                            <input type="number" min="0" max="999999999" class="form-control" id="inputError" placeholder="Enter Phone" ng-model="supplier_TP">
                                        </div>

                                    </div>-->


                                    <div class="col-lg-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="inputError">1KG Price</label>
                                            <input type="text" ng-pattern="only_decimal" maxlength="13"  class="form-control" placeholder="" ng-model="kg_price">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-12">
                                        <div class="form-group">
                                            <label   class="control-label" for="inputError">Expire Date</label>
                                            <input ng-disabled="sub_contract_mode_enabled==true" type="text" class="form-control"  id="datepicker">
                                        </div>
                                        <script>
                                            $( function() {
                                                //var startDate = moment();
                                                var nf = moment().day("Friday");

                                                if(nf<=moment()){
                                                    var next_day= moment().add(3, 'days');
                                                    nf=next_day.day("Friday");
                                                }else{
                                                    var next_day=nf;
                                                }

                                                var expdate=moment(next_day).format('MM/DD/YYYY');

                                                $( "#datepicker" ).datepicker( "setDate", expdate );
                                                $( "#datepicker" ).datepicker();
                                            });
                                        </script>
                                    </div>

                                </div><!-- /.row -->



                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <!--Change this line-->

                                <button class="btn btn-primary " ng-disabled="!array_supplier.select_Supplier || !array_category.select_category || (!total_weight && !total_units) || !kg_price " id="add_supplier" ng-hide="amend_mode_enabled || sub_contract_mode_enabled"  ng-click="add_to_grid()"><i class="fa fa-plus"></i> Add</button>
                                <button class="btn btn-danger " ng-disabled="!array_supplier.select_Supplier || !array_category.select_category || (!total_weight && !total_units) || !kg_price "  ng-show="amend_mode_enabled"  ng-click="amend_data()"><i class="fa fa-plus"></i> Update</button>
                                <button class="btn btn-info " ng-disabled="!array_supplier.select_Supplier || !array_category.select_category || (!total_weight && !total_units) || !kg_price "  ng-show="sub_contract_mode_enabled==true && amend_mode_enabled==false"  ng-click="amend_data()"><i class="fa fa-plus"></i> Add</button>
                                <!--/.Change this line-->
                                <a style="margin-left: 5px;" href="#purchase_order" class="btn btn-warning "><i class="fa fa-remove"></i> Cancel</a>

                                <a style="display:none;" href="<?php echo base_url(); ?>inventory/add_model" class="btn btn-info pull-right"><i class="fa fa-edit"></i> Item Info</a>
                            </div><!-- box-footer -->
                        </div><!-- /.box -->
                    </div>
                </div><!-- /.row -->



<div ng-hide="hide_data_grid"><!--hide for edit/amend -->
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
                                            <th><span >Supplier</span></th>
                                            <th><span >Expire Date</span></th>
                                            <th><span >Contract</span></th>
                                            <th><span >Price (1KG)</span></th>
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
                                    <td>{{show_supplier.expire_date}}</td>
                                    <td>{{show_supplier.contract_display }}</td>
                                    <td>{{show_supplier.kg_price }}</td>

                                    <td>
                                    <div class="tools" >
                                    <span ng-click="editItem(show_supplier)" class="btn-link hidden" style="cursor: pointer;"> <i class="fa fa-edit"></i></span>
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
                                <button class="btn btn-success " id="save_data_grid"  ng-click="save_btn_disabled=true;save_data_grid()"><i class="fa fa-floppy-o"></i> Save</button>
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







