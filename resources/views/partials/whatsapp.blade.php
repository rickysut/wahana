<style>
	.whatsapp-button {
		display: inline-block;
		padding: 10px 20px;
		border-radius: 5px;
		font-size: 16px;
		font-weight: bold;
		text-decoration: none;
		color: #ffffff;
		background: linear-gradient(to bottom, #FFC421, #F2BA1F);
		/* Replace these colors with your desired gradient */
		border: none;
		outline: none;
		cursor: pointer;
	}

	/* Change the color when the button is hovered */
	.whatsapp-button:hover {
		background: linear-gradient(to bottom, #F2BA1F, #E6B01E);
		/* Reverse the gradient colors on hover */
		color: #ffffff;
	}
</style>

<a class="whatsapp-button" href="https://wa.me/{{ $number }}" target="_blank">Contact Us</a>