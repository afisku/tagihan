@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header"> Form User </h5>
                <div class="card-body">
                    {!! Form::model($model, ['route' => $route,'method' => $method]) !!}
                    @csrf
                        <div class="form-group"> 
                          <label for="name">Name</label>
                          {!! Form::text('name', null, ['class' => 'form-control','autofocus']) !!}
                          <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>

                        <div class="form-group mt-2">
                            <label for="email">Email</label>
                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                          </div>

                          <div class="form-group mt-2">
                            <label for="password">Password</label>
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                          </div>

                          <div class="form-group mt-2">
                            <label for="nohp">No Hp</label>
                            {!! Form::text('nohp', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('nohp') }}</span>
                          </div>

                          
                          <div class="form-group mt-2">
                            <label for="akses">Hak Akses</label>
                            {!! Form::select(
                                'akses',
                                [
                                    'operator' => 'Operator Sekolah',
                                    'admin' => 'Administrator',
                            ],
                            null,
                            ['class' => 'form-control'],
                            ) !!}
                            <span class="text-danger">{{ $errors->first('akses') }}</span>
                          </div>
                          {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
