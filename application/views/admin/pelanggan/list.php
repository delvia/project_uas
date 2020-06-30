<p>
    <a href="<?php echo base_url ('admin/pelanggan/tambah') ?>" class="btn btn-success btn-lg">
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
            <th>NAMA</th>
            <th>EMAIL</th>
            <th>TELEPON</th>
            <th>ALAMAT</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($pelanggan as $pelanggan) { ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $pelanggan ->nama_pelanggan ?></td>
            <td><?php echo $pelanggan ->email ?></td>
            <td><?php echo $pelanggan ->telepon ?></td>
            <td><?php echo $pelanggan ->alamat ?></td>
            <td>
                <a href="<?php echo base_url('admin/pelanggan/edit/'.$pelanggan->id_pelanggan) ?>" 
                class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
               
                <a href="<?php echo base_url('admin/pelanggan/delete/'.$pelanggan->id_pelanggan) ?>" 
                class="btn btn-danger btn-xs" onclick="return confirm('yakin ingin menghapus data ini?')">
                  <i class="fa fa-trash"></i> Hapus</a>
            </td>
        </tr>
        <?php $no++; } ?>
    </tbody>
</table>





    



            
    












</table>