@extends('admin.admin_template')
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Horizontal Form</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Employee Name</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="employeename" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label>Select</label>
                    <select class="form-control">
                        <option value="manager">Manager</option>
                        <option value="employee">Employee</option>
                    </select>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Sign in</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
