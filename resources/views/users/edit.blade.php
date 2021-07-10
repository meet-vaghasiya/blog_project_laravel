@extends('layouts.app')

@section('content')

    <form action="{{ route('users.update', ['user' => $user->id]) }}" class="form-horizontal" method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-4">
                <img src="{{ $user->image ? $user->image->url() : '' }}" alt="" class="img-thumbnail avatar">
                <div class="card mt-4">
                    <div class="card-body">
                        <h6>Upload different photo</h6>
                        <input type="file" class="form-control-file" name="avatar">
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                <div class="form-group">

                    <label for=""></label>
                    <input type="text" class="form-control" value="" name="name">
                </div>

                @errors @enderrors

                <div class="form-group">

                    <input type="submit" class="form-control btn btn-primary" value="Save Changes">
                </div>

            </div>
        </div>

    </form>

@endsection
