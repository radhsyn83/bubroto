<style>
	#invoice-POS {
		box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
		padding: 2mm;
		margin: 0 auto;
		width: 44mm;
		background: #FFF;
	}

	#invoice-POS::selection {
		background: #f31544;
		color: #FFF;
	}

	#invoice-POS::moz-selection {
		background: #f31544;
		color: #FFF;
	}

	h1 {
		font-size: 1.5em;
		color: #222;
	}

	h2 {
		font-size: .9em;
	}

	h3 {
		font-size: 1.2em;
		font-weight: 300;
		line-height: 2em;
	}

	p {
		font-size: .7em;
		color: #666;
		line-height: 1.2em;
	}

	#top, #mid, #bot { /* Targets all id with 'col-' */
		border-bottom: 1px solid #EEE;
	}

	#top {
		min-height: 100px;
	}

	#mid {
		min-height: 40px;
	}

	#bot {
		min-height: 50px;
	}

	#top .logo {
		height: 60px;
		width: 60px;
		background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
		background-size: 60px 60px;
	}

	.clientlogo {
		float: left;
		height: 60px;
		width: 60px;
		background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
		background-size: 60px 60px;
		border-radius: 50px;
	}

	.info {
		display: block;
		margin-left: 0;
	}

	.title {
		float: right;
	}

	.title p {
		text-align: right;
	}

	table {
		width: 100%;
		border-collapse: collapse;
	}

	.tabletitle {
		font-size: .5em;
		background: #EEE;
	}

	.service {
		border-bottom: 1px solid #EEE;
	}

	.item {
		width: 24mm;
	}

	.itemtext {
		font-size: .5em;
	}

	#legalcopy {
		margin-top: 5mm;
	}
</style>
<div id="invoice-POS">

	<center id="top">
		<div class="logo"></div>
		<div class="info">
			<h2>Warung Bu Broto</h2>
		</div><!--End Info-->
	</center><!--End InvoiceTop-->

	<div id="mid">
		<div class="info">
			<p>
				Alamat : Jl. Dipatiukur No.12</br>
				No. Telp : (021) 44224</br>
			</p>
		</div>
	</div><!--End Invoice Mid-->

	<div id="bot">

		<p>Nomor Pembayaran: <b>#24</b></p>
		<div id="table">
			<table>
				<tr class="tabletitle">
					<td class="item"><h2>Makanan/Minuman</h2></td>
					<td class="Hours"><h2>Qty</h2></td>
					<td class="Rate"><h2>Sub Total</h2></td>
				</tr>

				<?php
					$total = 0;
					foreach ($row as $r) {
						$total = $total + ($r->jumlah * $r->harga);
						echo '
						<tr class="service">
							<td class="tableitem"><p class="itemtext">'.$r->nama.'</p></td>
							<td class="tableitem"><p class="itemtext">'.$r->jumlah.'</p></td>
							<td class="tableitem"><p class="itemtext">'.$r->harga.'</p></td>
						</tr>
						';
					}
				?>

				<tr class="tabletitle">
					<td></td>
					<td class="Rate""><h2>Total</h2></td>
					<td class="payment"><h2>Rp<?= number_format($total) ?></h2></td>
				</tr>

			</table>
		</div><!--End Table-->

		<div id="legalcopy">
			<p class="legal"><strong>Terimakasih</strong> 
			</p>
		</div>

	</div><!--End InvoiceBot-->
</div><!--End Invoice-->
