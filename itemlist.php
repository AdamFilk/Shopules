 <?php 
  require 'dbconnect.php';
  include('BackEnd_Header.php');

  $sql = "SELECT * FROM items";
  $stmt=$conn->prepare($sql);
  $stmt->execute();
  $items=$stmt->fetchAll();  
 ?>
    
    <!-- Main Content -->
     <main class="app-content">
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Items </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="itemnew.php" class="btn btn-outline-primary">
                        <i class="icofont-plus"></i>
                    </a>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Brand</th>
                                          <th>Price</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      $i=1;
                                      foreach($items as $item):
                                        $id= $item['id'];
                                        $codeno=$item['codeno'];
                                        $name= $item['name'];
                                        $photo= $item['photo'];
                                        $price=$item['price'];
                                        $discount=$item['discount'];
                                        $description=$item['description'];
                                        $brand_id=$item['brand_id'];
                                        $subcategory_id=$item['subcategory_id'];


                                       ?>
                                        <tr>
                                            <td> <?= $i++; ?>. </td>
                                            <td> 
                                              <div style="float: left;"> 
                                                <div class="row">
                                                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                                    <img src="<?= $photo; ?>" class="img-fluid mr-3 " width="100" height="100"> 
                                                  </div>
                                                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                                   <div>
                                                <p>
                                                  <?= $codeno ?><br>
                                                <span class="d-inline-block text-truncate"
                                                style="max-width: 100px;color: grey">  <?= $name;?></span>
                                                
                                                </p>
                                              </div>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                              
                                            </td>
                                            <td>  
                                              <?php
                                              $sql="SELECT brands.name FROM brands JOIN items ON brands.id=items.brand_id WHERE items.brand_id=$brand_id;";
                                              $stmt=$conn->prepare($sql);
                                              $stmt->execute();
                                              $brand_name=$stmt->fetch(PDO::FETCH_ASSOC);
                                              echo $brand_name["name"];
                                              ?>
                                            </td>
                                            <td>
                                              <?php if($discount>0){
                                                echo "<p style='text-decoration:line-through;'>$price Ks</p>";
                                                $discount_v=$discount/100;
                                                $total=$price-($price*$discount_v);
                                                echo $total.'Ks';
                                              }else{
                                                echo $price.'Ks';
                                              } 
                                              ?>
                                              

                                            </td>
                                            <td>
                                              <a href="itemdetail.php?id=<?= $id ?>" class="btn btn-primary">
                                                    <i class="icofont-info-circle"></i>
                                                </a>
                                                <a href="itemedit.php?id=<?= $id ?>" class="btn btn-warning">
                                                    <i class="icofont-ui-settings"></i>
                                                </a>

                                                <a href="itemdelete.php?id=<?= $id ?>" class="btn btn-outline-danger">
                                                    <i class="icofont-close"></i>
                                                </a>
                                            </td>

                                        </tr>
                                      <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <?php
    include('BackEnd_Footer.php');

    ?>
