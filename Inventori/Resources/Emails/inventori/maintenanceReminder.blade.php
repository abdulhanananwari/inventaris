<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p>Maintenance : {{ $viewData['inventori']->nama_inventaris }}</p>

	<p>Terakhir Maintenance Pada Tanggal : {{ $viewData['inventori']->created_at->toDateTimeString() }}</p>
</body>
</html>