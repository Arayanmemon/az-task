<!DOCTYPE html>
<html>
	<head>
		<title>Stripe Payment</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-8 offset-md-2">
                    <div class="card m-3 px-3">
                        <h3 class="p-3">Package Details</h3>
                        <p class="text-2xl">Name: {{ $package->name }}</p>
                        <p class="text-gray-600">Description: {{ $package->description }}</p>
                        <p class="text-gray-600">Price: Rs.{{ $package->price }}</p>
                    </div>
					<div class="card mt-5">
						<h3 class="p-3">Buy Package</h3>
						<div class="card-body">
							@session('success')
							<div class="alert alert-success" role="alert"> 
								{{ $value }}
							</div>
							@endsession
							<form id='checkout-form' method='post' action="{{ route('checkout') }}">
                                @csrf    
                                <strong>Name:</strong>
                                <input type="input" class="form-control" name="name" placeholder="Enter Name">
                                <input type="hidden" name="price" value="{{ $package->price }}">
                                <input type='hidden' name='stripeToken' id='stripe-token-id'>                              
                                <br>
                                <div id="card-element" class="form-control" style="height: 50px;padding-top: 16px;"></div>
                                <button 
                                    id='pay-btn'
                                    class="btn btn-success mt-3"
                                    type="button"
                                    style="margin-top: 20px; width: 100%;padding: 7px;"
                                    onclick="createToken()">Pay Rs: {{ $package->price }}
                                </button>
							<form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="https://js.stripe.com/v3/"></script>
	<script type="text/javascript">
		var stripe = Stripe('{{ env('STRIPE_KEY') }}')
		var elements = stripe.elements();
		var cardElement = elements.create('card');
		cardElement.mount('#card-element');
		
		function createToken() {
		    document.getElementById("pay-btn").disabled = true;
		    stripe.createToken(cardElement).then(function(result) {
		
		        if(typeof result.error != 'undefined') {
		            document.getElementById("pay-btn").disabled = false;
		            alert(result.error.message);
		        }
		
		        /* creating token success */
		        if(typeof result.token != 'undefined') {
		            document.getElementById("stripe-token-id").value = result.token.id;
		            document.getElementById('checkout-form').submit();
		        }
		    });
		}
	</script>
</html>