<?php 
	include 'FrontEnd_header.php';
 ?>
 <?php 
 	include 'FrontEnd_Nav.php';
  ?>
  	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
  			<?php 
  			$id=$_GET['id'];
  			$sql="SELECT * FROM items WHERE id=$id;";
  			$stmt= $conn->prepare($sql);
			$stmt->execute();
			$itemms=$stmt->fetch(PDO::FETCH_ASSOC);
  			 ?>
    		<h1 class="text-center text-white"> <?=$itemms['codeno']?> </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container">

		<!-- Breadcrumb -->
		<nav aria-label="breadcrumb ">
		  	<ol class="breadcrumb bg-transparent">
		  		<?php 
		  		$id=$_GET['id'];
			  		$sql="SELECT categories.id as cid,categories.name as cname,subcategories.name as sname FROM categories JOIN subcategories JOIN items ON categories.id= subcategories.category_id AND items.subcategory_id=subcategories.id WHERE items.id =$id";
			  		$stmt= $conn->prepare($sql);
					$stmt->execute();
					$item_sub_cats=$stmt->fetchAll();
					foreach ($item_sub_cats as $item_sub_cat):
		  		 ?>
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> Home </a>
		    	</li>
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> Category </a>
		    	</li>
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> <?=$item_sub_cat['cname']?> </a>
		    	</li>
		    	<li class="breadcrumb-item active" aria-current="page">
				<?=$item_sub_cat['sname']?>
		    	</li>
		    <?php endforeach ?>
		  	</ol>
		</nav>

		<div class="row mt-5">
			<?php 
				$id=$_GET['id'];
				$sql="SELECT * FROM items WHERE id=$id";
				$stmt=$conn->prepare($sql);
				$stmt->execute();
				$items=$stmt->fetchAll();
				foreach($items as $item):
				$itid=$item['id'];
				$itname=$item['name'];
				$itphoto=$item['photo'];
				$itprice=(int)$item['price'];
				$itdesc=$item['description'];
				$itdiscount_percent=(int)$item['discount'];
				$itdiscount=$itprice-($itprice*($itdiscount_percent/100));
				$itbrand=$item['brand_id'];
				$itcodeno=$item['codeno'];
				$itsubid=$item['subcategory_id'];
				 ?>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<img src="<?=$itphoto?>" class="img-fluid">
			</div>	

			
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
				
				<h4> <?=$itname?> </h4>

				<div class="star-rating">
					<ul class="list-inline">
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star-half'></i></li>
					</ul>
				</div>

				<p>
					<?=$itdesc?>
				</p>
			
				
		
				<p><span class="text-uppercase "> Current Price </span>
					<span class="maincolor ml-3 font-weight-bolder "> <?php 
					if ($itdiscount_percent) {
						# code...
						echo $itdiscount." Ks";
					}
					else{
						echo $itprice." Ks";
					}
					 ?> </span>
					
				</p>
					
			
				

				<p> 
					<span class="text-uppercase "><?php 
					$brand_id=$itbrand;
					$sql="SELECT * FROM brands WHERE id=$brand_id";
					$stmt=$conn->prepare($sql);
					$stmt->execute();
					$brand=$stmt->fetch(PDO::FETCH_ASSOC);
					 ?>  </span>
					<span class="ml-3"> <a href="" class="text-decoration-none text-muted"> <?=$brand['name']?> </a> </span>
				</p>


				<a href="cart.php?id=<?=$itid?>" class="addtocartBtn text-decoration-none"
								data-id="<?=$itid?>"
								data-name="<?=$itname?>"
								data-codeno="<?=$itcodeno?>"
								data-photo="<?=$itphoto?>"
								data-price="<?=$itprice?>"
								data-discount="<?=$itdiscount?>"
								>Add to Cart</a>
				
			</div>
			<?php endforeach; ?>
		</div>

		<div class="row mt-5">
			<div class="col-12">
				<h3> Related Item </h3>
				
				
				<hr>
			</div>
			<?php 
					$sql="SELECT items.photo as iphoto FROM items JOIN subcategories ON items.subcategory_id=subcategories.id WHERE items.subcategory_id=$itsubid";
					$stmt=$conn->prepare($sql);
					$stmt->execute();
					$itms=$stmt->fetchAll();
					foreach ($itms as $itm) :
						
				 ?>

			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<a href="">
					<img src="<?=$itm['iphoto']?>" class="img-fluid">
				</a>
			</div>
			<?php endforeach ?>
			
		</div>

		
	</div>
  <?php 
  	include 'FrontEnd_footer.php'
   ?>