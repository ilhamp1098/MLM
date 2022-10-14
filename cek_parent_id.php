<?php $koneksi = mysqli_connect("localhost","root","","db_mlm"); ?>
<?php 
  $parent = $_GET['parent'];

  // echo "$parent";

 ?>

    <div class="input-group mb-3">
                  <select class="form-select" id="parent_id" name="parent_id">
                    <option value="0">Tanpa Parent</option>
                      <?php
                      $data=$koneksi->query("SELECT id, nama
                                                      FROM member 
                                                      WHERE (id<>'$parent'
                                                      and parent<>'$parent')
                                                      GROUP BY id
                                                      ORDER BY nama");
                      while($tampilkan=$data->fetch_assoc()){
                      ?>
                  <option value="<?php echo $tampilkan['id']; ?>"><?php echo $tampilkan['nama']; ?></option>
                  <?php } ?>                       
                  </select>  
    </div>