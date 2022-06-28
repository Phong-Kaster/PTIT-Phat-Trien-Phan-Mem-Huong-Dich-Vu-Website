<div class="content"><!-- content -->
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-11">
            <div class="card">
                <div class="header">
                <div class="d-flex justify-content-between flex-sm-row flex-column">
                    <div class="pb-3 pb-md-0">
                        <h4 class="title"><?= __("Budget List") ?></h4>
                    </div>
                    <div class="">
                        <div class="d-flex flex-row">
                            <a href="#'" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?= __("Add Budget") ?></a>
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
                              <th><?= __("Budget ID") ?></th>
                              <th><?= __("Original") ?></th>
                              <th><?= __("Category") ?></th>
                              <th><?= __("Amount") ?></th>
                              <th><?= __("Month") ?></th>
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
</div><!-- end content -->


      <div id="edit" class="modal fade" role="dialog"><!--edit data -->
            <div class="modal-dialog">
               <div class="modal-content">
                  <form action="#" id="formedit"  autocomplete="off">
                     <div class="modal-header">
                        <h5 class="modal-title"><?= __("Edit") ?></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="form-group col-lg-6">
                              <label><small class="req text-danger">* </small><?= __("Month") ?></label>
                              <select disabled id="editmonths" class="form-control" name="editmonths" required>
                                 <option value="01"><?= __("Jan") ?></option>
                                 <option value="02"><?= __("Feb") ?></option>
                                 <option value="03"><?= __("Mar") ?></option>
                                 <option value="04"><?= __("Apr") ?></option>
                                 <option value="05"><?= __("May") ?></option>
                                 <option value="06"><?= __("Jun") ?></option>
                                 <option value="07"><?= __("Jul") ?></option>
                                 <option value="08"><?= __("Aug") ?></option>
                                 <option value="09"><?= __("Sep") ?></option>
                                 <option value="10"><?= __("Oct") ?></option>
                                 <option value="11"><?= __("Nov") ?></option>
                                 <option value="12"><?= __("Dec") ?></option>
                              </select>
                           </div>

                           <?php 
                              $year = date("Y");
                           ?>
                           <div class="form-group col-lg-6">
                              <label><small class="req text-danger">* </small><?= __("Year") ?></label>
                              <select disabled id="edityears" class="form-control" name="edityears" required>
                                 <?php for ($i=0; $i < 10; $i++): ?>
                                    <option value="<?= $year+$i ?>"><?= $year+$i ?></option>
                                 <?php endfor ?>
                              </select>
                           </div>
                        </div>
                        
                        <div class="row">
                           <div class="form-group col-lg-6">
                              <label><small class="req text-danger">* </small><?= __("Category") ?></label>
                              <select disabled id="editcategory" class="form-control" name="editcategory" required>
                                 <option value=""><?= __("Select a Category") ?></option>
                                 <optgroup label="<?= __("Income") ?>" id="income">
                                 </optgroup>
                                 <optgroup label="<?= __("Expense") ?>" id="expense">
                                 </optgroup>
                              </select>
                           </div>
                           <div class="form-group col-lg-6">
                              <label><small class="req text-danger">* </small><?= __("Amount") ?></label>
                              <div class="input-group">
                                 <span class="input-group-addon currency" id="currency" style="border: 1px solid #cecece;"><?= $Settings->get("currency") ?></span>
                                 <input class="form-control number"  placeholder="<?= __("Amount") ?>" id="editamount" name="editamount" required type="text" placeholder="<?= __("Amount") ?>">
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="form-group col-lg-12">
                              <label><?= __("Description") ?></label>
                              <textarea id="editnote" class="form-control" placeholder="<?= __("Description") ?>"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <input type="hidden" value="" name="id" id="idedit"/>
                        <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?= __("Close") ?></button>
                        <input type="submit" class="btn btn-sm btn-fill btn-info" id="save" value="<?= __("Save") ?>"/>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div><!--end edit data -->

      <div id="add" class="modal fade" role="dialog"><!--add new data -->
         <div class="modal-dialog">
            <div class="modal-content">
               <form action="#" id="formadd"  autocomplete="off">
                  <div class="modal-header">
                     <h5 class="modal-title"><?= __("Add Budget") ?></h5>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">

                     <div class="row">
                        <div class="form-group col-lg-6">
                           <label><small class="req text-danger">* </small><?= __("Month") ?></label>
                           <select id="months" class="form-control" name="months" required>
                              <option value="01"><?= __("Jan") ?></option>
                              <option value="02"><?= __("Feb") ?></option>
                              <option value="03"><?= __("Mar") ?></option>
                              <option value="04"><?= __("Apr") ?></option>
                              <option value="05"><?= __("May") ?></option>
                              <option value="06"><?= __("Jun") ?></option>
                              <option value="07"><?= __("Jul") ?></option>
                              <option value="08"><?= __("Aug") ?></option>
                              <option value="09"><?= __("Sep") ?></option>
                              <option value="10"><?= __("Oct") ?></option>
                              <option value="11"><?= __("Nov") ?></option>
                              <option value="12"><?= __("Dec") ?></option>
                           </select>
                        </div>

                        <?php 
                           $year = date("Y");
                        ?>
                        <div class="form-group col-lg-6">
                           <label><small class="req text-danger">* </small><?= __("Year") ?></label>
                           <select id="years" class="form-control" name="years" required>
                              <?php for ($i=0; $i < 10; $i++): ?>
                                 <option value="<?= $year+$i ?>"><?= $year+$i ?></option>
                              <?php endfor ?>
                           </select>
                        </div>
                     </div>
                     
                     <div class="row">
                        <div class="form-group col-lg-6">
                           <label><small class="req text-danger">* </small><?= __("Category") ?></label>
                           <select id="category" class="form-control" name="category" required>
                              <option value=""><?= __("Select a Category") ?></option>
                              <optgroup label="<?= __("Income") ?>" id="income">
                              </optgroup>
                              <optgroup label="<?= __("Expense") ?>" id="expense">
                              </optgroup>
                           </select>
                        </div>
                        <div class="form-group col-lg-6">
                           <label><small class="req text-danger">* </small><?= __("Amount") ?></label>
                           <div class="input-group">
                              <span class="input-group-addon currency" id="currency" style="border: 1px solid #cecece;"><?= $Settings->get("currency") ?></span>
                              <input class="form-control number"  placeholder="<?= __("Amount") ?>" id="amount" name="amount" required type="text" placeholder="<?= __("Amount") ?>">
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="form-group col-lg-12">
                           <label><?= __("Description") ?></label>
                           <textarea id="note" class="form-control" placeholder="<?= __("Description") ?>"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?= __("Close") ?></button>
                     <input type="submit" class="btn btn-sm btn-fill btn-info" id="save" value="<?= __("Save") ?>"/>
                  </div>
               </form>
            </div>
         </div>
      </div><!--end add new data -->