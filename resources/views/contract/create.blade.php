@extends('layouts.app')

@section('title', 'Добавить контракт')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Добавить контракт</div>

                <div class="card-body">
                    @include('common.alert')

                        <form action="{{ route('contract.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="date">Дата заключения контракта*</label>

                                <input type="date" name="contract_date" id="contract_date" value="{{ old('contract_date') }}"  class="form-control @error('contract_date') is-invalid @enderror">
                                @error('contract_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Наименование контракта*</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"  class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="contractor_id">Подрядчик*</label>
                                <select name="contractor_id" class="form-control form-control @error('contractor_id') is-invalid @enderror" id="contractor_id">
                                    @foreach ($contractors as $contractor)
                                        <option value="{{ $contractor->id }}">
                                            {{ $contractor->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('contractor_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="customer_id">Заказчик*</label>
                                <select name="customer_id" class="form-control form-control @error('customer_id') is-invalid @enderror" id="customer_id">
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">
                                            {{ $customer->first_name }} {{ $customer->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="amount">Сумма контракта в рублях*</label>
                                <input type="text" name="amount" id="amount" value="{{ old('amount') }}"  class="form-control @error('amount') is-invalid @enderror">
                                @error('amount')
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
