<div class="content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-6">
                     <div class="card">
                        <div class="header">
                           <h4 class="title"><?= __("Income Transaction") ?></h4>
                        </div>
                        <div class="content">
                           <form action="#" id="formaddincome" autocomplete="off">
                              <div class="row">
                                 <div class="form-group col-lg-6">
                                    <label><small class="req text-danger">* </small><?= __("Name") ?></label>
                                    <input type="text" class="form-control" name="name" required id="incomename" placeholder="Name">
                                 </div>
                                 <div class="form-group col-lg-6">
                                    <label><small class="req text-danger">* </small><?= __("Income Category") ?></label>
                                    <select id="incomecategory" name="incomecategory" class="form-control required" required data-url="<?= APIURL. "/incomecategories"?>">
                                       <option value=""><?= __("Select a Category") ?></option>
                                    </select>
                                    <label for="incomecategory" class="error"></label>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="incomeamount" class="control-label"><small class="req text-danger">* </small><?= __("Amount") ?></label> 
                                       <div class="input-group">
                                          <span class="input-group-addon" id="currency" style="border: 1px solid #cecece;"><?= $Settings->get("currency") ?></span>                                      
                                          <input class="form-control number" required placeholder="Amount" id="incomeamount" name="incomeamount" type="text" placeholder="Amount">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label><?= __("Reference") ?></label>
                                       <input type="text" class="form-control" name="incomereference"  id="incomereference" placeholder="<?= __("Reference") ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="form-group col-lg-6" id="incomedate">
                                    <label for="date" class="control-label"> 
                                    <small class="req text-danger">* </small><?= __("Date") ?></label>
                                    <div  class="input-group date" data-date-format="mm-dd-yyyy">
                                       <input id="idate" class="form-control" required type="text" value="<?= date("Y-m-d")?>"/>
                                       <span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
                                    </div>
                                 </div>
                                 <div class="form-group col-lg-6">
                                    <label><small class="req text-danger">* </small><?= __("Account") ?></label>
                                    <select id="incomeaccount" name="incomeaccount" class="form-control required" required data-url="<?= APIURL. "/accounts"?>"></select>
                                    <label for="incomeaccount" class="error"></label>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="form-group col-lg-12">
                                    <label><?= __("Note") ?></label>
                                    <textarea id="incomenote" class="form-control" placeholder="<?= __("Note") ?>"></textarea>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-12 pt-3 pb-3">
                                    <button type="submit" id="incomesave" class="btn btn-info btn-fill btn-wd"><i class="ti-check"></i> <?= __("Save Income") ?></button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <!--expense-->
                  <div class="col-md-6">
                     <div class="card">
                        <div class="header">
                           <h4 class="title"><?= __("Expense Transaction") ?></h4>
                        </div>
                        <div class="content">
                           <form action="#" id="formaddexpense" autocomplete="off">
                              <div class="row">
                                 <div class="form-group col-lg-6">
                                    <label><small class="req text-danger">* </small><?= __("Name") ?></label>
                                    <input type="text" class="form-control" required name="expensename"  id="expensename" placeholder="Name">
                                 </div>
                                 <div class="form-group col-lg-6">
                                    <label><small class="req text-danger">* </small><?= __("Expense Category") ?></label>
                                    <select id="expensecategory" class="form-control" name="expensecategory" required data-url="<?= APIURL. "/expensecategories"?>">
                                       <option value=""><?= __("Select a Category") ?></option>
                                    </select>
                                    <label for="expensecategory" class="error"></label>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="expenseamount" class="control-label"><small class="req text-danger">* </small><?= __("Amount") ?></label> 
                                       <div class="input-group">
                                          <span class="input-group-addon" id="currency" style="border: 1px solid #cecece;"><?= $Settings->get("currency") ?></span>                                      
                                          <input class="form-control number" required="" placeholder="Amount" id="expenseamount" name="expenseamount" type="text" placeholder="Amount">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label><?= __("Reference") ?></label>
                                       <input type="text" class="form-control" name="expensereference"  id="expensereference" placeholder="<?= __("Reference") ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="form-group col-lg-6" id="expensedate">
                                    <label for="date" class="control-label"> 
                                    <small class="req text-danger">* </small><?= __("Date") ?></label>
                                    <div  class="input-group date" data-date-format="mm-dd-yyyy">
                                       <input id="edate" class="form-control" required name="edate" type="text" value="<?= date("Y-m-d")?>"/>
                                       <span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
                                    </div>
                                 </div>
                                 <div class="form-group col-lg-6">
                                    <label><small class="req text-danger">* </small><?= __("Account") ?></label>
                                    <select id="expenseaccount" class="form-control" name="expenseaccount" required></select>
                                    <label for="expenseaccount" class="error"></label>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="form-group col-lg-12">
                                    <label><?= __("Note") ?></label>
                                    <textarea id="expensenote" class="form-control" placeholder="<?= __("Note") ?>"></textarea>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-12 pt-3 pb-3">
                                    <button id="expensesave" class="btn btn-info btn-fill btn-wd"/><i class="ti-check"></i> <?= __("Save Expense") ?></button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>