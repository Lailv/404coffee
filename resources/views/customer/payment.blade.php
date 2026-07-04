@extends('customer.layouts.app')

@section('title', 'Payment | 404.Coffee')

@section('content')

<div class="container py-5 text-center">

    <h2>Processing Payment...</h2>

    <p>Please wait, Midtrans payment popup will appear automatically.</p>

</div>

@endsection

@push('scripts')

<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>

fetch("{{ route('customer.payment.pay', $order) }}", {

    method: "POST",

    headers: {

        "X-CSRF-TOKEN": "{{ csrf_token() }}",

        "Accept": "application/json"

    }

})
.then(response => response.json())
.then(result => {

    snap.pay(result.snap_token, {

        onSuccess: function(result){

            fetch("{{ route('customer.payment.success', $order) }}", {

                method: "POST",

                headers: {

                    "X-CSRF-TOKEN": "{{ csrf_token() }}",

                    "Accept": "application/json"

                }

            })
            .then(response => response.json())
            .then(() => {

                alert("Payment Success");

                window.location.href = "{{ route('customer.menu') }}";

            });

        },

        onPending: function(result){

            alert("Waiting for payment");

        },

        onError: function(result){

            alert("Payment Failed");

        },

        onClose: function(){

            alert("Payment popup closed.");

        }

    });

});

</script>

@endpush