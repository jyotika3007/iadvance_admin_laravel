@extends('layouts.admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">
    @include('layouts.errors-and-messages')
    <!-- Default box -->
        @if($addresses)
            <div class="box">

            <div class="form-title">
            <h3>Customers >> Address List</h3>
        </div>

                <div class="box-body">
                    <h2>Addresses</h2>
                    @include('layouts.search', ['route' => route('admin.addresses.index')])
                    <table class="table" id="exampleTable">
                        <thead>
                            <tr>
                                <td class="col-md-1">Alias</td>
                                <td class="col-md-2">Address 1</td>
                                <td class="col-md-1">Country</td>
                                <td class="col-md-1">City</td>
                                <td class="col-md-1">Zip Code</td>
                                <td class="col-md-1">Status</td>
                                <td class="col-md-3">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($addresses as $address)
                            <tr>
                                <td><a href="{{ route('admin.customers.show', [$address->customer_id]) }}">{{ $address->alias }}</a></td>
                                <td>{{ $address->address_1 }}</td>
                                <td>{{ $address->name }}</td>
                                <td>{{ $address->city }}</td>
                                <td>{{ $address->zip }}</td>
                                <td>@include('layouts.status', ['status' => $address->status])</td>
                                <td>
                                    <form action="{{ route('admin.addresses.destroy', $address->id) }}" method="post" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.addresses.edit', $address->id) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">{{ $addresses->links() }}</div>
                            </div>
                        </div>
                    
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        @else
            <div class="box">
                <div class="box-body"><p class="alert alert-warning">No addresses found.</p></div>
            </div>
        @endif
    </section>
    <!-- /.content -->
@endsection