@extends('layouts.main')

@section('title', 'Withdrawal Requests')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Withdrawal Requests</h4>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="table-responsive">
                    <table id="withdrawal-requests-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Account Number</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdrawalRequests as $request)
                            <tr>
                                <td>{{ $request->student->first_name.' ' .$request->student->last_name }}</td>
                                <td>{{ $request->account_number }}</td>
                                <td>{{ $request->amount }}</td>
                                <td>{{ $request->status }}</td>
                                <td>
                                    @if($request->status === 'Pending')
                                    <form action="{{ route('admin.student_withdraw_request', $request->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    @else
                                    <span class="badge badge-success">{{ $request->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#withdrawal-requests-table').DataTable();
        });
    </script>
@endsection
