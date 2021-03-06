<?php 
///error upload
if(isset($error)) {
    echo  '<p class="alert alert-warning">';
    echo $error;
    echo '</p>';
}



//notif error
echo validation_errors('<div class="alert alert-warning">','</div>');

//form open
echo form_open_multipart(base_url('admin/berita/edit/'.$berita->id_berita),' class="form-horizontal"');
?>

<div class="form-group row">
    <label class="col-md-2 col-form-label">Jenis Berita</label>
    <div class="col-md-5">
        <input type="text" name="jenis_berita" class="form-control" placeholder="Jenis Berita" value=
        "<?php echo $berita->jenis_berita ?>" required>
    </div>
    </div>

   <div class="form-group row">
    <label class="col-md-2 col-form-label">Judul Berita</label>
    <div class="col-md-5">
        <input type="text" name="judul_berita" class="form-control" placeholder="Judul Berita" value=
        "<?php echo $berita->judul_berita ?>" required>
    </div>
    </div>

   

    <div class="form-group row">
    <label class="col-md-2 col-form-label">Slug Berita</label>
    <div class="col-md-5">
        <input type="text" name="slug_berita" class="form-control" placeholder="Slug Berita" value=
        "<?php echo $berita->slug_berita ?>" required>
    </div>
    </div>

    <div class="form-group row">
    <label class="col-md-2 col-form-label">Keyword (untuk SEO Google)</label>
    <div class="col-md-10">
        <textarea name="keywords"  class="form-control" placeholder="Keyword (untuk SEO Google)">
        <?php echo $berita->keywords ?> </textarea>
    </div>
    </div>


    
    <div class="form-group row">
    <label class="col-md-2 col-form-label">Keterangan</label>
    <div class="col-md-5">
        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" value=
        "<?php echo $berita->keterangan ?>" required>
    </div>
    </div>

   

    <div class="form-group row">
    <label class="col-md-2 col-form-label">Upload Gambar Produk</label>
    <div class="col-md-10">
    <input type="file" name="gambar" class="form-control"  required= "<?php echo $berita->gambar ?>" required >
   
       Gambar lama:  <br>
        <img src="<?php  echo base_url('assets/upload/image/'.$berita->gambar)?>" class="
       img img-responsive img-thumbnail" width="200">
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


