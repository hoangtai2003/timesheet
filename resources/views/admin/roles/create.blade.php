@extends('admin.layouts.admin')
@section('title')
    <title>
        Trang chủ
    </title>

@endsection

@section('css')
    <style>
        .card-header {
            background-color: aqua;
        }
        input[type="checkbox"]{
            transform: scale(1.2);
        }
    </style>
@endsection


@section('js')
    <script>
        $('.checkbox_wrapper').on('click', function(){
            $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
        });
        $('.checkall').on('click', function(){
            $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
            $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
        });
        $('.checkall').on('click', function(){
            $(this).parents().find('.checkbox_all').prop('checked', $(this).prop('checked'));
        });

    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data" style="width: 100%;">
                        <div class="col-md-12">
                            @csrf
                            <div class="form-group">
                                <label>Tên vai trò</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name = "name"
                                    placeholder="Nhập tên vai trò">
                            </div>
                            <div class="form-group">
                                <label>Mô tả vai trò</label>
                                <textarea
                                    class="form-control "
                                    name = "display_name"
                                    rows="4">
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <input type="checkbox" class="checkall"> CheckAll
                                    </label>
                                </div>
                                @foreach($permissionsParent as $permissionsParentItem)
                                    <div class="card border-primary mb-3 col-md-12">
                                        <div class="card-header">
                                            <label>
                                                <input type="checkbox" value="" class="checkbox_wrapper">
                                            </label>
                                                {{$permissionsParentItem->name}}
                                        </div>
                                        <div class="row">
                                            @foreach($permissionsParentItem->permissionsChildrent as $permissionsChildrentItem)
                                                <div class="card-body text-primary col-md-3">
                                                    <h5 class="card-title">
                                                        <label>
                                                            <input
                                                                type="checkbox"
                                                                name="permission_id[]"
                                                                value="{{$permissionsChildrentItem->id}}"
                                                                class="checkbox_childrent">
                                                        </label>
                                                        {{$permissionsChildrentItem->name}}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
