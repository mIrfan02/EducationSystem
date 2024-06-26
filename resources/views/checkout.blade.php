<!-- Assuming this is your checkout.blade.php or similar view file -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>

    <!-- Display total price retrieved from sessionStorage -->
    <p>Total Price: <span id="total-price"></span></p>

    <!-- Payment form -->
    <form id="payment-form">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="hidden" name="email" value="{{ $user->email }}">

        <!-- Stripe Elements placeholder for card details -->
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>

        <button type="submit" class="btn btn-primary mt-3" id="submit-button">Pay Now</button>
    </form>
</div>

<!-- Include Stripe.js library -->
<script src="https://js.stripe.com/v3/"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Retrieve total price from sessionStorage
        const totalPrice = sessionStorage.getItem('total_price');

        // Display total price in the UI
        if (totalPrice) {
            document.getElementById('total-price').textContent = `$${totalPrice}`;
        } else {
            document.getElementById('total-price').textContent = 'Price not available';
        }

        // Set your publishable key
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();

        // Create an instance of the card Element
        var card = elements.create('card');

        // Add an instance of the card Element into the `card-element` div
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createPaymentMethod({
                type: 'card',
                card: card,
                billing_details: {
                    email: '{{ $user->email }}'
                }
            }).then(function(result) {
                if (result.error) {
                    // Show error in card form
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // PaymentMethod created successfully, proceed to server-side processing
                    var paymentMethod = result.paymentMethod;
                    handlePayment(paymentMethod);
                }
            });
        });

        // Function to handle payment on the server
        function handlePayment(paymentMethod) {
            var formData = new FormData();
            formData.append('payment_method_id', paymentMethod.id);
            formData.append('user_id', '{{ $user->id }}');
            formData.append('email', '{{ $user->email }}');
            formData.append('total_price', totalPrice); // Include total price in the form data

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
                    // Payment successful, redirect or show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Payment Successful',
                        text: 'Thank you for your payment.',
                        onClose: () => {
                            window.location.href = '/';
                        }
                    });
                } else {
                    // Payment failed, show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Payment Failed',
                        text: 'Failed to process your payment.',
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
