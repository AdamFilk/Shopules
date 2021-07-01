 <?php 
  include('BackEnd_Header.php');
  require 'dbconnect.php';
 ?>
<main class="app-content">
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Item Form </h1>
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
                            <form action="itemadd.php" method="POST" enctype="multipart/form-data">
                                
                                <div class="form-group row">
                                    <label for="name_id" class="col-sm-2 col-form-label"> Photo </label>
                                    <div class="col-sm-10">
                                      <input type="file" class="form-control-file" id="photo" name="photo">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo_id" class="col-sm-2 col-form-label"> Name </label>
                                    <div class="col-sm-10">
                                      <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label for="photo_id" class="col-sm-2 col-form-label"> Price </label>
                                    <div class="col-sm-10">
                                     	<ul class="nav nav-tabs" id="myTab" role="tablist">
                                          <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="price-tab" data-toggle="tab" href="#price" role="tab" aria-controls="price" aria-selected="true">Unit Price</a>
                                          </li>
                                          <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="discount-tab" data-toggle="tab" href="#discount" role="tab" aria-controls="discount" aria-selected="false">Discount</a>
                                          </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                          <div class="tab-pane fade show active" id="price" role="tabpanel" aria-labelledby="price-tab">
                                              <input type="number" name="price" class="form-control" placeholder="Enter price">
                                          </div>
                                          <div class="tab-pane fade" id="discount" role="tabpanel" aria-labelledby="discount-tab">
                                            <input type="number" name="discount" class="form-control" placeholder="Enter Discount Percentage">
                                          </div>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group row">
                                    <label for="photo_id" class="col-sm-2 col-form-label"> Description </label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" name="desc"></textarea>
                                    </div>
                                </div>
                             <div class="form-group row">
                                    <label for="brand_id" class="col-sm-2 col-form-label"> Brands </label>
                                    <div class="col-sm-10">
                                      <select name="brand_id" class="form-control">
                                         <?php 
                                         	$sql = "SELECT * FROM brands";
											  $stmt=$conn->prepare($sql);
											  $stmt->execute();
											  $brands=$stmt->fetchAll();
											  var_dump($brands);
                                            foreach($brands as $brand):
                                                $id=$brand['id'];
                                                $name=$brand['name'];
                                           ?>
                                          <option value="<?= $id ?>">
                                              <?php echo $name; ?>
                                          </option>
                                      <?php endforeach; ?>
                                         
                                      </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="subcategory_id" class="col-sm-2 col-form-label"> Subcategory </label>
                                    <div class="col-sm-10">
                                      <select name="subcategory_id" class="form-control">
                                         <?php 
                                         	$sql = "SELECT * FROM subcategories";
											  $stmt=$conn->prepare($sql);
											  $stmt->execute();
											  $subcategories=$stmt->fetchAll();
											  var_dump($brands);
                                            foreach($subcategories as $subcategory):
                                                $id=$subcategory['id'];
                                                $name=$subcategory['name'];
                                           ?>
                                          <option value="<?= $id ?>">
                                              <?php echo $name; ?>
                                          </option>
                                      <?php endforeach; ?>
                                         
                                      </select>
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <label for="photo_id" class="col-sm-2 col-form-label"> Item Code </label>
                                    <div class="col-sm-10">
                                      <input type="text" id="codeno" name="codeno" class="form-control" value="<?php
										echo "ZH_".str_shuffle("123456789");
										?>" readonly>
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="icofont-save"></i>
                                            Save
                                        </button>

                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
 <?php
    include('BackEnd_Footer.php');
 ?>