@extends('layouts.admin.app')

@section('content')
<!-- Main content -->
<section class="content">
    @include('layouts.errors-and-messages')
    <div class="box">
        
    <div class="form-title">
            <h3>Company >> Company Info</h3>
        </div>

        <form action="{{ route('admin.company_detail.update',$company_detail->id) }}" method="post" class="form" enctype="multipart/form-data">

            <div class="box-body">
                {{ csrf_field() }}
                <br><br>
                <div class="row">
                    <div class="col-sm-6">
                      
                        <div class="form-group">
                            <label for="company_name">Company Name </label>
                            <input type="text" name="company_name" id="company_name" placeholder="company Name" class="form-control" value="{{ $company_detail->company_name ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="company_logo">Company Logo </label>
                            <input type="file" name="company_logo" id="company_logo" placeholder="company Name" class="form-control" value="{{ $company_detail->company_logo ?? '' }}">
                        </div>

                        <div class="form-group">
                            <img src="{{ asset('storage/'.$company_detail->company_logo) }}" style="height: 150px; width: auto">
                        </div>

                        <div class="form-group">
                            <label for="address">Address </label>
                            <input type="text" name="address" id="address" placeholder="Address" class="form-control" value="{{ $company_detail->address ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="city">City </label>
                            <input type="text" name="city" id="city" placeholder="City" class="form-control" value="{{ $company_detail->city ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="state">State </label>
                            <input type="text" name="state" id="state" placeholder="State" class="form-control" value="{{ $company_detail->state ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="pincode">PinCode </label>
                            <input type="number" name="pincode" id="pincode" placeholder="Pincode" class="form-control" value="{{ $company_detail->pincode ?? '' }}"  onkeypress="return isNumberKey(event)" maxlength="6">
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" name="country" id="country" placeholder="Country" class="form-control" value="{{ $company_detail->country ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="number" name="contact" id="contact" placeholder="Contact Number" class="form-control" value="{{ $company_detail->contact ?? '' }}"  onkeypress="return isNumberKey(event)" maxlength="10">
                            <p>Use comma (,) as a separator for multiple contact numbers</p>
                        </div>

                        <div class="form-group">
                            <label for="contact_email">Contact Email </label>
                            <input type="email" name="contact_email" id="contact_email" placeholder="Contact Email" class="form-control" value="{{ $company_detail->contact_email ?? '' }}">
                            <p>Use comma (,) as a separator for multiple email ids</p>
                        </div>
                    </div>

                    <div class="col-sm-6">


                        <h4>Social Links</h4>
                        <br>

                        <div class="form-group">
                            <label for="google_url">Facebook</label>
                            <input type="text" name="google_url" id="google_url" placeholder="Facebook Link" class="form-control" value="{{ $company_detail->google_url ?? '' }}">
                        </div>


                        <div class="form-group">
                            <label for="twitter_url">Twitter</label>
                            <input type="text" name="twitter_url" id="twitter_url" placeholder="Twitter Link" class="form-control" value="{{ $company_detail->twitter_url ?? '' }}">
                        </div>


                        <div class="form-group">
                            <label for="linked_in_url">LinkedIn</label>
                            <input type="text" name="linked_in_url" id="linked_in_url" placeholder="LinkedIn Link" class="form-control" value="{{ $company_detail->linked_in_url ?? '' }}">
                        </div>


                        <div class="form-group">
                            <label for="instagram_url">Instagram</label>
                            <input type="text" name="instagram_url" id="instagram_url" placeholder="Instagram Link" class="form-control" value="{{ $company_detail->instagram_url ?? '' }}">
                        </div>


                        <div class="form-group">
                            <label for="youtube_url">Youtube</label>
                            <input type="text" name="youtube_url" id="youtube_url" placeholder="Youtube Link" class="form-control" value="{{ $company_detail->youtube_url ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="pinterest_url">Pinterest</label>
                            <input type="text" name="pinterest_url" id="pinterest_url" placeholder="Pinterest Link" class="form-control" value="{{ $company_detail->pinterest_url ?? '' }}">
                        </div>


                    </div>
                </div>

                    <!-- <br><br>
                    <h4>Social Login Details</h4>

                    <div class="form-group">
                        <label for="facebook_client_id">Facebook Client Id </label>
                        <input type="text" name="facebook_client_id" id="facebook_client_id" placeholder="Facebook Client Id" class="form-control" value="{{ $company_detail->facebook_client_id ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="facebook_secret_key">Facebook Secret Key </label>
                        <input type="text" name="facebook_secret_key" id="facebook_secret_key" placeholder="Facebook Secret Key" class="form-control" value="{{ $company_detail->facebook_secret_key ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="google_client_id">Google Client Id </label>
                        <input type="text" name="google_client_id" id="google_client_id" placeholder="Google Client Id" class="form-control" value="{{ $company_detail->google_client_id ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="google_secret_key">Google Secret Key </label>
                        <input type="text" name="google_secret_key" id="google_secret_key" placeholder="Google Secret Key" class="form-control" value="{{ $company_detail->google_secret_key ?? '' }}">
                    </div> -->

                    <br><br>

                    
                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <!-- <a href="{{ route('admin.brands.index') }}" class="btn btn-default">Back</a> -->
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
    @endsection
