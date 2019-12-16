<form method="post" action="{{ url('admin/add/asset/product') }}" enctype="multipart/form-data">
    <div class="box-body">
        @csrf
        <input type="text"  id="id" name="asset_name" {{isset($objAssetProduct->asset_name)?$objAssetProduct->asset_name:''}} >
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
