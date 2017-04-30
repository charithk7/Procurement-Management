<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hawk
 * Date: 9/12/2016
 * Time: 7:16 PM
 */
?>

<!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Active Orders</span>
                  <span class="info-box-number">90</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-truck"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Received</span>
                  <span class="info-box-number">41,410</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-area-chart"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Average Price</span>
                  <span class="info-box-number">45.00</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa  fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Suppliers</span>
                  <span class="info-box-number">20</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->


            <div class="row">
                <div class="col-md-6">
                    <div class="box">

                        <div class="box-body">
                            <div id="container" style="min-width: 310px; height: 350px; margin: 0 auto"></div>

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->
                </div>

                <div class="col-md-6">
                    <div class="box">

                        <div class="box-body">
                            <div id="container2" style="min-width: 310px; height: 350px; margin: 0 auto"></div>

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->
                </div>

            </div>

        </section><!-- /.content -->


<script>
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Goods Arrival - This Week'
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            xAxis: {
                categories: [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                    'Sunday'
                ]
            },
            yAxis: {
                title: {
                    text: 'Units'
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: 'Units'
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [{
                name: 'QTY [KG]',
                data: [3000, 4000, 3800, 5000, 4200, 1000, 12200]
            }]
        });

        $('#container2').highcharts({
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Orders - This Week'
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            xAxis: {
                categories: [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                    'Sunday'
                ]
            },
            yAxis: {
                title: {
                    text: ' Total Orders'
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: 'Total Orders'
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [{
                name: 'Orders',
                data: [8, 5, 2, 7, 1, 4, 5]
            }]
        });
    });
</script>