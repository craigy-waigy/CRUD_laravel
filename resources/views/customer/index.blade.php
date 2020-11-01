@extends('layouts.app')

@section('title', 'Заказчики')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h2>Заказчики</h2>
            @include('common.alert')

            <div class="row form-group">
                <div class="col-12">
                    <a href="{{ route('customer.create') }}" class="btn btn-md btn-success">Добавить</a>
                </div>
            </div>

           <div class="crm_table_wrapper">
               <table class="table table-striped crm_table">
                   <thead>
                       <tr>
                           <th scope="col">#</th>
                           <th scope="col">Имя, Фамилия</th>
                           <th scope="col">Телефон</th>
                           <th scope="col">Адрес</th>
                           <th scope="col"></th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach($customers as $key => $customer)
                           <tr>
                               <th scope="row">
                                   {{ ++$key }}
                               </th>

                               <td>
                                   {{ $customer->first_name }} {{ $customer->last_name }}
                               </td>
                               <td>
                                   {{ $customer->phone }}
                               </td>
                               <td>
                                   {{ $customer->address }}
                               </td>
                               <td class="crm_action_td">
                                   <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-sm btn-primary crm_action">
                                       <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                   </a>

                                   <form action="{{ route('customer.destroy', $customer->id) }}" method="post" class="crm_action_delete_form">
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

               {{ $customers->links() }}

           </div>

        </div>
    </div>
</div>
@endsection
