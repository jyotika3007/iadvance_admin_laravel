@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('layouts.errors-and-messages')
        <div class="box">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="post" class="form">
                <div class="box-body">
                    <h3>Edit Employee Role</h3>
                    <br>
                    {{ csrf_field() }}
                    <input type="hidden" value="put" name="_method">
                    <div class="form-group">
                        <label for="name">Display Name <span class="text text-danger">*</span></label>
                        <input type="text" name="name" id="name" placeholder="Display name" class="form-control" value="{{ old('name') ?: $role->name }}">
                    </div>
                   <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control ckeditor" placeholder="Description">{{ old('description') ?: $role->description }}</textarea>
                    </div>
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <div class="btn-group">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-default">Back</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
