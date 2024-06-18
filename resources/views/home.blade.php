@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Dashboard</li>
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $categoryCount }}</h3>
                <p>Category</p>
            </div>
            <div class="icon">
                <i class="fa fa-cube"></i>
            </div>
            <a href="{{ route('category.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $productCount }}</h3>
                <p>Product</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ route('product.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $customerCount }}</h3>
                <p>Customer</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('customer.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $supplierCount }}</h3>
                <p>Supplier</p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <a href="{{ route('supplier.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ $purchaseCount }}</h3>
                <p>Purchase</p>
            </div>
            <div class="icon">
                <i class="fa fa-download"></i>
            </div>
            <a href="{{ route('purchase.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
            <div class="inner">
                <h3>{{ $saleCount }}</h3>
                <p>Sale</p>
            </div>
            <div class="icon">
                <i class="fa fa-upload"></i>
            </div>
            <a href="{{ route('sale.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<!-- Donut Chart -->
<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Donut Chart</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-8">
              <div class="chart-responsive">
                <canvas id="pieChart" height="150"></canvas>
              </div>
      
            </div>
      
            <div class="col-md-4">
              <ul class="chart-legend clearfix">
                <li><i class="fa fa-circle-o text-aqua"></i> Category</li>
                <li><i class="fa fa-circle-o text-green"></i> Product</li>
                <li><i class="fa fa-circle-o text-yellow"></i> Customer</li>
                <li><i class="fa fa-circle-o text-red"></i> Supplier</li>
                <li><i class="fa fa-circle-o text-purple"></i> Purchase</li>
                <li><i class="fa fa-circle-o text-orange"></i> Sale</li>
              </ul>
            </div>
      
        </div>
    </div>
</div>
    
<!-- /.row (main row) -->
@endsection
@push('scripts')
<script>
    $(function () {
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var pieData = [
            {
                value: {{ $categoryCount }},
                color: '#00c0ef',
                highlight: '#00c0ef',
                label: 'Category'
            },
            {
                value: {{ $productCount }},
                color: '#00a65a',
                highlight: '#00a65a',
                label: 'Product'
            },
            {
                value: {{ $customerCount }},
                color: '#f39c12',
                highlight: '#f39c12',
                label: 'Customer'
            },
            {
                value: {{ $supplierCount }},
                color: '#dd4b39',
                highlight: '#dd4b39',
                label: 'Supplier'
            },
            {
                value: {{ $purchaseCount }},
                color: '#605ca8',
                highlight: '#605ca8',
                label: 'Purchase'
            },
            {
                value: {{ $saleCount }},
                color: '#FF851B',
                highlight: '#FF851B',
                label: 'Sale'
            }
        ];
        var pieOptions = {
            segmentShowStroke: true,
            segmentStrokeColor: '#fff',
            segmentStrokeWidth: 2,
            percentageInnerCutout: 50,
            animationSteps: 100,
            animationEasing: 'easeOutBounce',
            animateRotate: true,
            animateScale: false,
            responsive: true,
            maintainAspectRatio: false,
            legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
        };
        // Create pie or doughnut chart
        // You can switch between pie and doughnut using the method below.
        var pieChart = new Chart(pieChartCanvas).Doughnut(pieData, pieOptions);
    });
</script>
@endpush