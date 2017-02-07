<?php
Template::addScript('admin/raphael/raphael.js');

Template::addScript('admin/flot-data.js');

?>
{% ADMIN:MENU %}
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Активность</h1>
        </div>
        <!----------->
        <div class="contenschats col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Area Chart Example
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="morris-area-chart"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>


        </div>
        <!------------->
    </div>
</div>