<div class="content"><!-- content -->
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="header">
                           <div class="d-flex justify-content-between flex-sm-row flex-column">
                              <div class="pb-3 pb-md-0">
                                 <h4 class="title"><?= __("Income Category List") ?></h4>
                              </div>
                              <div class="">
                                 <div class="d-flex flex-row">
                                    <a href="#'" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?= __("Add Income Category") ?></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="content">
                           <div class="table-responsive">
                              <table id="data" class="table " cellspacing="0" width="100%">
                                 <thead>
                                    <tr>
                                       <th><?= __("Category ID") ?></th>
                                       <th><?= __("Name") ?></th>
                                       <th><?= __("Description") ?></th>
                                       <th><?= __("Color") ?></th>
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
         </div><!-- end content -->
         
         <div id="add" class="modal fade" role="dialog"><!--add new data -->
            <div class="modal-dialog">
               <div class="modal-content">
                  <form action="#" id="formadd"  autocomplete="off">
                     <div class="modal-header">
                        <h5 class="modal-title"><?= __("Add Income Category") ?></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div id="message" style="display:none;" class="alert alert-warning"><?= __("All field is required") ?></div>
                     <div class="modal-body">
                        <div class="form-group">
                           <label><?= __("Name") ?></label>
                           <input type="text" class="form-control" name="name"  id="name" placeholder="<?= __("Name") ?>" required>
                        </div>
                        <div class="form-group">
                           <label><?= __("Description") ?></label>
                           <textarea class="form-control" name="description" id="description" placeholder="<?= __("Description") ?>"></textarea>
                        </div>
                        <div class="form-group">
                           <label><?= __("Color") ?></label>
                           <input type="text" class="form-control jscolor" name="color"  id="color" placeholder="<?= __("Color") ?>" required>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?= __("Close") ?></button>
                        <input type="submit" class="btn btn-sm btn-fill btn-info"  value="<?= __("Save") ?>"/>
                     </div>
                  </form>
               </div>
            </div>
         </div><!-- end add new data -->

         
         <div id="edit" class="modal fade" role="dialog"><!--edit data -->
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
                           <label><?= __("Name") ?></label>
                           <input type="text" class="form-control" name="editname"  id="editname" placeholder="<?= __("Name") ?>" required>
                        </div>
                        <div class="form-group">
                           <label><?= __("Description") ?></label>
                           <textarea class="form-control" name="editdescription" id="editdescription" placeholder="<?= __("Description") ?>"></textarea>
                        </div>
                        <div class="form-group">
                           <label><?= __("Color") ?></label>
                           <input type="text" class="form-control jscolor" name="editcolor"  id="editcolor" placeholder="<?= __("Color") ?>" required>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <input type="hidden" value="" name="id" id="idedit"/>
                        <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?= __("Close") ?></button>
                        <input type="submit" class="btn btn-sm btn-fill btn-info"  value="<?= __("Save") ?>"/>
                     </div>
                  </form>
               </div>
            </div>
         </div><!--end edit data -->
         