@extends('user.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if (session()->has('success'))
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissible mx-auto" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <div class="card mb-3">


                    <div class="card-body">
                        <form action="{{ url('changepassword/' . $user->id) }}" method="POST" enctype=multipart/form-data>
                            @csrf
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input type="text" id="password" name="password"
                                    class="form-control  @error('password')
                                    is-invalid
                                @enderror">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
