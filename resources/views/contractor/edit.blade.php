@extends('layouts.app')

@section('title', 'Редактировать подрядчика')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Редактировать подрядчика</div>

                <div class="card-body">
                    @include('common.alert')

                        <form action="{{ route('contractor.update', $contractor->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Наименование*</label>
                                <input type="text" name="name" id="name" value="{{ $contractor->name }}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Телефон*</label>
                                <input type="text" name="phone" id="phone" value="{{ $contractor->phone }}" class="form-control @error('phone') is-invalid @enderror">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group-submit">
                                <button type="submit" class="btn btn-success btn-lg">Сохранить</button>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
