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
			tr:nth-child(even) {
				background: #F0F0F0;
			}
		</style>
	</head>
	<body>
		<h1 style="font-size: 21px; margin-bottom: 0; text-align: center;">{{ $shipping -> shop -> shop_name }}</h1>
		<p style="margin-top: 0; text-align: center;">Solicitud de envío #{{ $shipping -> id }}</p>

		<table border="0" cellspacing="0" cellpadding="10" width="100%" style="margin-bottom: 30px">
			<thead style="font-size: 12px; text-transform: uppercase;">
				<tr>
					<th style="text-align: left;">Cliente</th>
					<th style="text-align: left;">Pedido</th>
					<th>Cant. de productos</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($shipping -> orders as $order)
					<tr>
						<td style="border-bottom: 1px dashed #CCC; padding: 5px 8px;">{{ $order -> customer_name }}</td>
						<td style="border-bottom: 1px dashed #CCC; padding: 5px 8px;">#{{ str_pad($order -> id, 8, '0', STR_PAD_LEFT) }}</td>
						<td style="border-bottom: 1px dashed #CCC; padding: 5px 0; text-align: center;">{{ $order -> products -> sum('quantity') }}</td>
						<td style="border-bottom: 1px dashed #CCC; padding: 5px 0;">
							<input type="checkbox" name="">
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<table border="0" cellspacing="0" cellpadding="10" width="100%" style="border: 1px solid #CCC;">
			<tr>
				<td style="border-right: 1px solid #CCC;">
					Armado:
				</td>
				<td>
					Control:
				</td>
			</tr>
		</table>

		<script type="text/javascript">
			window.print();
		</script>
	</body>
</html>