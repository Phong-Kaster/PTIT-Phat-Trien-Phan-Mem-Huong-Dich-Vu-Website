<div class="content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12 col-md-11">
                     <div class="card">
                        <div class="header">
                           <h4 class="title"><?= __("Income Reports") ?></h4>
                        </div>
                        <form action="" method="POST" id="form" autocomplete="off">
                           <div class="content">
                              <div class="row">
                                 <div class="col-md-4 mt-4 mt-md-2">
                                    <label><?= __("Name" ) ?></label>
                                    <input id="name" type="text" class="form-control" name="name" placeholder="<?= __("Name") ?>"/>
                                 </div>
                                 <div class="col-md-4 mt-4 mt-md-2">
                                    <label><?= __("Category" ) ?></label>
                                    <select id="incomecategory" class="form-control" name="category" data-url="<?= APIURL ?>/incomecategories">
                                       <option value=""><?= __("Select a Category") ?></option>
                                    </select>
                                 </div>
                                 <div class="col-md-4 mt-4 mt-md-2">
                                    <label><?= __("Account" ) ?></label>
                                    <select id="incomeaccount" class="form-control" name="incomeaccount" data-url="<?= APIURL ?>/accounts">
                                    <option value=""><?= __("Select a Category") ?></option>
                                    </select>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-4 mt-4 mt-md-2">
                                    <label for="date" class="control-label"> <?= __("From Date") ?></label>
                                    <div  class="input-group date" data-date-format="mm-dd-yyyy">
                                       <input id="fromdate" name="fromdate" class="form-control" type="text" value=""/>
                                       <span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 mt-2 mt-md-2">
                                    <label for="date" class="control-label"> <?= __("To Date") ?></label>
                                    <div  class="input-group date" data-date-format="mm-dd-yyyy">
                                       <input id="todate" name="todate" class="form-control" type="text" value=""/>
                                       <span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="d-flex flex-sm-row flex-column pb-2">
                                 <div class="pb-3 pb-md-0 mr-3">
                                    <button id="reset" type="button" class="btn btn-secondary btn-fill btn-wd"><i class="ti-reload"></i> <?= __("Reset") ?></button>
                                 </div>
                                 <div class="d-flex flex-row">
                                    <button type="submit" class="btn btn-info btn-fill btn-wd"><i class="ti-search"></i> <?= __("Search") ?></button>
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
                           <h4 class="title"><?= __("Income Reports") ?></h4>
                        </div>
                        <div class="content">
                           <div class="table-responsive">
                              <table id="data" class="table" cellspacing="0" width="100%">
                                 <thead>
                                    <tr>
                                       <th><?= __("Name") ?></th>
                                       <th><?= __("Category") ?></th>
                                       <th><?= __("Account") ?></th>
                                       <th><?= __("Amount") ?></th>
                                       <th><?= __("Date") ?></th>
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
                  <div class="col-lg-6">
                     <div class="card">
                        <div class="header">
                           <div class="pull-left">
                              <h5><b><?= __("12 Monthly Income Chart") ?></b></h5>
                           </div>
                           <div class="pull-right">
                              <div class="text-success">
                                 <b><span class="currency"><?= $Settings->get("currency") ?></span><span id="totalyear"></span></b><br/>
                                 <small><?= __("In This Year") ?></small>
                              </div>
                           </div>
                        </div>
                        <div class="content">
                           <input type="hidden" class="currency"/>
                           <canvas id="chart1"></canvas>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="card">
                        <div class="header">
                           <h5><b><?= __("Income By Category") ?> <?= date("Y") ?></b></h5>
                        </div>
                        <div class="content">
                           <canvas id="chart2"></canvas>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>