@extends('layouts.app')
@section('title',$to_do->name ?? '')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                To-Do Details
                <a href="{{ route('to-do-list.index') }}" class="btn btn-primary btn-sm float-end">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                <h6>To-Do : <strong>{{ $to_do->name ?? '' }}</strong></h6>
                <h6 class="mt-2"><strong>Tasks:</strong></h6>

                @if(count($to_do->tasks))
                    <table class="table table-striped table-responsive table-bordered mt-3">
                        <thead>
                        <tr>
                            <th width="5%">SN</th>
                            <th width="30%">Task Name</th>
                            <th width="50%">Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($to_do->tasks as $key => $task)
                            <tr>
                              <th scope="row">{{ $key + 1 }}</th>
                              <td>{{ $task->task_name ?? '' }}</td>
                              <td>{{ $task->task_description ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                @else
                    <p class="alert alert-danger mt-2">No data found !</p>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection


@push('js')
    <script src="{{ asset('assets/js/task-list.js') }}"></script>
@endpush
