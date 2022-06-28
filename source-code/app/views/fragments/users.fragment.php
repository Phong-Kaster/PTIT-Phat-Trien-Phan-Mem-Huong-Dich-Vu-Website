<!-- content -->
<div class="content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12 col-md-11 pt-4">
                     <div class="card">
                        <div class="header">
                           <div class="d-flex justify-content-between flex-sm-row flex-column">
                              <div class="pb-3 pb-md-0">
                                 <h4 class="title"><?= __("Users Management") ?></h4>
                              </div>
                              <div class="">
                                 <div class="d-flex flex-row">
                                    
                                    <a href="<?= APPURL."/users/new" ?>" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?= __("Add User") ?></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="content">
                           <div class="table-responsive">
                              <table id="data" class="table" cellspacing="0" width="100%">
                                 <thead>
                                    <tr>
                                       <th></th>
                                       <th><?= __("ID") ?></th>
                                       <th><?= __("Type") ?></th>
                                       <th><?= __("Name") ?></th>
                                       <th><?= __("Email") ?></th>
                                       <th><?= __("Active") ?></th>
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
         <!-- End content -->


         <!-- form edit user -->
         <div id="edit" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
               <form action="#" id="formedituser" enctype="multipart/form-data" autocomplete="off">
                     <div class="modal-header">
                        <h5 class="modal-title"><?= __("Edit") ?></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">

                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label><small class="req text-danger">* </small><?= __("Email") ?></label>
                                 <input disabled type="email" class="form-control" name="eemail" id="eemail" placeholder="<?= __("example@gmail.com") ?>">
                              </div>
                           </div>
                        </div>

                        <div class="row">
                        <div class="col-lg-6">
                              <div class="form-group">
                                 <label><?= __("First Name") ?></label>
                                 <input type="text" class="form-control" name="efirstname"  id="efirstname" placeholder="<?= __("First Name") ?>">
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label><?= __("Last Name") ?></label>
                                 <input type="text" class="form-control" name="elastname"  id="elastname" placeholder="<?= __("Last Name") ?>">
                              </div>
                           </div>
                        </div>

                        <div class="row">
                        <div class="form-group col-lg-6">
                              <label><small class="req text-danger">* </small><?= __("Active") ?></label>
                              <select id="eis_active" name="eis_active" required class="form-control">
                                 <option value="1">
                                    Yes
                                 </option>
                                 <option value="0">
                                    No
                                 </option>
                              </select>
                           </div>

                           <div class="form-group col-lg-6">
                              <label><small class="req text-danger">* </small><?= __("Account Type") ?></label>
                              <select id="eaccount_type" name="eaccount_type" required class="form-control">
                                 <option value="admin">Admin</option>
                                 <option value="member">Member</option>
                              </select>
                           </div>
                        </div>
                        
                     </div>
                     <div class="modal-footer">
                        <input type="hidden" value="" name="id" id="idedit"/>
                        <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?= __("Close") ?></button>
                        <input type="submit" class="btn btn-sm btn-fill btn-info" id="saveedit" value="<?= __("Save") ?>"/>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- End edit data -->