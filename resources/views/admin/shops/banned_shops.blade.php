@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">

        @include('layouts.errors-and-messages')
        <!-- Default box -->
        @if($requested_shops)
        <div class="box">
            <div class="box-body">
                <h2>Requested Shops List</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <td class="col-md-1">ID</td>
                            <td class="col-md-2">Shop Name</td>
                            <td class="col-md-2">Owner</td>
                            <td class="col-md-2">Contact No</td>
                            <td class="col-md-2">Email</td>
                            <td class="col-md-2">Address</td>
                            <!--<td class="col-md-1">Status</td>-->
                            <td class="col-md-1"></td>
                            <td class="col-md-4">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($requested_shops as $shop)
                        <tr>
                            <td>{{ $shop->id }}</td>
                            <td>{{ $shop->shop_name ?? ''}}</td>
                            <td>{{ $shop->owner_name ?? ''}}</td>
                            <td>{{ $shop->contact ?? ''}}</td>
                            <td>{{ $shop->email ?? ''}}</td>
                            <td>{{ $shop->address ?? ''}}, {{ $shop->city ?? ''}}, {{ $shop->state ?? ''}}, {{ $shop->country ?? ''}} - ({{ $shop->pincode ?? ''}})</td>
                            <!--<td>@include('layouts.status', ['status' => $shop->status])</td>-->
                            <td><a href="{{ route('admin.registered_shops.status-update', $shop->id) }}" class="btn btn-success">Activate</a></td>
                            <td>
                                <form action="{{ route('admin.registered_shops.destroy', $shop->id) }}" method="post" class="form-horizontal">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.registered_shops.show', $shop->id) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> Show</a>
                                        <a href="{{ route('admin.registered_shops.edit', $shop->id) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        @endif

    </section>
    <!-- /.content -->
@endsection
