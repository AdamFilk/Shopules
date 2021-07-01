
<?php 
	include 'FrontEnd_header.php';
	 include ('FrontEnd_Nav.php');
 ?>
<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
  			<?php 
  			$id=$_GET['id'];
  			$sql="SELECT * FROM subcategories WHERE id=$id;";
  			$stmt= $conn->prepare($sql);
			$stmt->execute();
			$subcategory=$stmt->fetch(PDO::FETCH_ASSOC);
  			 ?>
    		<h1 class="text-center text-white"> <?=$subcategory['name']?> </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container">

		<!-- Breadcrumb -->
		<nav aria-label="breadcrumb ">
		  	<ol class="breadcrumb bg-transparent">
		  		<?php 
		  		$id=$_GET['id'];
			  		$sql="SELECT categories.id as cid,categories.name as cname,subcategories.name as sname FROM categories JOIN subcategories ON categories.id= subcategories.category_id WHERE subcategories.id =$id ";
			  		$stmt= $conn->prepare($sql);
					$stmt->execute();
					$cat_subcats=$stmt->fetchAll();
					foreach ($cat_subcats as $cat_subcat):
		  		 ?>
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> Home </a>
		    	</li>
		
		    	<li class="breadcrumb-item">
		    		<a href="" class="text-decoration-none secondarycolor"> <?=$cat_subcat['cname']?> </a>
		    	</li>
		    	<li class="breadcrumb-item active" aria-current="page">
					<?=$cat_subcat['sname']?>
		    	</li>
		    
		  	</ol>
		</nav>

		<div class="row mt-5">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<ul class="list-group">
					<?php 
					$c_id=$cat_subcat['cid'] ;
					$sql="SELECT * FROM subcategories WHERE category_id=$c_id ";
					$stmt= $conn->prepare($sql);
					$stmt->execute();
					$subcategories=$stmt->fetchAll();
					foreach ($subcategories as $subcategory):
					$sid=$subcategory['id'];
					$sname=$subcategory['name'];
					?>
				  	<li class="list-group-item <?php 
			    	if($sid==$id){
			    		echo "active";
			    	}
		    	 ?>" 
				  	
				  	>
				  		<a href="subcategory.php?id=<?=$sid?>" class="text-decoration-none secondarycolor"> <?= $sname ?></a>
				  	</li>
				  	 <?php endforeach ?>
				  <?php endforeach ?>
				</ul>
			</div>	


			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
				
				<div class="row">
				<?php 
				$id=$_GET['id'];
				$sql="SELECT * FROM items JOIN subcategories ON items.subcategory_id=subcategories.id WHERE items.subcategory_id=$id";
				$stmt=$conn->prepare($sql);
				$stmt->execute();
				$items=$stmt->fetchAll();
				foreach($items as $item):
				$i_id=$item['id'];
				$i_name=$item['name'];
				$i_photo=$item['photo'];
				$i_price=$item['price'];
				$i_discount=$item['discount'];
				 ?>
					<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
						<div class="card pad15 mb-3">
						  	<img src="<?=$i_photo?>" class="card-img-top" alt="...">
						  	
						  	<div class="card-body text-center">
						    	<h5 class="card-title text-truncate"><?=$i_name?></h5>
						    	
						    	<p class="item-price">
		                        	<?php  if($i_discount): ?>
		                        	<strike><?=$i_price?> Ks</strike> 
		                        	<span class="d-block">
		                        		<?php 
		                        			$discount_amt=$i_discount/100;
		                        			$total=$i_price-($i_price*$discount_amt);
		                        			echo $total.' Ks';
		                        		 ?>
		                        	</span>
		                        	<?php else: ?>
		                        	<span class="d-block"><?=$i_price?> Ks</span>
		                        <?php endif ?>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a>
						  	</div>
						</div>
					</div>
				<?php endforeach; ?>
				</div>


				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-end">
					    <li class="page-item disabled">
					      	<a class="page-link" href="#" tabindex="-1" aria-disabled="true"><i class="icofont-rounded-left"></i>
					      	</a>
					    </li>
					    <li class="page-item">
					    	<a class="page-link" href="#">1</a>
					    </li>
					    <li class="page-item active">
					    	<a class="page-link" href="#">2</a>
					    </li>
					    <li class="page-item">
					    	<a class="page-link" href="#">3</a>
					    </li>
					    <li class="page-item">
					      	<a class="page-link" href="#">
					      		<i class="icofont-rounded-right"></i>
					      	</a>
					    </li>
					</ul>
				</nav>
			</div>
		</div>

		
	</div>

<?php 
	include 'FrontEnd_footer.php';
 ?>