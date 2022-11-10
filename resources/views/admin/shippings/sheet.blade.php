<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Hoja de impresión</title>

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
		<style type="text/css">
			* { font-family: 'Poppins', Arial, sans-serif; }
			strong {
				font-weight: 600;
			}
		</style>
	</head>
	<body>
		@foreach ($shipping -> orders as $order)
			<table border="0" cellspacing="0" cellpadding="10" width="100%" bgcolor="#F0F0F0" style="margin-bottom: 10px">
				<tr>
					<td>
						<strong>Cliente:</strong> {{ $order -> customer_name }}
					</td>
					<td align="right">
						Pedido <strong>#{{ str_pad($order -> id, 8, '0', STR_PAD_LEFT) }}</strong>
					</td>
				</tr>
			</table>

			<table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-bottom: 10px;">
				<thead style="font-size: 12px; text-transform: uppercase;">
					<tr>
						<th style="text-align: left;">Producto</th>
						<th style="text-align: left;">SKU</th>
						<th>Cantidad</th>
						<th style="text-align: right;">Precio</th>
						<th style="text-align: right;">Subtotal</th>
					</tr>
				</thead>

				<tbody style="font-size: 14px;">
					@foreach($order -> products -> sortBy('sku') as $item)
						<tr valign="middle">
							<td style="border-bottom: 1px dashed #CCC; padding: 5px 0;">
									{{ $item -> product_name }}
									@if ( $item -> variation )
										<span class="fs-12">
											@php $variation = json_decode($item -> variation, true); @endphp
											@isset ( $variation['size'] )
												<br>Talle: {{ $variation['size'] }}
											@endisset
											@isset ( $variation['color'] )
												<br>Color: <span class="d-inline-block ratio ratio-1x1 border rounded-circle position-relative" style="width: 16px; top: 3px; background: {{ $variation['color'] }}"></span>
											@endisset
										</span>
									@endif
								</div>
							</td>
							<td style="border-bottom: 1px dashed #CCC;">{{ $item -> sku }}</td>
							<td style="border-bottom: 1px dashed #CCC; text-align: center;">{{ $item -> quantity }}</td>
							<td style="border-bottom: 1px dashed #CCC; text-align: right;">$ {{ number_format(($item -> price_sale > 0) ? $item -> price_sale : $item -> price_regular, 2, '.', ',') }}</td>
							<td style="border-bottom: 1px dashed #CCC; text-align: right;">
								$ {{ number_format((($item -> price_sale > 0) ? $item -> price_sale : $item -> price_regular) * $item -> quantity, 2, '.', ',') }}
							</td>
						</tr>
					@endforeach

					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td style="text-align: right;">Subtotal</td>
						<td style="text-align: right;">$ {{ number_format($order -> subtotal, 2, '.', ',') }}</td>
					</tr>

					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td style="text-align: right;">Envío</td>
						<td style="text-align: right;">{{ ($order -> shipping_type == 1) ? 'A coordinar' : '$ ' . number_format( $order -> shipping_cost, 2, '.', ',') }}</td>
					</tr>

					<tr class="fs-18 text-white">
						<td></td>
						<td></td>
						<td></td>
						<td style="text-align: right;">Total</td>
						<td style="text-align: right;">$ {{ number_format($order -> total, 2, '.', ',') }}</td>
					</tr>
				</tbody>
			</table>

			@if ( $order -> shipping_type == 2  )
				<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border: 1px dashed #CCC; margin-bottom: 30px; font-size: 14px; line-height: 1.5; padding: 10px">
					<tr>
						<td><strong>Nombre y Apellido:</strong> {{ $order -> customer_name }}</td>
						<td><strong>Dirección:</strong> {{ $order -> customer_address }} {{ $order -> customer_number }}</td>
					</tr>
					<tr>
						<td><strong>DNI:</strong> {{ $order -> customer_doc }}</td>
						<td><strong>Localidad:</strong> {{ $order -> customer_city }}</td>
					</tr>
					<tr>
						<td><strong>Teléfono:</strong> {{ $order -> customer_phone }}</td>
						<td><strong>Provincia:</strong> {{ $order -> customer_province }}</td>
					</tr>
					<tr>
						<td><strong>Email:</strong> {{ $order -> customer_email }}</td>
						<td><strong>Cod. Postal:</strong> {{ $order -> customer_zip }}</td>
					</tr>
				</table>
			@else
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td>
							<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border: 1px dashed #CCC; font-size: 14px; line-height: 1.5; padding: 10px">
								<tr>
									<td><strong>Nombre y Apellido:</strong> {{ $order -> shop -> user -> name }}</td>
									<td><strong>Dirección:</strong> {{ $order -> shop -> user -> suscriber -> address }}</td>
								</tr>
								<tr>
									<td><strong>DNI:</strong> {{ $order -> shop -> user -> suscriber -> doc_number }}</td>
									<td><strong>Localidad:</strong> {{ $order -> shop -> user -> suscriber -> city }}</td>
								</tr>
								<tr>
									<td><strong>Teléfono:</strong> {{ $order -> shop -> user -> suscriber -> phone }}</td>
									<td><strong>Provincia:</strong> {{ $order -> shop -> user -> suscriber -> province }}</td>
								</tr>
								<tr>
									<td><strong>Email:</strong> {{ $order -> customer_email }}</td>
									<td><strong>Cod. Postal:</strong> {{ $order -> shop -> user -> suscriber -> zip }}</td>
								</tr>
							</table>
							<table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-bottom: 10px;">
								<tr>
									<td style="background-color: #000; padding: 10px; text-align: center; color: #FFF;"><strong>A COORDINAR</strong></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			@endif

			<hr>
		@endforeach
		

		<script type="text/javascript">
			window.print();
		</script>
	</body>
</html>