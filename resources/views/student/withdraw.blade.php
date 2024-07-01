@extends('layouts.main')

@section('title', 'Withdrawal Requests')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Withdrawal Requests</h4>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Button to Open Withdraw Modal -->
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#withdrawModal">
                        Request Withdrawal
                    </button>
                </div>

                <!-- Withdraw Modal -->
                <div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="withdrawModalLabel">Request Withdrawal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('student.withdrawal_request.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="accountNumber" class="form-label">Account Number</label>
                                        <input type="text" class="form-control" id="accountNumber" name="account_number" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="withdrawAmount" class="form-label">Amount to Withdraw</label>
                                        <input type="number" class="form-control" id="withdrawAmount" name="amount" step="0.01" min="0.01" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Withdraw Modal -->

                <!-- Table of Withdrawal Requests -->
                <div class="table-responsive">
                    <table id="withdrawalRequestsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Account Number</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date Requested</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawalRequests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->account_number }}</td>
                                <td>{{ $request->amount }}</td>
                                <td>{{ $request->status }}</td>
                                <td>{{ $request->created_at->format('Y-m-d H:i:s') }}</td>

                            </tr>

                            <!-- Cancel Modal -->

                            <!-- End Cancel Modal -->

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table of Withdrawal Requests -->
            </div>
        </div>
    </div>
</div>
@endsection


