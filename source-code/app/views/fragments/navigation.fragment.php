<div class="sidebar">
         <div class=" sidebar-wrapper">
            <div class="logo">
               <img class="logoimg" src="<?= $Settings->get("logomark") ? $Settings->get("logomark") : APPURL."/assets/img/Udebox.png" ?>" style="width:200px"/>
               </a>
            </div>
            <ul class="nav">

               <li class="<?= $Nav->activeMenu == "dashboard" ? "active" : "" ?>">
                  <a href="<?= APPURL ?>" >
                    <i class="ti-panel"></i>
                    <?= __("Dashboard") ?>
                  </a>
               </li>
               
              
               <li class="<?= $Nav->activeMenu == "transaction" ? "active" : "" ?>">
                  <a href="<?= APPURL."/transaction" ?>" >
                     <i class="ti-direction-alt"></i>
                     <?= __("Transactions") ?>
                  </a>
               </li>

               <li class="<?= $Nav->activeMenu == "income" ? "active" : "" ?>">
                  <a href="<?= APPURL."/income" ?>" >
                     <i class="ti-stats-up"></i>
                     <?= __("Income") ?>
                  </a>
               </li>

               <li class="<?= $Nav->activeMenu == "expense" ? "active" : "" ?>">
                  <a href="<?= APPURL."/expense" ?>" >
                     <i class="ti-stats-down"></i>
                     <?= __("Expense") ?>
                  </a>
               </li>

               <li class="<?= $Nav->activeMenu == "accounts" ? "active" : "" ?>">
                  <a href="<?= APPURL."/accounts" ?>" >
                     <i class="ti-wallet"></i>
                     <?= __("Accounts") ?>
                  </a>
               </li>

               <li class="<?= $Nav->activeMenu == "budgets" ? "active" : "" ?>">
                  <a href="<?= APPURL."/budgets" ?>" >
                     <i class="ti-package"></i>
                     <?= __("Track Budget") ?>
                  </a>
               </li>

               <li class="<?= $Nav->activeMenu == "goals" ? "active" : "" ?>">
                  <a href="<?= APPURL."/goals" ?>" >
                     <i class="ti-cup"></i>
                     <?= __("Set Goals                ") ?>
                  </a>
               </li>

               <li class="<?= $Nav->activeMenu == "calendar" ? "active" : "" ?>">
                  <a href="<?= APPURL."/calendar" ?>" >
                     <i class="ti-calendar"></i>
                     <?= __("Calendar") ?>
                  </a>
               </li>

               <li class="<?= $Nav->activeMenu == "report" ? "active" : "" ?>">
                  <a href="<?= APPURL."/reports/allreports" ?>" >
                     <i class="ti-pie-chart"></i>
                     <?= __("Reports") ?>
                  </a>
               </li>

               <!--Only adminstrator see this menu option-->
               <?php if( $AuthUser->isAdmin() ): ?>
                  <li class="<?= $Nav->activeMenu == "users" ? "active" : "" ?>">
                     <a href="<?= APPURL."/users" ?>" >
                        <i class="ti-user"></i>
                        <?= __("Users") ?>
                     </a>
                  </li>
               <?php endif; ?>
               <li>
                  <a data-toggle="collapse" href="#category" class="<?= in_array($Nav->activeMenu, ["incomecategory", "expensecategory"]) ? "" : "collapsed" ?>" aria-expanded="false">
                     <i class="ti-flag-alt"></i>
                     <?= __("Category") ?><b class="caret"></b>
                  </a>
                  <div class="collapse <?= in_array($Nav->activeMenu, ["incomecategory", "expensecategory"]) ? "show" : "" ?>" id="category" aria-expanded="false">
                     <ul class="nav">
                        <li class="<?= $Nav->activeMenu == "incomecategory" ? "active" : "" ?>">
                           <a href="<?= APPURL."/incomecategory" ?>" >
                           <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                           <span class="sidebar-normal"><?= __("Income Category") ?></span>
                           </a>
                        </li>
                        <li class="<?= $Nav->activeMenu == "expensecategory" ? "active" : "" ?>">
                           <a href="<?= APPURL."/expensecategory" ?>" >
                           <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                           <span class="sidebar-normal"><?= __("Expense Category") ?></span>
                           </a>
                        </li>
                     </ul>
                  </div>
               </li>
               <li>
                  <a data-toggle="collapse" href="#settings" class="<?= in_array($Nav->activeMenu, ["profile", "application", "smtp"]) ? "" : "collapsed" ?>" aria-expanded="false">
                  <i class="ti-settings"></i>
                  <?= __("Settings") ?><b class="caret"></b>
                  </a>
                  <div class="collapse <?= in_array($Nav->activeMenu, ["profile", "application", "smtp"]) ? "show" : "" ?>" id="settings" aria-expanded="false">
                     <ul class="nav">
                        <li class="<?= $Nav->activeMenu == "profile" ? "active" : "" ?>">
                           <a href="<?= APPURL."/settings/profile" ?>" >
                           <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                           <span class="sidebar-normal"><?= __("Profile Setting") ?></span>
                           </a>
                        </li>
                        <?php if($AuthUser->isAdmin()): ?>
                        <li class="<?= $Nav->activeMenu == "application" ? "active" : "" ?>">
                           <a href="<?= APPURL."/settings/application" ?>" >
                           <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                           <span class="sidebar-normal"><?= __("Application Setting") ?></span>
                           </a>
                        </li>
                        <li class="<?= $Nav->activeMenu == "smtp" ? "active" : "" ?>">
                           <a href="<?= APPURL."/settings/smtp" ?>" >
                           <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                           <span class="sidebar-normal"><?= __("Email Setting") ?></span>
                           </a>
                        </li>
                        <?php endif; ?>
                     </ul>
                  </div>
            </ul>
         </div>
      </div>