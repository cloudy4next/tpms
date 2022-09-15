@extends('layouts.client')
@section('client')
    <div class="iq-card">
        <div class="iq-card-body">
            <h2 class="common-title">Change Password</h2>
            <form action="{{route('client.myprofile.change.password.update')}}" method="post">
                @csrf
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger mt-3" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-md-4 col-lg-2 mb-3">
                        <label>New Password</label>
                        <input type="Password" name="new_pass" class="form-control" minlength="8" required>
                    </div>
                    <div class="col-md-4 col-lg-2 mb-3">
                        <label>Confirm Password</label>
                        <input type="Password" name="con_pass" class="form-control" minlength="8" required>
                    </div>
                    <div class="col-md-4 col-lg-2 mb-3 align-self-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
