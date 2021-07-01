<?php 
	 require 'dbconnect.php';
  include('BackEnd_Header.php');

  $sql = "SELECT * FROM subcategories";
  $stmt=$conn->prepare($sql);
  $stmt->execute();
  $subcategories=$stmt->fetchAll();  
 ?>
 ?>
 	 <main class="app-content">
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Sub-Category </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="subcategorynew.php" class="btn btn-outline-primary">
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
                                          <th>Category</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      $i=1;
                                      foreach($subcategories as $subcategory):
                                        $id= $subcategory['id'];
                                        $name= $subcategory['name'];
                                        $category_id= $subcategory['category_id'];
                                        $sql="SELECT categories.name FROM categories JOIN subcategories ON categories.id=subcategories.category_id WHERE categories.id=$category_id;";
                                        $stmt=$conn->prepare($sql);
                                        $stmt->execute();
                                        $category_name=$stmt->fetch(PDO::FETCH_ASSOC);
                                      
                                       ?>
                                        <tr>
                                            <td> <?= $i++; ?>. </td>
                                            <td> <?= $name; ?> </td>
                                            <td> <?= $category_name['name'] ?></td>
                                            <td>
                                                <a href="subcategoryedit.php?id=<?= $id ?>" class="btn btn-warning">
                                                    <i class="icofont-ui-settings"></i>
                                                </a>

                                                <a href="subcategorydelete.php?id=<?= $id ?>" class="btn btn-outline-danger">
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
	include 'BackEnd_Footer.php'
 ?>