<div class="content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-6">
                     <div class="card">
                        <div class="header">
                           <h4 class="title"><?= __("Add New User") ?></h4>
                        </div>
                        <div class="content">
                           <form action="#" id="formadduser" autocomplete="off">

                              <div class="row">
                                  <div class="form-group col-lg-12">
                                    <label><small class="req text-danger">* </small><?= ("Email") ?></label>
                                    <input required type="email" name="email" class="form-control" id="email" placeholder="example@gmail.com">
                                  </div>
                              </div>

                              <div class="row">
                                 <div class="form-group col-lg-6">
                                    <label><small class="req text-danger">* </small><?= __("First Name") ?></label>
                                    <input type="text" class="form-control" name="firstname" required id="firstname" placeholder="<?= __("First Name") ?>">
                                 </div>
                                 <div class="form-group col-lg-6">
                                    <label><small class="req text-danger">* </small><?= __("Last Name") ?></label>
                                    <input type="text" class="form-control" name="lastname" required id="lastname" placeholder="<?= __("Last Name") ?>">
                                 </div>
                              </div>

                              <div class="row">
                                <div class="form-group col-lg-6">
                                    <label><small class="req text-danger">* </small><?= __("Account Type") ?></label>
                                    <select id="account_type" name="account_type" class="form-control required" required>
                                       <option disabled value=""><?= __("Select a role") ?></option>
                                       <option value="admin"><?= __("Admin") ?></option>
                                       <option value="member"><?= __("User") ?></option>
                                    </select>
                                 </div>

                                 <div class="form-group col-lg-6">
                                    <label><small class="req text-danger">* </small><?= __("Active") ?></label>
                                    <select id="is_active" name="is_active" class="form-control required" required>
                                       <option disabled value=""><?= __("Select a Category") ?></option>
                                       <option value="1"><?= __("Yes") ?></option>
                                       <option value="0"><?= __("No") ?></option>
                                    </select>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-lg-12 pt-3 pb-3">
                                    <button type="submit" id="incomesave" class="btn btn-info btn-fill btn-wd"><i class="ti-check"></i> <?= __("Create") ?></button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>