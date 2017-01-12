<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<p>Nama Inventaris: {{ $viewData['inventori']->nama }}</p>

		<a href="{{url('redirect-angular/inventori/'.$viewData['inventori']->id)}}">Klik Disini</a>
</body>
</html>