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
                            <form action="itemupdate.php" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?=$items['id'];?>">
                                <input type="text" name="oldPhoto" value="<?=$items['photo'];?>">
                                
                                <div class="form-group row">
                                    <label for="name_id" class="col-sm-2 col-form-label"> Photo </label>
                                    <div class="col-sm-10">
                                       <ul class="nav nav-tabs" id="myTab" role="tablist">
                                          <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="oldphoto-tab" data-toggle="tab" href="#oldphoto" role="tab" aria-controls="oldphoto" aria-selected="true">Old Profile</a>
                                          </li>
                                          <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="newphoto-tab" data-toggle="tab" href="#newphoto" role="tab" aria-controls="newphoto" aria-selected="false">New Profile</a>
                                          </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                          <div class="tab-pane fade show active" id="oldphoto" role="tabpanel" aria-labelledby="oldphoto-tab">
                                              <img src="<?=$items['photo']?>" class="img-fluid" width="150" height="150">
                                          </div>
                                          <div class="tab-pane fade" id="newphoto" role="tabpanel" aria-labelledby="newphoto-tab">
                                            <input type="file" name="photo" class="form-control-file pt-2">
                                          </div>
                                         
                                    </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo_id" class="col-sm-2 col-form-label"> Name </label>
                                    <div class="col-sm-10">
                                      <input type="text" id="name" name="name" class="form-control" value="<?= $items['name']?>">
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
                                              <input type="number" name="price" class="form-control" placeholder="Enter price" value="<?= $items['price']?>">
                                          </div>
                                          <div class="tab-pane fade" id="discount" role="tabpanel" aria-labelledby="discount-tab">
                                            <input type="number" name="discount" class="form-control" placeholder="Enter Discount Percentage" value="<?= $items['discount']?>">
                                          </div>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group row">
                                    <label for="photo_id" class="col-sm-2 col-form-label"> Description </label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" name="desc"><?= $items['description']?></textarea>
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
                                          <option value="<?= $id ?>" 
                                            <?php if($id==$items['brand_id']){
                                              echo "selected";
                                            } ?>
                                            >
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
                                          <option value="<?= $id ?>"
                                            <?php 
                                            if($id==$items['subcategory_id']){
                                              echo "selected";
                                            }
                                             ?>
                                            >
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
                  										echo $items['codeno'];
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