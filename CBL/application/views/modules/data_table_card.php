<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hawk
 * Date: 6/16/2016
 * Time: 12:03 PM
 */

if(isset($data_table_id) && $data_table_id!='') $table_id= $data_table_id; else $table_id= $page_location.'_data_grid';
if(isset($table_hidden_class) && $table_hidden_class!='') $ng_show= $table_hidden_class; else $ng_show='module_datatables_show';
if(isset($ajax_data_function) && $ajax_data_function!='') $ajax_source= $ajax_data_function; else $ajax_source=strtolower( $page_class_name).'_load/get_'.$page_location.'_grid';

?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#custom_buttons').html($("#custom_buttons_template").html());
    });
</script>

<!-- Main content -->
<section  class="content" ng-show="<?php echo $ng_show; ?>">
        <!-- Small boxes (Start box) -->
        <div class="row" >
            <div class="col-xs-12">
                <div class="box <?php echo $table_card_color; ?>">
                    <div class="box-header">
                        <i class="<?php echo $table_card_icon; ?>"></i>
                        <h3 class="box-title"> <?php echo $table_card_title; ?></h3>

                        <?php if(isset($add_button_function)){ ?>
                            <button style="margin-left: 5px;"  class="btn btn-primary btn-flat pull-right" ng-click="<?php echo $add_button_function; ?>"><i class="fa fa-plus"></i> Add</button>
                        <?php } ?>

                        <?php if(isset($add_button_link)){ ?>
                            <a style="margin-left: 5px;" href="<?php echo $add_button_link; ?>" class="btn btn-primary btn-flat pull-right"><i class="fa fa-plus"></i> Add</a>
                        <?php } ?>

                        <!--
                        <div id="custom_buttons_template" class="hidden" ></div>
                        Custom Data Will Be copied from this "custom_buttons_template" DIV to "custom_buttons" DIV Use this on another Html Template out of the module
                        -->

                        <?php if(!isset($hide_date_range_button) || $hide_date_range_button==''){ ?>
                        <div class="btn-group pull-right">
                            <div ng-hide="hide_date_range_button" class="dropdown pull-right">
                                <div class="input-group">
                                    <button class="btn  btn-flat btn-default pull-right" id="daterange-btn">
                                        <i class="fa fa-calendar"></i> <span ng-bind="sub_label"></span>
                                        <span class="caret"></span>
                                    </button>
                                </div>
                            </div>
                            <div  id="custom_buttons" class="pull-right"> </div>
                        </div>
                        <?php } ?>
                        <!--<button class="btn btn-primary pull-right" ng-click="showme = true"><i class="fa fa-plus"></i> Add</button>-->




                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <table id="<?php echo $table_id; ?>" class="table table-hover table-bordered data-grid table-condensed">

                        </table>

                        <?php if(!isset($data_table_id ) || $data_table_id=='') { ?>
                        <script>
                            var data_grid_id="#<?php echo $page_location; ?>_data_grid";
                            var ajax_data_function="<?php echo $ajax_source; ?>";
                        </script>
                        <?php } ?>

                    </div><!-- /.box-body -->
                    <div class="tabel-loading overlay" ng-hide="load_complete"> <!--Loading GIF-->
                        <i class="fa fa-refresh fa-spin"></i>
                    </div><!--/.Loading GIF-->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

</section><!-- /.content -->




