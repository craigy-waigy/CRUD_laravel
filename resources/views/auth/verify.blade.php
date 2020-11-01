@extends('layouts.app')

@section('title', 'Подтверждение email')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Подтверждение email</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                              Ссылка на верификацию отправлена
                        </div>
                    @endif

                     Если вы не получили сообщение
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">запросить повторное письмо</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
