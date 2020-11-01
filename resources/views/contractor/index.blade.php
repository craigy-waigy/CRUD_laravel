@extends('layouts.app')

@section('title', 'Подрядчики')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h2>Подрядчики</h2>
            @include('common.alert')

            <div class="row form-group">
                <div class="col-12">
                    <a href="{{ route('contractor.create') }}" class="btn btn-md btn-success">Добавить</a>
                </div>
            </div>

           <div class="crm_table_wrapper">
               <table class="table table-striped crm_table">
                   <thead>
                       <tr>
                           <th scope="col">#</th>
                           <th scope="col">Наименование</th>
                           <th scope="col">Телефон</th>
                           <th scope="col"></th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach($contractors as $key => $contractor)
                           <tr>
                               <th scope="row">
                                   {{ ++$key }}
                               </th>

                               <td>
                                   {{ $contractor->name }} {{ $contractor->last_name }}
                               </td>
                               <td>
                                   {{ $contractor->phone }}
                               </td>
                               <td>
                                   {{ $contractor->address }}
                               </td>
                               <td class="crm_action_td">
                                   <a href="{{ route('contractor.edit', $contractor->id) }}" class="btn btn-sm btn-primary crm_action">
                                       <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                   </a>

                                   <form action="{{ route('contractor.destroy', $contractor->id) }}" method="post" class="crm_action_delete_form">
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

               {{ $contractors->links() }}

           </div>

        </div>
    </div>
</div>
@endsection
