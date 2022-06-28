<div class="content">
            <div class="container-fluid">
               <div class="row" id="gettotal_expense" data-url="<?= APIURL."/transactions/expense/gettotal" ?> ">
                  <div class="col-md-3 pb-2">
                     <div class="d-flex align-items-center">
                        <div class="home-icon-content background-red color-white p-3 rounded flex-fill">
                           <p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
                        </div>
                        <div class="background-grey p-3 rounded flex-fill">
                           <p class="transactiontitle"><span class="currency"><?= $Settings->get("currency") ?></span><span id="overall"></span></p>
                           <p class="small-font mb-0"><?= __("Overall") ?></p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 pb-2">
                     <div class="d-flex align-items-center">
                        <div class="home-icon-content background-red color-white p-3 rounded flex-fill">
                           <p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
                        </div>
                        <div class="background-grey p-3 rounded flex-fill">
                           <p class="transactiontitle"><span class="currency"><?= $Settings->get("currency") ?></span><span id="month"></span></p>
                           <p class="small-font mb-0"><?= __("This Month") ?></p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 pb-2">
                     <div class="d-flex align-items-center">
                        <div class="home-icon-content background-red color-white p-3 rounded flex-fill">
                           <p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
                        </div>
                        <div class="background-grey p-3 rounded flex-fill">
                           <p class="transactiontitle"><span class="currency"><?= $Settings->get("currency") ?></span><span id="week"></span></p>
                           <p class="small-font mb-0"><?= __("This Week") ?></p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 pb-2">
                     <div class="d-flex align-items-center">
                        <div class="home-icon-content background-red color-white p-3 rounded flex-fill">
                           <p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
                        </div>
                        <div class="background-grey p-3 rounded flex-fill">
                           <p class="transactiontitle"><span class="currency"><?= $Settings->get("currency") ?></span><span id="today"></span></p>
                           <p class="small-font mb-0"><?= __("Today") ?></p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-md-11 pt-4">
                     <div class="card">
                        <div class="header">
                           <div class="d-flex justify-content-between flex-sm-row flex-column">
                              <div class="pb-3 pb-md-0">
                                 <h4 class="title"><?= __("Expense List") ?></h4>
                              </div>
                              <div class="">
                                 <div class="d-flex flex-row">
                                    <a href="<?= APPURL ?>/transaction" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?= __("Add New Expense") ?></a>
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
                                       <th><?= __("Name") ?></th>
                                       <th><?= __("Amount") ?></th>
                                       <th><?= __("Date") ?></th>
                                       <th><?= __("Category") ?></th>
                                       <th><?= __("Account") ?></th>
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
         <!--edit data -->
         <div id="edit" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <form action="#" id="formeditexpense" enctype="multipart/form-data" autocomplete="off">
                     <div class="modal-header">
                        <h5 class="modal-title"><?= __("Edit") ?></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label><small class="req text-danger">* </small><?= __("Name") ?></label>
                                 <input type="text" class="form-control" name="expensename" required id="expensename" placeholder="<?= __("Name") ?>">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="expenseamount" class="control-label"><small class="req text-danger">* </small><?= __("Amount") ?></label> 
                                 <div class="input-group">
                                    <span class="input-group-addon currency" id="currency" style="border: 1px solid #cecece;"><?= $Settings->get("currency") ?></span>                                      
                                    <input class="form-control number" required  id="expenseamount" name="expenseamount" type="text" placeholder="<?= __("Amount") ?>">
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
                                 <input id="edate" class="form-control" name="edate" required type="text" value="2022-01-24"/>
                                 <span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
                              </div>
                           </div>
                           <div class="form-group col-lg-6">
                              <label><small class="req text-danger">* </small><?= __("Account") ?></label>
                              <select id="expenseaccount" name="expenseaccount" required class="form-control" data-url="<?= APIURL."/accounts" ?>"></select>
                              <label for="expenseaccount" class="error"></label>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-lg-6">
                              <label><small class="req text-danger">* </small><?= __("Expense Category") ?></label>
                              <select id="expensecategory" class="form-control" name="expensecategory" required data-url="<?= APIURL."/expensecategories" ?>">
                                 <option value=""><?= __("Select a Category") ?></option>
                              </select>
                              <label for="expensecategory" class="error"></label>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-lg-12">
                              <label><?= __("Note") ?></label>
                              <textarea id="expensenote" class="form-control" name="expensenote" placeholder="<?= __("Note") ?>"></textarea>
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