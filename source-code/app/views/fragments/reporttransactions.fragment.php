<div class="content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12 col-md-11">
                     <div class="card">
                        <div class="header">
                           <h4 class="title"><?= __("Account Transaction Reports") ?></h4>
                        </div>
                        <form action="" method="POST" id="form" autocomplete="off">
                           <div class="content">
                              <div class="row">
                                 <div class="col-md-4 mt-4 mt-md-2">
                                    <label><?= __("Name") ?></label>
                                    <input id="name" type="text" class="form-control" name="name" placeholder="<?= __("Name") ?>"/>
                                 </div>
                                 <div class="col-md-4 mt-4 mt-md-2" id="getaccount" data-url="<?= APIURL ?>/accounts">
                                    <label><?= __("Account") ?></label>
                                    <select id="account" class="form-control" name="account" required >
                                       <option value=""><?= __("Select a Account") ?></option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-4 mt-4 mt-md-2">
                                    <label for="date" class="control-label"><?= __("From Date") ?></label>
                                    <div  class="input-group date" data-date-format="mm-dd-yyyy">
                                       <input id="fromdate" name="fromdate" class="form-control" type="text" value=""/>
                                       <span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
                                    </div>
                                 </div>
                                 <div class="col-md-4 mt-2 mt-md-2">
                                    <label for="date" class="control-label"> <?= __("To Date") ?></label>
                                    <div  class="input-group date" data-date-format="mm-dd-yyyy">
                                       <input id="todate" name="todate" class="form-control" type="text" value=""/>
                                       <span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="d-flex flex-sm-row flex-column pb-2">
                                 <div class="pb-3 pb-md-0 mr-3">
                                    <button id="reset" type="button" class="btn btn-secondary btn-fill btn-wd"><i class="ti-reload"></i> Reset</button>
                                 </div>
                                 <div class="d-flex flex-row">
                                    <button type="submit" class="btn btn-info btn-fill btn-wd"><i class="ti-search"></i> Search</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12 col-md-11">
                     <div class="card">
                        <div class="header">
                           <h4 class="title"><?= __("Account Transaction Reports") ?></h4>
                        </div>
                        <div class="content">
                           <div class="table-responsive">
                              <table id="data" class="table"  cellspacing="0" width="100%">
                                 <thead>
                                    <tr>
                                       <th><?= __("Name") ?></th>
                                       <th><?= __("Category") ?></th>
                                       <th><?= __("Reference") ?></th>
                                       <th><?= __("Description") ?></th>
                                       <th><?= __("Date") ?></th>
                                       <th><?= __("Income") ?></th>
                                       <th><?= __("Expense") ?></th>
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
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="header">
                           <div class="pull-left">
                              <h5><b><?= __("Account Chart") ?></b></h5>
                           </div>
                           <div class="pull-right">
                              <div class="text-danger">
                                 <b><span></span></b><br/>
                                 <small></small>
                              </div>
                           </div>
                        </div>
                        <div class="content">
                           <canvas id="accountbalance"></canvas>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>