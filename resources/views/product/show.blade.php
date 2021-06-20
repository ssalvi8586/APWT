<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product - ID</title>
</head>
<body>
    <h3> Product Details</h3>
	<table border="1">
		<tr>
            <td>ID</td>
			<td>{{$product['id']}}</td>
        </tr>
        <tr>
			<td>Product Name</td>
            <td>{{$product['pname']}}</td>
        </tr>
        <tr>
            <td>Brand</td>
			<td>{{$product['brand']}}</td>
        </tr>
        <tr>
			<td>Product Image</td>
            <td><img src="/upload/{{ $product['pimage'] }}" height="150px" width="210px" alt="Product Image"></td>
        </tr>
 	</table>
</body>
</html>
