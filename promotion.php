<?php 
	include 'FrontEnd_header.php'
 ?>
 <?php 
 	include 'FrontEnd_Nav.php'
  ?>
	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> Promotion Item </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container mt-5">


		<div class="row">
            <div class="col">
                <div class="bbb_viewed_title_container">
                    <h3 class="bbb_viewed_title"> Discount </h3>
                    <div class="bbb_viewed_nav_container">
                        <div class="bbb_viewed_nav bbb_viewed_prev"><i class="icofont-rounded-left"></i></div>
                        <div class="bbb_viewed_nav bbb_viewed_next"><i class="icofont-rounded-right"></i></div>
                    </div>
                </div>
                <div class="bbb_viewed_slider_container">
                    <div class="owl-carousel owl-theme bbb_viewed_slider">
                    	<?php 
		            	$sql="SELECT * FROM items WHERE discount !='' ORDER BY rand()";
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
					    <div class="owl-item">
					        <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
					            <div class="pad15">
					        		<img src="<?=$i_photo?>" class="img-fluid">
					            	<p class="text-truncate"><?=$i_name?></p>
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
					     <?php endforeach ?>

					    

					</div>
                </div>
            </div>
        </div>

	</div>

  <?php 
  	include 'FrontEnd_footer.php'
   ?>