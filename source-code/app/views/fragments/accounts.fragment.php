<div class="content">
   <div class="container-fluid">
      <div class="row">
         <!--add data-->
         <div class="col-lg-12 col-md-11">
            <div class="card">
               <div class="header">
                  <div class="d-flex justify-content-between flex-sm-row flex-column">
                     <div class="pb-3 pb-md-0">
                        <h4 class="title"><?= __("Account List") ?></h4>
                     </div>
                     <div class="">
                        <div class="d-flex flex-row">
                           <a href="#'" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?= __("Add New Account") ?></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="content">
                  <div class="table-responsive">
                     <table id="data" class="table" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th><?= __("Account ID") ?></th>
                              <th><?= __("Name") ?></th>
                              <th><?= __("Opening Balance") ?></th>
                              <th><?= __("Description") ?></th>
                              <th><?= __("Action") ?></th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--add new data -->
<div id="add" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <form action="#" id="formadd"  autocomplete="off">
            <div class="modal-header">
               <h5 class="modal-title"><?= __("Add New Account") ?></h5>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="message" style="display:none;" class="alert alert-warning"><?= __("All field is required") ?></div>
            <div class="modal-body">
               <div class="form-group">
                  <label><small class="req text-danger">* </small><?= __("Name") ?></label>
                  <input type="text" class="form-control" name="name"  id="name" placeholder="<?= __("Name") ?>" required>
               </div>
               <div class="form-group">
                  <label><small class="req text-danger">* </small><?= __("Opening Balance") ?></label>
                  <div class="input-group">
                     <span class="input-group-addon currency" id="currency" style="border: 1px solid #cecece;"><?= $Settings->get("currency") ?></span>                                   
                     <input class="form-control number" required placeholder="<?= __("Opening Balance") ?>" id="balance" name="balance" type="text" >
                  </div>
               </div>
               <div class="form-group">
                  <label><small class="req text-danger">* </small><?= __("Account Number") ?></label>
                  <input class="form-control" required placeholder="<?= __("Account Number") ?>" id="accountnumber" name="accountnumber" type="text">
               </div>
               <div class="form-group">
                  <label><?= __("Description") ?></label>
                  <textarea class="form-control" name="description" id="description" placeholder="<?= __("Description") ?>"></textarea>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?= __("Close") ?></button>
               <input type="submit" class="btn btn-sm btn-fill btn-info" id="save" value="Save"/>
            </div>
         </form>
      </div>
   </div>
</div>
<!--edit data -->
<div id="edit" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <form action="#" id="formedit"  autocomplete="off">
            <div class="modal-header">
               <h5 class="modal-title"><?= __("Edit") ?></h5>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="message" style="display:none;" class="alert alert-warning"><?= __("All field is required") ?></div>
            <div class="modal-body">
               <div class="form-group">
                  <label><small class="req text-danger">* </small><?= __("Name") ?></label>
                  <input type="text" class="form-control" name="editname"  id="editname" placeholder="<?= __("Name") ?>" required>
               </div>
               <div class="form-group">
                  <label><small class="req text-danger">* </small><?= __("Opening Balance") ?></label>
                  <div class="input-group">
                     <span class="input-group-addon currency" id="currency" style="border: 1px solid #cecece;"><?= $Settings->get("currency") ?></span>                                   
                     <input class="form-control number" required placeholder="<?= __("Opening Balance") ?>" id="editbalance" name="editbalance" type="text" placeholder="<?= __("Amount") ?>">
                  </div>
               </div>
               <div class="form-group">
                  <label><small class="req text-danger">* </small><?= __("Account Number") ?></label>
                  <input class="form-control" required placeholder="<?= __("Account Number") ?>" id="editaccountnumber" name="editaccountnumber" type="text">
               </div>
               <div class="form-group">
                  <label><?= __("Description") ?></label>
                  <textarea class="form-control" name="editdescription" id="editdescription" placeholder="<?= __("Description") ?>"></textarea>
               </div>
            </div>
            <div class="modal-footer">
               <input type="hidden" value="" name="id" id="idedit"/>
               <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?= __("Close") ?></button>
               <input type="submit" class="btn btn-sm btn-fill btn-info" value="<?= __("Save") ?>"/>
            </div>
         </form>
      </div>
   </div>
</div>