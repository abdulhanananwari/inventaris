<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<p>Nama Inventaris: {{ $viewData['inventori']->nama }}</p>

		<a href="http://192.168.0.43:10031/Angular/Inventori/index.html#/inventori/show/{{$viewData['inventori']->id }}">Klik Disini</a>
</body>
</html>