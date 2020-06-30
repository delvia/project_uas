<?php
//notif error
echo validation_errors('<div class="alert alert-warning">','</div>');

//form open
echo form_open(base_url('admin/pelanggan/edit/'.$pelanggan->id_pelanggan),' class="form-horizontal"');
?>
   <div class="form-group row">
    <label class="col-md-2 col-form-label">Nama Pelanggan</label>
    <div class="col-md-5">
        <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Pelanggan" value=
        "<?php echo $pelanggan->nama_pelanggan ?>" required>
    </div>
    </div>

    <div class="form-group row">
    <label class="col-md-2 col-form-label">Email</label>
    <div class="col-md-5">
        <input type="text" name="email" class="form-control" placeholder="Email Pelanggan" value=
        "<?php echo $pelanggan->email ?>" required>
    </div>
    </div>

    <div class="form-group row">
    <label class="col-md-2 col-form-label">Password</label>
    <div class="col-md-5">
        <input type="password" name="password" class="form-control" placeholder="Password" value=
        "<?php echo  $pelanggan->password ?>" required>
    </div>
    </div>

    <div class="form-group row">
    <label class="col-md-2 col-form-label">Telepon</label>
    <div class="col-md-5">
        <input type="text" name="telepon" class="form-control" placeholder="Telepon" value=
        "<?php  echo $pelanggan->telepon ?>" readonlye>
    </div>
    </div>


    

    <div class="form-group row">
    <label class="col-md-2 col-form-label">Alamat</label>
    <div class="col-md-5">
        <input type="text" name="alamat" class="form-control" placeholder="Alamat Pelanggan" value=
        "<?php echo $pelanggan->alamat ?>" required>
    </div>
    </div>
    
  
    <div class="form-group row">
    <label class="col-md-2 col-form-label"></label>
    <div class="col-md-5">
       <button class="btn btn-success btn-lg" name="submit" type="submit">
            <i class="fa fa-save"></i> Simpan
        </button>
        <button class="btn btn-info btn-lg" name="reset" type="reset">
            <i class="fa fa-times"></i> Reset
        </button>
    </div>
    </div>
   

<?php echo form_close(); ?>


