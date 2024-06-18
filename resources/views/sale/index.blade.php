@extends('layouts.master')

@section('title')
    Sale List
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Sale List</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <button onclick="addForm()" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> New Transactions</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-sale">
                    <thead>
                        <th width="5%">No</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Total Items</th>
                        <th>Total price</th>
                        <th>Discount</th>
                        <th>Total Pay</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('sale.customer')
@includeIf('sale.detail')
@endsection

@push('scripts')
    <script>
        let table, table1;

        $(function () {
        table = $('.table-sale').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('sale.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'date'},
                {data: 'customer'},
                {data: 'total_items'},
                {data: 'total_price'},
                {data: 'discount'},
                {data: 'pay'},
                {data: 'action', searchable: false, sortable: false},
            ]
        });

        $('.table-customer').DataTable();
        table1 = $('.table-detail').DataTable({
            processing: true,
            bSort: false,
            dom: 'Brt',
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'code_product'},
                {data: 'name_product'},
                {data: 'sales_price'},
                {data: 'amount'},
                {data: 'subtotal'},
            ]
        })
    });

    function addForm() {
        $('#modal-customer').modal('show');
    }

    function showDetail(url) {
        $('#modal-detail').modal('show');

        table1.ajax.url(url);
        table1.ajax.reload();
    }

    function deleteData(url) {
        if (confirm('Are you sure you want to delete selected data?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Cannot delete data');
                    return;
                });
        }
    }
    </script>
@endpush
