@extends('default.views.layouts.default')

@section('title') {{lang('stock')}} @stop

@section('body')
<style type="text/css">
    .form-group span.error {
        margin-left: 33.3% !important;
    }
</style>
<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
   
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ base_url() }}">{{ lang('dashboard') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{lang('stock')}}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> {{lang('stock')}} </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADERs-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="table-wrapper" class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-grid font-dark"></i>
                        <span class="caption-subject">{{lang('stock')}}</span>
                    </div>
                    <div class="tools">
                        @if($print_limited_access == 1 || $print_unlimited_access == 1)
                            <!-- <button onClick="return window.open('{{base_url()}}master/stock/pdf')" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> {{ lang('print_pdf') }}
                            </button>
                            <button onClick="return window.open('{{base_url()}}master/stock/excel')" class="btn btn-success btn-sm">
                                <i class="fa fa-file-excel-o"></i> {{ lang('print_excel') }}
                            </button> -->
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- FILTER -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-primary">
                                    <div class="panel-heading" role="tab" id="filterView">
                                        <h3 class="panel-title">
                                            <div class="pull-left">
                                                <i class="dashicons dashicons-filter"></i> Filter
                                            </div>
                                            <div class="pull-right">
                                                <a style="color: #fff;text-decoration: none;" role="button" data-toggle="collapse" data-parent="#accordion" href="#filterField" aria-expanded="true" aria-controls="filterField">
                                                    <span id="icon-arrow-filter" class="dashicons dashicons-arrow-down-alt2"></span>
                                                </a>
                                            </div>
                                        </h3>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="filterField" role="tabpanel" aria-labelledby="filterView">
                                        <div class="panel-body">
                                            {{ form_open(null,array('id' => 'form-filter-stock-dipo', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
                                                <div class="row filter-field">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="product"><?= lang('product_name') ?></label>
                                                            <select class="form-control input-sm select2" name="product_id" id="product_id" style="width: 100%;">
                                                                <option value=""><?= lang('select_your_option') ?></option>
                                                                @foreach($products as $product)
                                                                    <option <?php if($product_id == $product->id) echo "selected" ?> value="{{ $product->id }}">{{ $product->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="dipo"><?= lang('dipo') ?>/<?= lang('mitra') ?></label>
                                                            <select class="form-control input-sm select2" name="dipo_id" id="dipo_id" style="width: 100%;">
                                                                <option value=""><?= lang('select_your_option') ?></option>
                                                                @foreach($dipos as $dipo)
                                                                    <option <?php if($dipo_id == $dipo->id) echo "selected" ?> value="{{ $dipo->id }}">{{ $dipo->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <button type="submit" class="btn btn-primary">Filter</button>
                                                    <!-- <button type="reset" class="btn btn-default">Reset</button> -->
                                                    <button onclick="myFunctionReset()" class="btn btn-default">Reset</button>
                                                </div>
                                            {{ form_close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="stock_kanaka">
                        <ul class="nav nav-tabs">
                            <li id="nav_kanaka" class="active"><a href="#tab_kanaka" data-toggle="tab" aria-expanded="true"> Kanaka </a></li>
                            <li id="nav_dipo"><a href="#tab_dipo" data-toggle="tab" aria-expanded="true"> <?= lang('dipo') ?> </a></li>
                            <li id="nav_mitra" class=""><a href="#tab_mitra" data-toggle="tab" aria-expanded="false"> <?= lang('mitra') ?> </a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_kanaka">
                                <table id="table-stock-kanaka"class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                                    <tr>
                                        <th class="text-center"><?=lang('product_name')?></th>
                                        <th class="text-center"><?=lang('pack')?></th>
                                        <th class="text-center"><?=lang('nominal')?></th>
                                    </tr>
                                    <?php if(!empty($stocks_kanaka)): ?>
                                    <?php foreach($stocks_kanaka as $kanaka){ ?>
                                    <tr>
                                        <td><?= $kanaka['product_name']?></td>
                                        <td class="text-center"><?= $kanaka['pax'] ?></td>
                                        <td class="text-center"><?= number_format($kanaka['nominal']) ?></td>
                                    </tr>
                                    <?php } ?>
                                    <?php else:?>
                                        <tr>
                                            <td colspan="5" align="center">Tidak ada data yang tersedia</td>
                                        </tr>
                                    <?php endif;?>
                                </table>
                            </div>

                            <div class="tab-pane" id="tab_dipo">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <table id="table-stock-dipo" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?=lang('dipo')?></th>
                                            <th class="text-center"><?=lang('code')?></th>
                                            <th class="text-center"><?=lang('address')?></th>
                                            <th class="text-center"><?=lang('phone')?></th>
                                            <th class="text-center"><?=lang('email')?></th>
                                        </tr>
                                        <?php if(!empty($stocks_dipo)): ?>
                                        <?php 
                                            foreach($stocks_dipo as $stock_dipo){ 
                                                $dataDipo = Dipo::where('id', $stock_dipo['customer_id'])->where('deleted', '0')->get();
                                                foreach($dataDipo as $dipo){
                                        ?> 
                                                <tr>
                                                    <td class="btn-collapse"><a data-toggle="collapse" data-parent="#table-stock-dipo" aria-expanded="true" style="cursor:pointer" data-toggle="collapse" data-target="#1_accordion_<?= $stock_dipo['customer_id'] ?>" class="clickable collapsed"><?= $dipo->name ?></a></td>
                                                    <td><?= $dipo->code ?></td>
                                                    <td><?= $dipo->address ?></td>
                                                    <td><?= $dipo->phone ?></td>
                                                    <td><?= $dipo->email ?></td>
                                                </tr>
                                                <tr id="1_accordion_<?= $stock_dipo['customer_id'] ?>" class="collapse panel-collapse">
                                                    <td colspan="5">
                                                        <div>
                                                            <h5 class="text-center"><b><?=lang('stock')?> <?= $dipo->name ?></b></h5>
                                                            <table id="detail-stock" class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                                                                <tr>
                                                                    <th class="text-center"><?=lang('product_name')?></th>
                                                                    <th class="text-center"><?=lang('pack')?></th>
                                                                    <th class="text-center"><?=lang('nominal')?></th>
                                                                </tr>
                                                                <?php foreach($stock_dipo['data_product'] as $d){ ?>
                                                                <tr>
                                                                    <td><?= $d['product_name'] ?></td>
                                                                    <td class="text-center"><?= $d['pax'] ?></td>
                                                                    <td class="text-center"><?= number_format($d['nominal']) ?></td>
                                                                </tr>
                                                                <?php } ?>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php else:?>
                                            <td colspan="5" align="center">Tidak ada data yang tersedia</td>
                                        <?php endif;?>
                                    </thead>
                                </table>
                                <!-- END EXAMPLE TABLES PORTLET-->
                            </div>

                            <div class="tab-pane" id="tab_mitra">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <table id="table-stock-mitra" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?=lang('mitra')?></th>
                                            <th class="text-center"><?=lang('code')?></th>
                                            <th class="text-center"><?=lang('address')?></th>
                                            <th class="text-center"><?=lang('phone')?></th>
                                            <th class="text-center"><?=lang('email')?></th>
                                        </tr>
                                        <?php if(!empty($stocks_mitra)): ?>
                                        <?php 
                                            foreach($stocks_mitra as $stock_mitra){ 
                                                $dataMitra = Dipo::where('id', $stock_mitra['customer_id'])->where('deleted', '0')->get();
                                                foreach($dataMitra as $mitra){
                                        ?> 
                                                <tr>
                                                    <td class="btn-collapse"><a data-toggle="collapse" data-parent="#table-stock-mitra" aria-expanded="true" style="cursor:pointer" data-toggle="collapse" data-target="#2_accordion_<?= $stock_mitra['customer_id'] ?>" class="clickable collapsed"><?= $mitra->name ?></a></td>
                                                    <td><?= $mitra->code ?></td>
                                                    <td><?= $mitra->address ?></td>
                                                    <td><?= $mitra->phone ?></td>
                                                    <td><?= $mitra->email ?></td>
                                                </tr>
                                                <tr id="2_accordion_<?= $stock_mitra['customer_id'] ?>" class="collapse panel-collapse">
                                                    <td colspan="5">
                                                        <div>
                                                            <h5 class="text-center"><b><?=lang('stock')?> <?= $mitra->name ?></b></h5>
                                                            <table id="detail-stock" class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                                                                <tr>
                                                                    <th class="text-center"><?=lang('product_name')?></th>
                                                                    <th class="text-center"><?=lang('pack')?></th>
                                                                    <th class="text-center"><?=lang('nominal')?></th>
                                                                </tr>
                                                                <?php foreach($stock_mitra['data_product'] as $m){ ?>
                                                                <tr>
                                                                    <td><?= $m['product_name'] ?></td>
                                                                    <td class="text-center"><?= $m['pax'] ?></td>
                                                                    <td class="text-center"><?= number_format($m['nominal']) ?></td>
                                                                </tr>
                                                                <?php } ?>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php else:?>
                                            <td colspan="5" align="center">Tidak ada data yang tersedia</td>
                                        <?php endif;?>
                                    </thead>
                                </table>
                                <!-- END EXAMPLE TABLES PORTLET-->
                            </div>
                        </div>
                    </div>

                    <div id="stock_dipo">
                        <ul class="nav nav-tabs">
                            <li id="2_nav_dipo" class="active"><a href="#2_tab_dipo" data-toggle="tab" aria-expanded="true"> <?= lang('dipo') ?> </a></li>
                            <li id="2_nav_mitra" class=""><a href="#2_tab_mitra" data-toggle="tab" aria-expanded="false"> <?= lang('mitra') ?> </a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="2_tab_dipo">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <table id="table-stock-dipo" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?=lang('product_name')?></th>
                                            <th class="text-center"><?=lang('pack')?></th>
                                            <th class="text-center"><?=lang('nominal')?></th>
                                        </tr>
                                        <?php if(!empty($stocks_dipo_2)): ?>
                                    <?php foreach($stocks_dipo_2 as $stock_dipo_2){ ?>
                                    <tr>
                                        <td><?= $stock_dipo_2['product_name']?></td>
                                        <td class="text-center"><?= $stock_dipo_2['pax'] ?></td>
                                        <td class="text-center"><?= number_format($stock_dipo_2['nominal']) ?></td>
                                    </tr>
                                    <?php } ?>
                                    <?php else:?>
                                        <tr>
                                            <td colspan="5" align="center">Tidak ada data yang tersedia</td>
                                        </tr>
                                    <?php endif;?>
                                    </thead>
                                </table>
                                <!-- END EXAMPLE TABLES PORTLET-->
                            </div>

                            <div class="tab-pane" id="2_tab_mitra">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <table id="table-stock-mitra" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?=lang('mitra')?></th>
                                            <th class="text-center"><?=lang('code')?></th>
                                            <th class="text-center"><?=lang('address')?></th>
                                            <th class="text-center"><?=lang('phone')?></th>
                                            <th class="text-center"><?=lang('email')?></th>
                                        </tr>
                                        <?php if(!empty($stocks_mitra_2)): ?>
                                        <?php 
                                            foreach($stocks_mitra_2 as $stock_mitra){ 
                                                $dataMitra = Dipo::where('id', $stock_mitra['customer_id'])->where('deleted', '0')->get();
                                                foreach($dataMitra as $mitra){
                                        ?> 
                                                <tr>
                                                    <td class="btn-collapse"><a data-toggle="collapse" data-parent="#table-stock-mitra" aria-expanded="true" style="cursor:pointer" data-toggle="collapse" data-target="#3_accordion_<?= $stock_mitra['customer_id'] ?>" class="clickable collapsed"><?= $mitra->name ?></a></td>
                                                    <td><?= $mitra->code ?></td>
                                                    <td><?= $mitra->address ?></td>
                                                    <td><?= $mitra->phone ?></td>
                                                    <td><?= $mitra->email ?></td>
                                                </tr>
                                                <tr id="3_accordion_<?= $stock_mitra['customer_id'] ?>" class="collapse panel-collapse">
                                                    <td colspan="5">
                                                        <div>
                                                            <h5 class="text-center"><b><?=lang('stock')?> <?= $mitra->name ?></b></h5>
                                                            <table id="detail-stock" class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                                                                <tr>
                                                                    <th class="text-center"><?=lang('product_name')?></th>
                                                                    <th class="text-center"><?=lang('pack')?></th>
                                                                    <th class="text-center"><?=lang('nominal')?></th>
                                                                </tr>
                                                                <?php foreach($stock_mitra['data_product'] as $m){ ?>
                                                                <tr>
                                                                    <td><?= $m['product_name'] ?></td>
                                                                    <td class="text-center"><?= $m['pax'] ?></td>
                                                                    <td class="text-center"><?= number_format($m['nominal']) ?></td>
                                                                </tr>
                                                                <?php } ?>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php else:?>
                                            <td colspan="5" align="center">Tidak ada data yang tersedia</td>
                                        <?php endif;?>
                                    </thead>
                                </table>
                                <!-- END EXAMPLE TABLES PORTLET-->
                            </div>
                        </div>
                    </div>

                    <div id="stock_mitra">
                        <ul class="nav nav-tabs">
                           <li id="3_nav_mitra" class="active"><a href="#3_tab_mitra" data-toggle="tab" aria-expanded="false"> <?= lang('mitra') ?> </a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="3_tab_mitra">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <table id="table-stock-mitra" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                    <tr>
                                        <th class="text-center"><?=lang('product_name')?></th>
                                        <th class="text-center"><?=lang('pack')?></th>
                                        <th class="text-center"><?=lang('nominal')?></th>
                                    </tr>
                                    <?php if(!empty($stocks_mitra_3)): ?>
                                    <?php foreach($stocks_mitra_3 as $stock_mitra_3){ ?>
                                    <tr>
                                        <td><?= $stock_mitra_3['product_name']?></td>
                                        <td class="text-center"><?= $stock_mitra_3['pax'] ?></td>
                                        <td class="text-center"><?= number_format($stock_mitra_3['nominal']) ?></td>
                                    </tr>
                                    <?php } ?>
                                    <?php else:?>
                                        <tr>
                                            <td colspan="5" align="center">Tidak ada data yang tersedia</td>
                                        </tr>
                                    <?php endif;?>
                                </table>
                                <!-- END EXAMPLE TABLES PORTLET-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLES PORTLET-->
        </div>
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    $(function(){
        $('#stock_kanaka').hide();
        $('#stock_dipo').hide();
        $('#stock_mitra').hide();

        @if($user->group_id == '1')
            $('#stock_kanaka').show();
        @endif

        @if($user->group_id == '2')
            $('#stock_dipo').show();
        @endif

        @if($user->group_id == '3')
            $('#stock_mitra').show();
        @endif
    });

    function myFunctionReset() {
        document.getElementById('dipo_id').value = '';
        document.getElementById('product_id').value = '';
    }

    // Pengaturan Datatable 
    // var oTable =$('#table-stock').dataTable({
    //     "responsive": false,
    //     "bProcessing": true,
    //     "bServerSide": true,
    //     "bLengthChange": true,
    //     "sServerMethod": "GET",
    //     "sAjaxSource": "{{ base_url() }}companyreport/companyreports/fetch_data_stock",
    //     "columnDefs": [
    //         {"className": "dt-center", "targets": [2, 3]}
    //     ],
    //     "order": [0,"asc"],
    // }).fnSetFilteringDelay(1000);

</script>
@stop