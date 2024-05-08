 <div class="modal-header" style="display: flex;justify-content:space-between">
   <div class="col-md-6">
     <h5 class="modal-title" id="exampleModalLabel">Giỏ hàng</h5>
   </div>
   <div class="col-md-6">
     <button type="button" onclick="backtoFirstState()" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
   </div>
   </button>
 </div>
 <div class="modal-body">
   <!-- <table class="show-cart table">
     <td style="border:0">
       <span id="cartNumber"></span>
     </td>
     <td style="border:0">
       <a href="cart.php?xoatatca=1" id="clearcart"> <button class="btn btn-danger">Xóa hết</button> </a>
     </td>
     <td style="border:0">
       <div>Tổng tiền: <span id="total-cart" class="total-cart"></span></div>
     </td>
   </table> -->
   <div class="container-fluid">
     <div class="row">
       <div class="col-md-12">
         <?php include('common/progressbar.php') ?>
         <div class="clear" style="margin-bottom:1%"></div>
         <div id="orderhistory"></div>
         <div id="carttable">
           <table style="text-align:center;width: 100%;border-collapse: collapse;" border="1">
             <thead>
               <tr>
                 <th class="text-center" style="vertical-align: middle;">#</th>

                 <th class="text-center" style="vertical-align: middle;">Tên sản phẩm</th>

                 <th class="text-center" style="vertical-align: middle;">Số lượng</th>

                 <th class="text-center" style="vertical-align: middle;">Giá</th>

                 <th class="text-center" style="vertical-align: middle;">Mã sản phẩm</th>

                 <th class="text-center" style="vertical-align: middle;">Hình ảnh</th>

                 <th class="text-center" style="vertical-align: middle;">Thành tiền</th>

                 <th class="text-center" style="vertical-align: middle;">Xóa sản phẩm</th>
               </tr>
             </thead>
             <tbody id="cartbodies">
             </tbody>
           </table>
         </div>
         <div id="result"></div>
       </div>
     </div>
   </div>
   <div id="shipping"></div>
   <div id="payment" class="container-fluid"></div>
 </div>
 <div class="modal-footer">
   <button type="button" onclick="backtoFirstState()" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
 </div>