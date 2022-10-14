<?php include "header.php"; ?>   




  <main class="px-3">

	<label class="form-label">Registrasi Member Baru</label>
<div class="container">
<form method="POST">
  <div class="row align-items-start">
    <div class="col">
		<label for="basic-url" class="form-label float-start">Nama Member</label>
		<div class="input-group mb-3">
		  <input type="text" class="form-control" id="nama" name="nama">
		</div>
    </div>
    <div class="col">
		<label for="basic-url" class="form-label float-start">Pilih Parent</label>
		<div class="input-group mb-3">
		              <select class="form-select" id="parent" name="parent">
		              	<option value="0|0">Tanpa Parent</option>
		                  <?php
		                  $data=$koneksi->query("SELECT id, nama
		                                                  FROM member 
		                                                  GROUP BY id
		                                                  ORDER BY nama");
		                  while($tampilkan=$data->fetch_assoc()){
		                  ?>
		              <option value="<?php echo $tampilkan['id']; ?>"><?php echo $tampilkan['nama']; ?></option>
		              <?php } ?>                       
		              </select>  
		</div> 
    </div>
    <div class="col">
		<label for="basic-url" class="form-label float-start">Aksi</label>    	
		<div class="input-group mb-3 d-grid gap-2">
		  <button type="submit" class="btn btn-primary" id="simpan" name="simpan">
		  	Simpan
		  </button>
		</div>  
    </div>
  </div>
</form>  
</div>  	
<?php
    if(isset($_POST["simpan"])){
  
  $nama = $_POST["nama"];
  $parent = $_POST["parent"];

  $sql=$koneksi->query("INSERT INTO member (id,nama,parent)
      VALUES (null,'$nama','$parent')");

    if ($sql) {
      echo "<script>alert('data berhasil ditambah');</script>";
    echo "<script>location='index.php';</script>";
    }else{
      echo "<script>alert('data gagal ditambah');</script>";
    echo "<script>location='index.php';</script>";
  }
    }


?>




<div class="container mt-4">
	<div class="row">
		<label class="form-label float-start">Perhitungan Bonus</label>
		<div class="col-6">
			<label class="form-label float-start">Pilih Member</label>
			<div class="input-group mb-3">
			              <select class="form-select" id="id_parent" name="id_parent">
			                  <?php
			                  $data=$koneksi->query("SELECT id, nama 
			                                                  FROM member 
			                                                  GROUP BY id
			                                                  ORDER BY nama");
			                  while($tampilkan=$data->fetch_assoc()){
			                  ?>
			              <option value="<?php echo $tampilkan['id']; ?>"><?php echo $tampilkan['nama']; ?></option>
			              <?php } ?>                       
			              </select>  


			</div>
		</div>
		<div class="col-6">
		  <label class="form-label float-start">Jumlah Bonus</label>
			<div id="tabel_parent" name="tabel_parent"></div>

		</div>

	</div>
</div>





	<label class="form-label mt-4">Migrasi Member</label>
<div class="container">
<form method="POST">
  <div class="row align-items-start">
    <div class="col">
		<label for="basic-url" class="form-label float-start">Pilih Member</label>

		<div class="input-group mb-3">
		              <select class="form-select" id="member_id" name="member_id">
		                  <?php
		                  $data=$koneksi->query("SELECT id, nama
		                                                  FROM member 
		                                                  GROUP BY id
		                                                  ORDER BY nama");
		                  while($tampilkan=$data->fetch_assoc()){
		                  ?>
		              <option value="<?php echo $tampilkan['id']; ?>"><?php echo $tampilkan['nama']; ?></option>
		              <?php } ?>                       
		              </select>  
		</div>
    </div>
    <div class="col">
		<label for="basic-url" class="form-label float-start">Pilih Parent</label>
		<div id="tabel_parent_id" name="tabel_parent_id"></div>
    </div>
    <div class="col">
		<label for="basic-url" class="form-label float-start">Aksi</label>    	
		<div class="input-group mb-3 d-grid gap-2">
		  <button type="submit" class="btn btn-primary" id="migrasi" name="migrasi">
		  	Simpan
		  </button>
		</div>  
    </div>
  </div>
</form>  
<?php
    if(isset($_POST["migrasi"])){
  
  $parent_id = $_POST["parent_id"];
  $member_id = $_POST["member_id"];

  $sql=$koneksi->query("UPDATE member SET parent = '$parent_id' WHERE id = '$member_id' ");

    if ($sql) {
      echo "<script>alert('data berhasil dimigrasi');</script>";
    echo "<script>location='index.php';</script>";
    }else{
      echo "<script>alert('data gagal dimigrasi');</script>";
    echo "<script>location='index.php';</script>";
  }
    }


?>
</div>  

  </main>
<?php include "footer.php"; ?>  


<script type="text/javascript">
    $(document).ready(function(){

        $('#id_parent').change(function(){

            //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
            var parent = $('#id_parent').val();
            
            $.ajax({
                type : 'GET',
                url : 'cek_parent.php',
                data :  'parent=' + parent,
                    success: function (data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    $("#tabel_parent").html(data);
                }
                
            });
        });

        $('#id_parent').ready(function(){

            //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
            var parent = $('#id_parent').val();
            
            $.ajax({
                type : 'GET',
                url : 'cek_parent.php',
                data :  'parent=' + parent,
                    success: function (data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    $("#tabel_parent").html(data);
                }
                
            });
        });        
    });
</script> 

<script type="text/javascript">
    $(document).ready(function(){

        $('#member_id').change(function(){

            //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
            var parent = $('#member_id').val();
            
            $.ajax({
                type : 'GET',
                url : 'cek_parent_id.php',
                data :  'parent=' + parent,
                    success: function (data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    $("#tabel_parent_id").html(data);
                }
                
            });
        });

        $('#member_id').ready(function(){

            //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
            var parent = $('#member_id').val();
            
            $.ajax({
                type : 'GET',
                url : 'cek_parent_id.php',
                data :  'parent=' + parent,
                    success: function (data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    $("#tabel_parent_id").html(data);
                }
                
            });
        });        
    });
</script> 