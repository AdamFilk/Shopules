<?php 
  include 'BackEnd_Header.php';
  require 'dbconnect.php';
  $id=$_GET['id'];
  $sql = "SELECT order_details.* FROM orderdetail";
  $stmt=$conn->prepare($sql);
  $stmt->execute();
  $orders=$stmt->fetchAll(); 
 ?>
<main class="app-content">
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Orders </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="categorynew.php" class="btn btn-outline-primary">
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
                                          <th>Date</th>
                                          <th>Voucher No</th>
                                          <th>Total</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      $i=1;
                                      foreach($orders as $order):
                                        $id= $order['id'];
                                        $odate= $order['orderdate'];
                                        $ovchr= $order['voucherno'];
                                        $ototal= $order['total'];
                                        $ostatus= $order['status'];
                                        if($ostatus==0){
                                                $status= "Order";
                                              }elseif($ostatus==2){
                                                $status= "Order Cancel";
                                              }else{
                                                $status="Order Confirm";
                                                }

                                       ?>
                                        <tr>
                                            <td> <?= $i++; ?>. </td>
                                            <td> <?= $odate; ?> </td>
                                            <td> <?= $ovchr; ?>  </td>
                                            <td> <?= $ototal; ?>  </td>
                                            <td> <?= $status;?> </td>
                                            <td>
                                              <a href="orderdetail.php?id=<?= $id ?>" class="btn btn-outline-info">
                                                    <i class="icofont-info"></i>
                                                </a>

                                                <?php 
                                                if($ostatus==0):
                                                 ?>
                                                
                                                <a href="orderconfirm.php?id=<?= $id ?>" class="btn btn-outline-success">
                                                    <i class="icofont-check"></i>
                                                </a>

                                                <a href="orderdelete.php?id=<?= $id ?>" class="btn btn-outline-danger">
                                                    <i class="icofont-close"></i>
                                                </a>
                                                <?php else: ?>
                                                  
                                            <?php endif ?>

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
  include 'BackEnd_Footer.php';
 ?>