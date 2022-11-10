<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="color-scheme" content="light">
		<meta name="supported-color-schemes" content="light">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">

	</head>

	<body style="margin: 0; padding: 0;">
		<table border="0" cellspacing="0" cellpadding="0" width="100%" style="background: #ddd; padding: 80px 0; font-family: 'Poppins', Arial, sans-serif; font-size: 14px;">
			<tr>
				<td>
					
					<table border="0" cellspacing="0" cellpadding="0" width="600" style=" background: #fff" align="center">
						<tr>
							<td style="background-color: #2f3d9a; padding-bottom: 40px;" align="center">
								<img src="{{ asset('img/mail/ico-shop-mail.png') }}" style="margin: 40px 0;" width="96">
								<h1 style="color: #FFF; margin: 0">Pedido recibido</h1>
								<span style="color: #FFF">{{ $order -> created_at -> format('d/m/Y') }}</span>
							</td>
						</tr>
						<tr>
							<td style="padding: 30px 30px 0">
								<p style="font-weight: 600;">¡Hola {{ $order -> shop -> user -> name }}!</p>
								<p style="color: #666;">{{ $order -> customer_name }} ha creado un pedido el día {{ $order -> created_at -> format('d/m/Y') }}.<br>
									También podés ver el detalle en la tienda haciendo <a href="{{ route('panel.orders.index') }}">click aquí</a>.
								</p>
								<p style="color: red;">IMPORTANTE: Los pedidos que superen los 10 días sin ser aprobados y sin solicitud de envío, serán eliminados automáticamente del sistema.</p>
							</td>
						</tr>
						<tr>
							<td style="padding: 30px">
								<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
									<thead>
										<tr>
											<th width="32"></th>
											<th align="left">Producto</th>
											<th align="left">Precio</th>
											<th>Cantidad</th>
											<th align="right">Subtotal</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($order -> products as $item)
											<tr valign="middle">
												<td style="border-bottom: 1px solid #EEE; padding-bottom: 10px; padding-top: 10px;" width="32">
													<div style="background: url({{ asset( $item -> product -> image ?? 'img/shop/default.png' ) }}) no-repeat center center; background-size: cover; float: left; border-radius: 5px; overflow: hidden; margin-right: 8px;">
														<img src="{{ asset('img/mail/1-1.gif') }}" width="32">
													</div>
												</td>
												<td style="border-bottom: 1px solid #EEE; padding-bottom: 10px; padding-top: 10px;">
													{{ $item -> product_name }}
													<span style="font-size: 12px;">
														@if ( $item -> variation )
															@php $variation = json_decode($item -> variation, true); @endphp
															@isset ( $variation['size'] )
																<br>Talle: {{ $variation['size'] }}
															@endisset
															@isset ( $variation['color'] )
																<br>Color: <span style="border-radius: 8px; border: 1px solid #CCC; display: inline-block; height: 16px; position: relative; width: 16px; top: 3px; background: {{ $variation['color'] }}"></span>
															@endisset
														@endif
													</span>
												</td>
												<td style="border-bottom: 1px solid #EEE; padding-bottom: 10px; padding-top: 10px;">
													$ {{ number_format((($item -> price_sale > 0) ? $item -> price_sale : $item -> price_regular), 2, '.', ',') }}
												</td>
												<td style="border-bottom: 1px solid #EEE; padding-bottom: 10px; padding-top: 10px;" align="center">
													{{ $item -> quantity }}
												</td>
												<td align="right" style="border-bottom: 1px solid #EEE; padding-bottom: 10px; padding-top: 10px;">
													$ {{ number_format((($item -> price_sale > 0) ? $item -> price_sale : $item -> price_regular) * $item -> quantity, 2, '.', ',') }}
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>

								<table border="0" cellspacing="0" cellpadding="0" width="50%" align="right" style="margin-top: 10px; padding-top: 10px;">
									<tr style="color: #666; text-align: right;">
										<td>Subtotal</td>
										<td>$ {{ number_format($order -> subtotal, 2, '.', ',') }}</td>
									</tr>
									<tr style="color: #666; text-align: right;">
										<td>Envío</td>
										<td>{{ ($order -> shipping_type == 1) ? 'A coordinar' : '$ ' . number_format( $order -> shipping_cost, 2, '.', ',') }}</td>
									</tr>
									<tr style="font-weight: 600; font-size: 18px; text-align: right;">
										<td>Total</td>
										<td>$ {{ number_format($order -> total, 2, '.', ',') }}</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					<table border="0" cellspacing="0" cellpadding="0" width="600" align="center" style="padding-top: 15px;">
						<tr>
							<td style="color: #666; font-size: 11px; padding-right: 20px;">
								Este es un correo informativo por el pedido realizado en {{ url('/') }}/{{ $order -> shop -> slug }}.
							</td>
							<td align="right" style="white-space: nowrap;" valign="top">
								@if ( $order -> shop -> instagram )
									<a href="https://instagram.com/{{ $order -> shop -> instagram }}" target="_blank"><img src="{{ asset('img/mail/ico-ig.png') }}" width="32"></a>
								@endif
								@if ( $order -> shop -> facebook )
									&nbsp;&nbsp; <a href="https://fb.com/{{ $order -> shop -> facebook }}" target="_blank"><img src="{{ asset('img/mail/ico-fb.png') }}" width="32"></a>
								@endif
								@if ( $order -> shop -> whatsapp )
									&nbsp;&nbsp; <a href="https://wa.me/{{ $order -> shop -> whatsapp }}" target="_blank"><img src="{{ asset('img/mail/ico-wpp.png') }}" width="32"></a>
								@endif
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>