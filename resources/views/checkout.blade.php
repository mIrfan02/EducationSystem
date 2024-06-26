@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>

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
        // Set your publishable key
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var totalprice = document.getElementById('total-amount');
        totalprice.value = sessionStorage.getItem('total_price');
        price = sessionStorage.getItem('total_price');

        // Custom styling can be passed to options when creating an Element.
        var style = {
            base: {
                fontSize: '16px',
                color: '#32325d',
                '::placeholder': {
                    color: '#aab7c4'
                },
            },
        };

        // Create an instance of the card Element.
        var card = elements.create('card', { style: style });

        // Add an instance of the card Element into the `card-element` div.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Collect additional information like cardholder name.
            var cardholderName = document.getElementById('cardholder-name').value;

            stripe.createPaymentMethod({
                type: 'card',
                card: card,
                billing_details: {
                    name: cardholderName,
                },
            }).then(function (result) {
                if (result.error) {
                    // Show error in card form.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // PaymentMethod created successfully, proceed to server-side processing.
                    var paymentMethod = result.paymentMethod;
                    handlePayment(paymentMethod);
                }
            });
        });

        // Function to handle payment on the server.
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
                    if (data.success) {
                        // Payment successful, show success message and redirect.
                        Swal.fire({
                            icon: 'success',
                            title: 'Payment Successful',
                            text: 'Thank you for your payment.',
                            onClose: () => {
                                window.location.href = '/';
                            }
                        });
                    } else {
                        // Payment failed, show error message.
                        Swal.fire({
                            icon: 'error',
                            title: 'Payment Failed',
                            text: data.message,
                        });
                    }
                })
                .catch(error => {
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
