@extends('layouts.app')

@section('content')
<div class="container">
    <style>
        .spinner {
            width: 3rem;
            height: 3rem;
            border: 0.3rem solid #f3f3f3;
            border-top: 0.3rem solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .spinner-container {
            display: none; /* Hidden by default */
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: rgba(255, 255, 255, 0.8);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999;
        }
    </style>

    <h1>Checkout</h1>
    <div class="spinner-container" id="spinner-container">
        <div class="spinner"></div>
    </div>


    <!-- Display total amount as read-only -->
    <div class="mb-3">
        <label for="total-amount" class="form-label">Total Amount</label>
        <input type="text" id="total-amount" class="form-control" readonly>
    </div>

    <!-- Payment form -->
    <form id="payment-form">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="hidden" name="email" value="{{ $user->email }}">

        <!-- Cardholder name -->
        <div class="mb-3">
            <label for="cardholder-name" class="form-label">Cardholder Name</label>
            <input type="text" class="form-control" id="cardholder-name" required>
        </div>

        <!-- Card details (card number, expiry, CVV) -->
        <div id="card-element" class="mb-3">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary mt-3" id="submit-button">Pay Now</button>
    </form>
</div>

<!-- Include Stripe.js library -->
<script src="https://js.stripe.com/v3/"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var totalprice = document.getElementById('total-amount');
    totalprice.value = sessionStorage.getItem('total_price');
    var price = sessionStorage.getItem('total_price');
    var spinnerContainer = document.getElementById('spinner-container');

    var style = {
        base: {
            fontSize: '16px',
            color: '#32325d',
            '::placeholder': {
                color: '#aab7c4'
            },
        },
    };

    var card = elements.create('card', { style: style });
    card.mount('#card-element');

    card.addEventListener('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Show the spinner
        spinnerContainer.style.display = 'flex';

        var cardholderName = document.getElementById('cardholder-name').value;

        stripe.createPaymentMethod({
            type: 'card',
            card: card,
            billing_details: {
                name: cardholderName,
            },
        }).then(function (result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                spinnerContainer.style.display = 'none';
            } else {
                var paymentMethod = result.paymentMethod;
                handlePayment(paymentMethod);
            }
        });
    });

    function handlePayment(paymentMethod) {
        var formData = new FormData();
        formData.append('payment_method_id', paymentMethod.id);
        formData.append('user_id', '{{ $user->id }}');
        formData.append('email', '{{ $user->email }}');
        formData.append('total_price', price);

        fetch('/process-payment', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                spinnerContainer.style.display = 'none';

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Payment Successful',
                        text: 'Thank you for your payment.',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = data.redirect; // Redirect to the specified URL
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Payment Failed',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                spinnerContainer.style.display = 'none';

                console.error('Error processing payment:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to process your payment.',
                });
            });
    }
});


</script>
@endsection
