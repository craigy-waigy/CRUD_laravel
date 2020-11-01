@extends('layouts.app')

@section('title', 'Редактировать заказчика')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Редактировать заказчика</div>

                <div class="card-body">
                    @include('common.alert')

                        <form action="{{ route('customer.update', $customer->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="first_name">Имя*</label>
                                <input type="text" name="first_name" id="first_name" value="{{ $customer->first_name }}" class="form-control @error('first_name') is-invalid @enderror">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="last_name">Фамилия*</label>
                                <input type="text" name="last_name" id="last_name" value="{{ $customer->last_name }}" class="form-control @error('last_name') is-invalid @enderror">
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Адрес</label>
                                <input type="text" name="address" id="address" value="{{ $customer->address }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="phone">Телефон*</label>
                                <input type="text" name="phone" id="phone" value="{{ $customer->phone }}" class="form-control @error('phone') is-invalid @enderror">
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
