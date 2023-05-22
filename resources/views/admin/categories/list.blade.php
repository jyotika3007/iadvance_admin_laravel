@extends('layouts.admin.app')

@section('content')
<!-- Main content -->
<section class="content">
    @include('layouts.errors-and-messages')
    <!-- Default box -->
    <div class="box">

    
    <div class="form-title">
            <h3>Categories >> Categories List @if(!empty($keyword)) - Search result for - <b><i>"{{ $keyword }}"</i></b> @endif</h3>
        </div>
        <div class="box-body">
          
                    <form action="{{route('admin.categories.search_categories')}}" method="get">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label style="margin-top: 6px; float: right;">Search Here</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="keyword" id="keyword" value="@if(!empty($keyword)){{$keyword}}@endif" class="form-control" placeholder="Search by shop name, owner ...">
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-sm-4">
                            <!-- <button type="submit" name="search" id="search" vaule="search" class="btn btn-primary">Submit</button>
                            <a href="{{ route('admin.categories.index') }}" name="search" id="reset" vaule="reset" class="btn btn-warning">Reset</a> -->
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ route('admin.categories.create') }}"  class="btn btn-primary">Add New</a>
                        </div>
                    </div>
                </form>
                    <br>



   @if($categories)
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <td>Created At</td>
                        <td>Category Name</td>
                        <td>Sub Categories</td>
                        <td>Cover</td>
                        <td>Status</td>
                        <td>Is Featured</td>
                        <td>Top Categories</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                   
                    @php $i=1 @endphp
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ date('M d, Y',strtotime(explode(' ',$category->created_at)[0])) }}</td>
                        <td>
                            <a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a>
                        </td>
                            <td>
                                <a href="{{ url('admin/sub_categories',$category->id) }}" class="btn btn-default">View Sub Categories</a>
                            </td>
                                <td>
                                    @if(isset($category->cover))
                                    <img src="{{ asset("storage/$category->cover") }}" alt="" class="img-responsive" style="100px;">
                                    @endif
                                </td>
                                <td>@include('layouts.status', ['status' => $category->status])</td>
                                <td>@include('layouts.status', ['status' => $category->is_featured])</td>
                                <td>@include('layouts.status', ['status' => $category->is_top])</td>
                                <td>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                            <!-- <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button> -->
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        
                        </tbody>
                    </table>
                    {{ $categories->links() }}
            @endif</div>
                <!-- /.box-body -->
                <div class="box-footer">
                </div>
            </div>
            <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection