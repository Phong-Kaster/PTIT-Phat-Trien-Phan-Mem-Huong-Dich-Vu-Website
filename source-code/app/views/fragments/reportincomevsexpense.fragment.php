<div class="content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-4 pb-2" id="gettotal_income" data-url="<?= APIURL."/transactions/income/gettotal" ?>">
                     <div class="d-flex align-items-center">
                        <div class="home-icon-content background-blue color-white p-3 rounded flex-fill">
                           <p class="home-icon mb-0"><i class="ti-angle-double-up"></i></p>
                        </div>
                        <div class="background-grey p-3 rounded flex-fill">
                           <p class="transactiontitle"><span class="currency"><?= $Settings->get("currency") ?></span><span class="incomeyear"></span></p>
                           <p class="small-font mb-0"><?= __("In This Year") ?> </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 pb-2">
                     <div class="d-flex align-items-center" id="gettotal_expense" data-url="<?= APIURL."/transactions/expense/gettotal" ?>">
                        <div class="home-icon-content background-red color-white p-3 rounded flex-fill">
                           <p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
                        </div>
                        <div class="background-grey p-3 rounded flex-fill">
                           <p class="transactiontitle"><span class="currency"><?= $Settings->get("currency") ?></span><span class="expenseyear"></span></p>
                           <p class="small-font mb-0"><?= __("In This Year") ?> </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 pb-2">
                     <div class="d-flex align-items-center">
                        <div class="home-icon-content background-green color-white p-3 rounded flex-fill">
                           <p class="home-icon mb-0"><i class="ti-wallet"></i></p>
                        </div>
                        <div class="background-grey p-3 rounded flex-fill">
                           <p class="transactiontitle"><span class="currency"><?= $Settings->get("currency") ?></span><span class="totalbalance"></span></p>
                           <p class="small-font mb-0"><?= __("Balance In This Year") ?> </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12 col-md-12 pt-3">
                     <div class="card">
                        <div class="header">
                           <h4 class="title"><?= __("Income vs Expense Reports") ?></h4>
                        </div>
                        <div class="content">
                           <canvas id="incomevsexpense"></canvas>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>