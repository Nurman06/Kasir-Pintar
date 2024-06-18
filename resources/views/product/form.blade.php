<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name_product" class="col-md-2 col-md-offset-1 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" name="name_product" id="name_product" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_category" class="col-md-2 col-md-offset-1 control-label">Category</label>
                        <div class="col-md-6">
                            <select name="id_category" id="id_category" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($category as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brand" class="col-md-2 col-md-offset-1 control-label">Brand</label>
                        <div class="col-md-6">
                            <input type="text" name="brand" id="brand" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="purchase_price" class="col-md-2 col-md-offset-1 control-label">Purchase Price</label>
                        <div class="col-md-6">
                            <input type="number" name="purchase_price" id="purchase_price" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sales_price" class="col-md-2 col-md-offset-1 control-label">Sales Price</label>
                        <div class="col-md-6">
                            <input type="number" name="sales_price" id="sales_price" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="discount" class="col-md-2 col-md-offset-1 control-label">Discount</label>
                        <div class="col-md-6">
                            <input type="number" name="discount" id="discount" class="form-control" value="0">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stock" class="col-md-2 col-md-offset-1 control-label">Stock</label>
                        <div class="col-md-6">
                            <input type="number" name="stock" id="stock" class="form-control" required value="0">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary">Save</button>
                    <button type="button" class="btn btn-sm btn-flat btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>