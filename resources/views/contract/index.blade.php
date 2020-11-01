@extends('layouts.app')

@section('title', 'Контракты')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h2>Контракты</h2>
            @include('common.alert')

            <div class="row form-group">
                <div class="col-12">
                    <a href="{{ route('contract.create') }}" class="btn btn-md btn-success">Добавить</a>
                </div>
            </div>

           <div class="crm_table_wrapper">
               <table class="table table-striped crm_table">
                   <thead>
                       <tr>
                           <th scope="col">#</th>
                           <th scope="col">Дата</th>
                           <th scope="col">Наименование</th>
                           <th scope="col">Подрядчик</th>
                           <th scope="col">Заказчик</th>
                           <th scope="col">Сумма</th>
                           <th scope="col"></th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach($contracts as $key => $contract)
                           <tr>
                               <th scope="row">
                                   {{ ++$key }}
                               </th>

                               <td>
                                   {{ \Carbon\Carbon::createFromFormat('Y-m-d', $contract->contract_date)->format('d.m.Y') }}
                               </td>

                               <td>
                                   {{ $contract->name }}
                               </td>
                               <td>
                                   {{ $contract->contractor->name }}
                               </td>
                               <td>
                                   {{ $contract->customer->first_name }} {{ $contract->customer->last_name }}
                               </td>
                               <td>
                                   @include('common.currency', ['price' => $contract->amount])
                               </td>
                               <td class="crm_action_td">
                                   <a href="{{ route('contract.edit', $contract->id) }}" class="btn btn-sm btn-primary crm_action">
                                       <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                   </a>

                                   <form action="{{ route('contract.destroy', $contract->id) }}" method="post" class="crm_action_delete_form">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class="btn btn-sm btn-danger crm_action">
                                           <i class="fa fa-trash-o" aria-hidden="true"></i>
                                       </button>
                                   </form>
                               </td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>

               {{ $contracts->links() }}

           </div>

        </div>
    </div>
</div>
@endsection
