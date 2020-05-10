@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Required App Version</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form class="col-md-12" action="/required-version" method="POST">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="form-group">
                            <label for="">Required Version iOS</label>
                            <input type="text" class="form-control input-lg" id="requiredVersionIOS"  name="requiredVersionIOS" value="{{ $required_version->requiredVersionIOS ?? '' }}">
                            <label for="">Recommended Version</label>
                            <input type="text" class="form-control input-lg" id="requiredVersionIOS"  name="recommendedVersionIOS" value="{{ $required_version->recommendedVersionIOS ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="">Required Version Android</label>
                            <input type="text" class="form-control input-lg" id="requiredVersionAndroid"  name="requiredVersionAndroid" value="{{ $required_version->requiredVersionAndroid ?? '' }}">
                            <label for="">Recommended Version</label>
                            <input type="text" class="form-control input-lg" id="requiredVersionAndroid"  name="recommendedVersionAndroid" value="{{ $required_version->recommendedVersionAndroid ?? '' }}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-lg btn-block" type="submit" value="Edit">Update</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
