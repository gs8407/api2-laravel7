@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Safety And Security</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form class="col-md-12" action="/safety-security" method="POST">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="form-group">
                            <textarea type="text" class="form-control input-lg" id="eula" placeholder="Text Here" name="body">{{ $safety_security->body ?? '' }}</textarea>
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
