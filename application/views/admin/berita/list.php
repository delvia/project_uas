<p>
    <a href="<?php echo base_url ('admin/berita/tambah') ?>" class="btn btn-success btn-lg">
        <i class="fa fa-plus"></i> Tambah Baru
    </a>
</p>

<?php
//notif
if($this->session->flashdata('sukses')) {
    echo '<p class="alert alert-success">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
    
}

?>

<table class="table table-bordered" id="example1"> 
    <thead>
        <tr>
            <th>NO</th>
            <th>GAMBAR</th>
            <th>JUDUL BERITA</th>
            <th>SLUG BERITA</th>
            <th>KETERANGAN</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($berita as $berita) { ?>
        <tr>
                <td><?php  echo $no ?></td>
                <td>
                    <img src="<?php echo base_url('assets/upload/image/thumbs/'.$berita->gambar) ?>" class=
                    "img img-responsive img-thumbnail" width="60">
                </td> 
           
            <td><?php echo $berita->judul_berita ?></td>
            <td><?php echo $berita->slug_berita ?></td>
           
            <td>

                <a href="<?php echo base_url('admin/berita/gambar/'.$berita->id_berita) ?>" 
                class="btn btn-success btn-xs"><i class="fa fa-image"></i> Gambar(<?php echo 
                $berita->total_gambar ?>)</a>

                <a href="<?php echo base_url('admin/berita/edit/'.$berita->id_berita) ?>" 
                class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
               
                <?php include ('delete.php') ?> 
            </td>
        </tr>
        <?php $no++; } ?>
    </tbody>
</table>




