 <?php 
  include('BackEnd_Header.php');
  require 'dbconnect.php';
  $id=$_GET['id'];

    //draw out the query from db
    $sql="SELECT * FROM items WHERE id= :id";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $items=$stmt->fetch(PDO::FETCH_ASSOC);

 ?>
<main class="app-content">
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Item Detail </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="itemlist.php" class="btn btn-outline-primary">
                        <i class="icofont-double-left"></i>
                    </a>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                          <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                            <h3><?=$items['codeno']?></h3>
                            <p><?=$items['name']?></p>
                             <img src="<?=$items['photo']?>" class="img-fluid w-25 mb-3">
                             <ul>
                               <li>
                                <?=$items['description']?>
                               </li>
                             </ul>
                           </div>
                           <div style="margin-left:0; "class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                           
                                Brand:
                            
                                <?php 
                                  $brand_id=$items['brand_id'];
                                  $sql="SELECT * FROM brands JOIN items ON brands.id=items.brand_id WHERE brands.id=$brand_id";
                                  $stmt=$conn->prepare($sql);
                                  $stmt->execute();
                                  $brand_name=$stmt->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                <?=$brand_name['name']?>
                                
                                <br>
                            
                                Subcategory:
                              
                            
                                <?php 
                                  $sub_id=$items['subcategory_id'];
                                  $sql="SELECT * FROM subcategories JOIN items ON subcategories.id=items.subcategory_id WHERE subcategories.id=$sub_id";
                                  $stmt=$conn->prepare($sql);
                                  $stmt->execute();
                                  $subcat_name=$stmt->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                <?=$subcat_name['name']?>
                                <br>
                                Pirce:
                              
                                <?php 
                                $discount=$items['discount'];
                                $price=$items['price'];
                                if($discount>0){
                                                echo "<span style='text-decoration:line-through;margin-right:5px;'>$price. Ks</span>";
                                                $discount_v=$discount/100;
                                                $total=$price-($price*$discount_v);
                                                echo $total.' Ks';
                                              }else{
                                                echo $price.' Ks';
                                              } 
                                              ?>
                            
                              
                          </div>
                           

                          
                        </div>
                    </div>
                </div>
            </div>
        </main>
 <?php
    include('BackEnd_Footer.php');
 ?>