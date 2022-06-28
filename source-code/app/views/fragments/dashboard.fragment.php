<div class="content">
            <div class="p-3">
               <div class="row ">
                  <div class="col-md-4 border-right">
                     <h4 class="title mt-0">
                     <?= __("Transactions") ?>
                     <h4>
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" id="income-tab" data-toggle="tab" href="#income" role="tab" aria-controls="income" aria-selected="true"><?= __("Income") ?></a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="expense-tab" data-toggle="tab" href="#expense" role="tab" aria-controls="expense" aria-selected="false"><?= __("Expense") ?></a>
                        </li>
                     </ul>
                     <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="income" role="tabpanel" aria-labelledby="income-tab">
                           <ul class="latestincome pt-3">
                           </ul>
                        </div>
                        <div class="tab-pane fade" id="expense" role="tabpanel" aria-labelledby="expense-tab">
                           <ul class="latestexpense pt-3">
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-5 border-right">
                     <div class="row">
                        <div class="col-md-6">
                           <h4 class="title mb-0 mt-0">
                           <?= __("Income") ?>
                           <h4>
                           <div class="d-flex align-items-center">
                              <div class="home-icon-content background-blue color-white p-3 rounded flex-fill">
                                 <p class="home-icon mb-0"><i class="ti-angle-double-up"></i></p>
                              </div>
                              <div class="background-grey p-3 rounded flex-fill">
                                 <p class="transactiontitle"><span class="currency"><?= $Settings->get("currency") ?></span><span class="incomethismonth"></span></p>
                                 <p class="small-font mb-0"><?= __("This Month") ?></p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <h4 class="title mb-0 mt-0">
                           <?= __("Expense") ?>
                           <h4>
                           <div class="d-flex align-items-center">
                              <div class="home-icon-content background-red color-white p-3 rounded flex-fill">
                                 <p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
                              </div>
                              <div class="background-grey p-3 rounded flex-fill">
                                 <p class="transactiontitle"><span class="currency"><?= $Settings->get("currency") ?></span><span class="expensemonth"></span></p>
                                 <p class="small-font mb-0"><?= __("This Month") ?> (<?= date("F") ?>)</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <h4 class="title mb-0">
                           <?= __("Income & Expense") ?> <?= date("Y") ?>
                           <h4>
                           <canvas id="incomevsexpense" height="100"></canvas>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <h4 class="title mb-0">
                           <?= __("Income By Category") ?> <?= date("F Y") ?>
                           <h4>
                           <canvas id="incomebycategory" height="200"></canvas>
                        </div>
                        <div class="col-md-6">
                           <h4 class="title mb-0">
                           <?= __("Expense By Category") ?> <?= date("F Y") ?>
                           <h4>
                           <canvas id="expensebycategory" height="200"></canvas>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 ">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="rounded background-green color-white p-4">
                              <p class=""><?= __("Balance") ?></p>
                              <p class="transactiontitle"><span class="currency"><?= $Settings->get("currency") ?></span><span class="totalbalance"></span></p>
                              <p class="small-font mb-0"><?= __("This Month") ?> (<?= date("F") ?>)</p>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <h4 class="title  mb-0">
                           <?= __("Account Balance") ?> <?= date("Y") ?>
                           <h4>
                           <canvas id="accountbalance" height="100"></canvas>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="rounded background-grey p-4">
                              <h4 class="title mt-0"><?= __("Quick Menu") ?></h4>
                              <ul class="quick-menu">
                                 <li class="">
                                    <a href="<?= APPURL."/transaction" ?>"><?= __("Transactions") ?> <i class="ti-angle-right"></i></a>
                                 </li>
                                 <li class="">
                                    <a href="<?= APPURL."/income" ?>" ><?= __("Income Statistics") ?><i class="ti-angle-right"></i></a>
                                 </li>
                                 <li class="">
                                    <a href="<?= APPURL."/expense" ?>" ><?= __("Expense Statistics") ?><i class="ti-angle-right"></i>
                                    </a>
                                 </li>
                                 <li class="">
                                    <a href="<?= APPURL."/budgets" ?>" ><?= __("Budgets") ?><i class="ti-angle-right"></i>
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>