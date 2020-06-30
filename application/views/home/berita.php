<!-- Blog -->

<section class="blog bgwhite p-t-94 p-b-65">

		<div class="container">
	
			<div class="sec-title p-b-52">
				<h3 class="m-text5 t-center">
			THE BEST MENU MERAH DELIMA FOOD
				</h3>
			</div>
			
			<div class="row">
			<?php foreach($berita as $berita)  { ?>
				<div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
					<!-- Block3 -->
					<div class="block1">
						<a href="blog-detail.html" class="block3-img dis-block hov-img-zoom">
							<img src="<?php echo base_url('assets/upload/image/'.$berita->gambar) ?>" alt="">
						</a>

						<div class="block3-txt p-t-14">
							<h4 class="p-b-7">
								<a href="blog-detail.html" class="m-text11">
								<?php echo $berita->slug_berita ?>
								</a>
							</h4>

							<p class="s-text8 p-t-16">
								<?php echo $berita->keterangan ?>							</p>
				</div>
				</div>
				
				</div>
				
				<?php } ?>
				
			</div>
			
		</div>
		
	</section>
	
