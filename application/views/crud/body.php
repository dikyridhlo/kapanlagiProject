<body>
	<div class="container">
	<h2>TES KAPANLAGI</h2>	
	<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#datamodal">
    INSERT DATA
  </button>
	<a href="<?php echo base_url('kapanlagi/encode') ?>" title="" class="btn btn-sm btn-success">ENCODE NOW!</a>


  <!-- The Modal -->
  <div class="modal" id="datamodal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">INSERT DATA</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form class="form" action="<?php echo base_url('kapanlagi/insert') ?>" method="post" enctype="multipart/form-data" id="#insert">
          	<div class="form-group" id="namagroup">
	          	<label for="nama">NAMA</label>
	          	<input type="text" name="nama" class="form-control" id="nama">
	          	<div class="invalid-feedback">
	          		MUST ALPHABET !
	          	</div>
          	</div>
          	<div class="form-group">
	          	<label for="tl">TANGGAL LAHIR</label>
	          	<input type="date" name="tl" class="form-control" id="tgl">

          	</div>
          	<div class="form-group">
	          	<label for="alamat">ALAMAT</label>
	          	<textarea name="alamat" class="form-control" id="alamat"></textarea>
	          	<div class="invalid-feedback">
	          		ONLY ALPHANUMERIC !
	          	</div>
          	</div>
          	<div class="form-group">
	          	<label for="email">EMAIL</label>
	          	<input type="email" name="email" class="form-control">
          	</div>
          	<div class="form-group">
	          	<label for="image">IMAGE</label>
	          	<input type="file" name="image" class="form-control" accept=".jpg" id="image" max="1">
          	</div>
          </div>
          	<div class="modal-footer">
          		<button type="submit" class="btn btn-md btn-success" id="submit">Submit</button>
          		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        	</div>
        </form>
        
        <!-- Modal footer -->
        
        
      </div>
    </div>
  </div>
	<table class="table">
		<tr>
			<th>NO</th>
			<th>NAMA</th>
			<th>ALAMAT</th>
			<th>TANGGAL LAHIR</th>
			<th>EMAIL</th>
			<th>ACTION</th>
		</tr>
		<?php $i=0; foreach ($data as $key): ?>
		<tr>
			
			<td><?php echo ++$i;?></td>
			<td><?php echo $key['NAMA'] ?></td>
			<td><?php echo $key['ALAMAT'] ?></td>
			<td><?php echo $key['TGL_LAHIR'] ?></td>
			<td><?php echo $key['EMAIL'] ?></td>
			<td>
				<button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#updatemodal<?php echo $key['ID'] ?>"><i class="fa fa-pencil"></i></button>
				<a href="<?php echo base_url('kapanlagi/delete').'?id='.$key['ID'] ?>" title="" class="btn btn-md btn-danger"><i class="fa fa-trash-o"></i></a>

			</td>
		</tr>

		<!-- VIEW PHOTO -->
		<div id="viewphoto<?php echo $key['ID'] ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <img src="<?php echo $key[0]['FOTO'] ?>" alt="">
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>


		<!-- UPDATE MODAL -->
		<div class="modal" id="updatemodal<?php echo $key['ID'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">UPDATE DATA <?php echo $key['NAMA'] ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form class="form" action="<?php echo base_url('kapanlagi/update') ?>" method="post" enctype="multipart/form-data" id="#update">
          	<div class="form-group" id="namagroup">
          		<input type="hidden" name="id" value="<?php echo $key['ID'] ?>">
	          	<label for="nama">NAMA</label>
	          	<input type="text" name="upnama" class="form-control" id="nama" value="<?php echo $key['NAMA'] ?>">
	          	<div class="invalid-feedback">
	          		MUST ALPHABET !
	          	</div>
          	</div>
          	<div class="form-group">
	          	<label for="tl">TANGGAL LAHIR</label>
	          	<input type="date" name="uptl" class="form-control" id="tgl" value="<?php echo $key['TGL_LAHIR'] ?>">

          	</div>
          	<div class="form-group">
	          	<label for="alamat">ALAMAT</label>
	          	<textarea name="upalamat" class="form-control" id="alamat"><?php echo $key['ALAMAT'] ?></textarea>
	          	<div class="invalid-feedback">
	          		ONLY ALPHANUMERIC !
	          	</div>
          	</div>
          	<div class="form-group">
	          	<label for="email">EMAIL</label>
	          	<input type="email" name="upemail" class="form-control" value="<?php echo $key['EMAIL'] ?>">
          	</div>
          	<div class="form-group">
	          	<label for="image">IMAGE</label>
	          	<input type="file" name="upimage" class="form-control" accept=".jpg" id="image" required>
          	</div>
          </div>
          	<div class="modal-footer">
          		<button type="submit" class="btn btn-md btn-success" id="submit">Submit</button>
          		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        	</div>
        </form>
        
        <!-- Modal footer -->
        
        
      </div>
    </div>
  </div>
		<?php endforeach ?>
	</table>
	</div>
	

<script>
	
	$(document).ready(function() {
		$('#insert').submit(function(event) {
			var name = $('#nama').val();
			var email = $('#email').val();
			var alamat = $('#alamat').val();
			// var size = $('#image')[0].files[0].fileSize;

			if (/[^a-zA-Z]/.test(name) || name == '') {
				$('#nama').addClass('is-invalid');
				event.preventDefault();
			}else if (/[^a-zA-Z0-9 ]/.test(alamat) || alamat == '') {
				$('#alamat').addClass('is-invalid');
				event.preventDefault();
			}else{
				// alert(size);
				return;
			}

		});
		$('#update').submit(function(event) {
			var name = $('#nama').val();
			var email = $('#email').val();
			var alamat = $('#alamat').val();
			// var size = $('#image')[0].files[0].fileSize;

			if (/[^a-zA-Z]/.test(name) || name == '') {
				$('#nama').addClass('is-invalid');
				event.preventDefault();
			}else if (/[^a-zA-Z0-9 ]/.test(alamat) || alamat == '') {
				$('#alamat').addClass('is-invalid');
				event.preventDefault();
			}else{
				// alert(size);
				return;
			}

		});
	});
	
</script>
</body>
</html>