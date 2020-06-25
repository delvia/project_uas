<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-<?php echo $produk->id_produk ?>">
       <i class= "fa fa-trash"></i> Hapus          
 </button>
 <div class="modal fade" id="delete-<?php echo $produk->id_produk ?>">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title text-center">HAPUS DATA PRODUK</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <div class="callout callout-warning">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                Yakin ingin menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan.
                </h3>
                
              </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i>
            Close</button>
        <a href="<?php echo base_url('admin/produk/delete/'.$produk->id_produk) ?>"
        class="btn btn-danger"><i class="fa fa-trash"></i>Ya, Hapus Data Ini</a>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->