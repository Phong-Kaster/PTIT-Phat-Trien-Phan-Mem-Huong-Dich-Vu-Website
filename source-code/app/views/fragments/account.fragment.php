<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-11">
            <div class="card">
               <div class="header">
                  <div class="d-flex justify-content-between flex-sm-row flex-column">
                     <div class="pb-3 pb-md-0">
                        <input type="hidden" value=<?= $accountid ?> id="idbank"/>
                        <h4 class="title bankname"></h4>
                        <h5 class="accountnumber mb-0"></h5>
                     </div>
                     <div class="">
                        <div class="d-flex flex-row">
                           <a data-url="<?= APIURL. "/accounts" ?>" href="javascript:void(0)" data-id="<?= $accountid ?>" class="btndelete btn btn-sm btn-fill"><i class="ti-trash"></i> <?= __("Delete Account") ?></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="content">
                  <div class="row">
                     <div class="col-lg-4">
                        <h4 class="mt-0 mb-0"><span class="currency text-success"><?= $Settings->get("currency") ?></span><span class="accountbalance text-success"></span></h4>
                        <small><?= __("Account Balance") ?></small>
                     </div>
                     <div class="col-lg-8 mt-md-0 mt-3">
                        <canvas  id="accountgraph" height="50"></canvas>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-12 col-md-11">
            <div class="card">
               <div class="header">
                  <div class="row">
                     <div class="col-lg-6">
                        <h5 class="title"><?= __("Account Transaction Reports") ?></h5>
                     </div>
                  </div>
               </div>
               <div class="content">
                  <div class="table-responsive">
                     <table id="data" class="table" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th><?= __("Date") ?></th>
                              <th><?= __("Name") ?></th>
                              <th><?= __("Category") ?></th>
                              <th><?= __("Reference") ?></th>
                              <th><?= __("Description") ?></th>
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
   </div>
</div>