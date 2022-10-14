<?php $koneksi = mysqli_connect("localhost","root","","db_mlm"); ?>
<?php 
  $parent = $_GET['parent'];

// echo "$parent";
$total = 0;
 ?>

<?php
$data=$koneksi->query("SELECT id, nama
						FROM member 
						WHERE parent = '$parent'
						GROUP BY id
						ORDER BY nama");
	while($tampilkan=$data->fetch_assoc()){
	$id_level2 = $tampilkan['id'];    
	$total = $total + 1;         	
                  ?>
		<?php
		$data2=$koneksi->query("SELECT id, nama
								FROM member 
								WHERE parent = '$id_level2'
								GROUP BY id
								ORDER BY nama");
			while($tampilkan2=$data2->fetch_assoc()){
				$total = $total + 0.5; 
		?>
		<?php } ?> 
<?php } ?> 
<div class="input-group mb-3">
  <span class="input-group-text">$</span>
  <input type="text" class="form-control" value="<?= $total; ?>">
</div>
