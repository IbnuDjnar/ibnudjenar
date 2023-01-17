<?php
$servername = "localhost";
$database = "db_fpti";
$username = "root";
$password = "";
 
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
    }
echo "Koneksi berhasil";

if (isset($_POST['bsimpan']))
{

if ($_GET['hal'] == "edit")
{
$edit =mysqli_query($conn, "UPDATE db_atlit set
							nik = '$_POST[tnik]',
							nama = '$_POST[tnama]',
							tanggallahir = '$_POST[ttanggallahir]',
							alamat = '$_POST[talamat]'
							WHERE id_atlit = '$_GET[id]'
								");
	if($edit)
	{
		echo "<script>
				alert('edit data SUKSESS');
				document.location='index.php';
				</script>";
	}
	else
	{
		echo "<script>
				alert('edit data GAGAL');
				document.location='index.php';
				</script>";
	}
}else
{
		$Simpan =mysqli_query($conn, "INSERT INTO db_atlit (nik, nama, tanggallahir, alamat)
								VALUES ('$_POST[tnik]',
								'$_POST[tnama]',
								'$_POST[ttanggallahir]',
								'$_POST[talamat]')
								");
	if($conn)
	{
		echo "<script>
				alert('Simpan data SUKSESS');
				document.location='index.php';
				</script>";
	}
	else
	{
		echo "<script>
				alert('Simpan data GAGAL');
				document.location='index.php';
				</script>";
	}
}


}
if(isset($_GET['hal']))
{
	if($_GET['hal'] == "edit")
	{
		$link = mysqli_query($conn, "SELECT * FROM db_atlit WHERE id_atlit = '$_GET[id]'");
		$data = mysqli_fetch_array($link);
		if($data)
		{
			$vnik = $data['nik'];
			$vnama =$data['nama'];
			$vtanggallahir =$data['tanggallahir'];
			$valamat =$data['alamat'];
		}
	}
	else if ($_GET['hal'] == "hapus")
	{
		$hapus = mysqli_query($conn, "DELETE FROM db_atlit WHERE id_atlit= '$_GET[id]' "); if ($hapus) {
			echo "<script>
				alert(hapus data SUKSESS');
				document.location='index.php';
				</script>";
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Data mahasiswa 2023</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
<h1 class="text-center">CRUD DATA ATLIT</h1>
<h2 class="text-center">Achmad Ibnu Djenar</h2>

	<div class="card">
	  <div class="card-header bg-black text-white">
	    form Input Data ATLIT
	  </div>
	  <div class="card-body">
	  	<form method="post" action="">
	  		<div class="form-group">
	  			<label>Nik</label>
	  			<input type="text" name="tnik" value="<?=@$vnik?>" class="form-control" placeholder="Input Nik anda!" required>
	  		</div>
	  		<div class="form-group">
	  			<label>Nama</label>
	  			<input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Input Nama anda!" required>
	  		</div>

			<div class="form-group">
	  			<label>Tanggal Lahir </label>
	  			<input type="date" name="ttanggallahir" value= "<?=@$vtanggallahir?>" class="form-control" >
	  		</div>

			<div class="form-group">
	  			<label>Alamat</label>
	  			<textarea class="form-control" name="talamat" placeholder="Input Alamat anda!"><?=@$valamat?></textarea>
	  		</div>

	  		<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
	  		<button type="reset" class="btn btn-danger" name="breset">Reset</button>
	  	</form>
	  </div>
	</div>

		<div class="card">
	  <div class="card-header bg-dager text-black">
	    Daftar ATLIT
	  </div>
	  <div class="card-body">
	  	<table class="table table-bordered table-striped">
	  		<tr>
	  			<th>no</th>
	  			<th>nik</th>
	  			<th>nama</th>
	  			<th>tanggalLahir</th>
	  			<th>alamat</th>
	  			<th>Aksi</th>
	  		</tr>
			<?php
			$no = 1;
			$link = mysqli_query($conn, "SELECT * from db_atlit order by id_atlit desc");
			while ($data = mysqli_fetch_array($link)) :
						?>
	  		<tr>
	  			<td><?=$no++;?></td>

	  			<td><?=$data['nik']?></td>
	  			<td><?=$data['nama']?></td>
	  			<td><?=$data['tanggallahir']?></td>
	  			<td><?=$data['alamat']?></td>
	  			<td>
	  				<a href="index.php?hal=edit&id=<?=$data['id_atlit']?>"class="btn btn-success"> edit</a>
	  				<a href="index.php?hal=hapus&id=<?=$data['id_atlit']?>" onclick="return confirm('Anda yakin?')"  class="btn btn-danger"> Hapus</a>
	  			</td>
	  		</tr>
	  	<?php endwhile;?>
	  	</table>
	  </div>
	</div>
	</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>