<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hawk
 * Date: 9/11/2016
 * Time: 11:00 AM
 */
?>


<section class="content-header">
    <h1>
        Suppliers
        <small class="hidden">Received Goods</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Suppliers</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Active Suppliers</h3>

                    <a style="margin-left: 5px;" href="#suppliers_add" class="btn btn-primary btn-flat pull-right"><i class="fa fa-plus"></i> Add</a>

                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Email</th>
                        </tr>
                        <tr>
                            <td>SU001</td>
                            <td>John Doe</td>
                            <td>075-6655432</td>
                            <td>12/10 Address, City</td>
                            <td>email@email.com</td>
                            <td>
                                <button class="btn btn-default btn-flat btn-xs" title="Edit"><i class="fa fa-eraser"></i></button>
                                <button class="btn btn-default btn-flat btn-xs" title="Delete"><i class="fa fa-trash-o"></i></button>
                                <button data-toggle="modal" data-target="#myModal" class="hidden btn btn-info btn-flat btn-xs" title="Information"><i class="fa fa-info"> Info</i></button>

                            </td>
                        </tr>

                        <tr>
                            <td>SU002</td>
                            <td>Tom Hanks</td>
                            <td>077-6225432</td>
                            <td>12/10 Address, City</td>
                            <td>email@email.com</td>
                            <td>
                                <button class="btn btn-default btn-flat btn-xs" title="Edit"><i class="fa fa-eraser"></i></button>
                                <button class="btn btn-default btn-flat btn-xs" title="Delete"><i class="fa fa-trash-o"></i></button>
                                <button data-toggle="modal" data-target="#myModal" class="hidden btn btn-info btn-flat btn-xs" title="Information"><i class="fa fa-info"> Info</i></button>

                            </td>
                        </tr>

                        <tr>
                            <td>SU003</td>
                            <td>Dave Mira</td>
                            <td>072-6335432</td>
                            <td>12/10 Address, City</td>
                            <td>email@email.com</td>
                            <td>
                                <button class="btn btn-default btn-flat btn-xs" title="Edit"><i class="fa fa-eraser"></i></button>
                                <button class="btn btn-default btn-flat btn-xs" title="Delete"><i class="fa fa-trash-o"></i></button>
                                <button data-toggle="modal" data-target="#myModal" class="hidden btn btn-info btn-flat btn-xs" title="Information"><i class="fa fa-info"> Info</i></button>

                            </td>
                        </tr>

                        <tr>
                            <td>SU004</td>
                            <td>Ken Steven</td>
                            <td>071-6655432</td>
                            <td>12/10 Address, City</td>
                            <td>email@email.com</td>
                            <td>
                                <button class="btn btn-default btn-flat btn-xs" title="Edit"><i class="fa fa-eraser"></i></button>
                                <button class="btn btn-default btn-flat btn-xs" title="Delete"><i class="fa fa-trash-o"></i></button>
                                <button data-toggle="modal" data-target="#myModal" class="hidden btn btn-info btn-flat btn-xs" title="Information"><i class="fa fa-info"> Info</i></button>

                            </td>
                        </tr>

                        </tbody></table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">«</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            </div><!-- /.box -->

        </div><!-- /.col -->

    </div>
</section>