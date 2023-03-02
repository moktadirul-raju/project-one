@extends('layouts.app')
@section('title','To-Do List')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                To-Do Lists
                <a href="{{ route('to-do-list.create') }}" class="btn btn-primary btn-sm float-end">
                    <i class="bi bi-plus-circle"></i> Add New
                </a>
            </div>
            <div class="card-body">
                @if(Session::has('message'))
                    <p class="alert alert-{{ Session::get('type') }} mt-1 alert-padding">{{ Session::get('message') }}</p>
                @endif
                @if(count($to_do_lists))
                    <div class="table-responsive">
                    <table class="table table-striped  table-bordered">
                        <thead>
                        <tr>
                          <th width="5%">SN</th>
                          <th width="30%">Name</th>
                          <th width="15%">Tasks</th>
                          <th width="8%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($to_do_lists as $key => $to_do)
                            <tr>
                              <th scope="row">{{ $key + 1 }}</th>
                              <td>{{ $to_do->name ?? '' }}</td>
                              <td>
                                  <button class="btn btn-outline-info btn-sm">{{ $to_do->tasks->count() }}</button>
                                  <a href="{{ route('to-do-tasks',encryptDecrypt($to_do->id,'encrypt')) }}" class="btn btn-sm btn-info">
                                      View tasks
                                  </a>
                                  <a href="{{ route('manage-tasks',encryptDecrypt($to_do->id,'encrypt')) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Add/Edit/Delete Task">
                                      Quick manage task
                                  </a>
                              </td>
                              <td>
                                  <a href="{{ route('to-do-list.show',encryptDecrypt($to_do->id,'encrypt')) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                  <a href="{{ route('to-do-list.edit',encryptDecrypt($to_do->id,'encrypt')) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>
                                  <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-item" data-id="delete-to-do-{{ $to_do->id }}">
                                      <form action="{{ route('to-do-list.destroy',encryptDecrypt($to_do->id,'encrypt')) }}" method="POST" class="d-none" id="delete-to-do-{{ $to_do->id }}">
                                          @csrf
                                          @method('DELETE')
                                      </form>
                                      <i class="bi bi-trash"></i>
                                  </a>
                              </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                        </div>
                    <nav aria-label="Page navigation example">
                      {{ $to_do_lists->links() }}
                    </nav>
                @else
                    <p class="alert alert-danger">No data found !</p>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
@endpush
