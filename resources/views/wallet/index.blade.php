@extends('layouts.main')

@section('title', 'Wallet')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center mb-4">
                    <h4 class="card-title mb-sm-0">Wallet Balance {{ $wallet->balance - $wallet->deduct_balance }}</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Total Earnings After Commission</th>
                                <th>Total Earnings Before Commission</th>
                                <th>Commission Rate (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $wallet->balance ?? 'N/A' }}</td>
                                <td>{{ $totalEarningsBeforeCommission ?? 'N/A' }}</td>
                                <td>{{ $commissionRate ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#withdrawModal">
                    Request Withdrawal
                </button>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="withdrawModalLabel">Request Withdrawal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="withdrawForm" action="{{ route('wallet.withdraw') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="withdrawAmount" class="form-label">Amount to Withdraw</label>
                        <input type="number" class="form-control" id="withdrawAmount" name="withdraw_amount" step="0.01" min="0.01" max="{{ $wallet->balance - $wallet->deduct_balance }}" required>
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

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Withdrawal Requests</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdrawalRequests as $request)
                            <tr>
                                <td>{{ $request->amount }}</td>
                                <td>{{ $request->status }}</td>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the input element
        let withdrawAmountInput = document.getElementById('withdrawAmount');

        // Set max attribute dynamically
        withdrawAmountInput.setAttribute('max', {{ $wallet->balance - $wallet->deduct_balance }});

        // Add event listener to validate on change
        withdrawAmountInput.addEventListener('input', function() {
            let maxWithdraw = {{ $wallet->balance - $wallet->deduct_balance }};
            if (parseFloat(this.value) > maxWithdraw) {
                this.value = maxWithdraw.toFixed(2); // Set value to max allowed
            }
        });
    });
</script>
