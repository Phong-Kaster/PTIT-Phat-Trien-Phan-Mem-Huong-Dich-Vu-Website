<nav class="navbar navbar-default">
            <div class="container-fluid">
               <div class="navbar-header">
                  <button type="button" class="d-none navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span> 
                  </button>
                  <a class="navbar-brand" href="#">
                     <p class="company mb-0"></p>
                  </a>
               </div>
               <!--responsive-->
               <div class="collapse" id="myNavbar">
                  <ul class="nav">
                     <li  class="active">
                        <a  href="<?= APPURL."/home" ?>">
                        Dashboard                </a>
                     </li>
                     <li class="">
                        <a href="<?= APPURL."/transaction" ?>">
                        Transactions                </a>
                     </li>
                     <li class="">
                        <a href="<?= APPURL."/income" ?>">
                        Income                </a>
                     </li>
                     <li class="">
                        <a href="<?= APPURL."/upcomingincome" ?>">
                        Upcoming Income                </a>
                     </li>
                     <li class="">
                        <a href="<?= APPURL."/expense" ?>">
                        Expense                </a>
                     </li>
                     <li class="">
                        <a href="<?= APPURL."/upcomingexpense" ?>">
                        Upcoming Expense                </a>
                     </li>
                     <li class="">
                        <a href="<?= APPURL."/account" ?>">
                        Accounts                </a>
                     </li>
                     <li class="">
                        <a href="<?= APPURL."/budget" ?>">
                        Track Budget                </a>
                     </li>
                     <li class="">
                        <a href="<?= APPURL."/goals" ?>">
                        Set Goals                </a>
                     </li>
                     <li class="">
                        <a href="<?= APPURL."/calendar" ?>">
                        Calendar                </a>
                     </li>
                     <li class="">
                        <a href="<?= APPURL."/reports/allreports" ?>">
                        Reports                </a>
                     </li>
                     <li>
                        <a data-toggle="collapse" href="#categorys" class="collapsed" aria-expanded="false">
                           <p>Category<b class="caret"></b></p>
                        </a>
                        <div class="collapse" id="categorys" aria-expanded="false" style="height: 0px;">
                           <ul class="nav">
                              <li class="">
                                 <a href="<?= APPURL."/incomecategory" ?>">
                                 <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                 <span class="sidebar-normal">Income Category</span>
                                 </a>
                              </li>
                              <li class="">
                                 <a href="<?= APPURL."/expensecategory" ?>">
                                 <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                 <span class="sidebar-normal">Expense Category</span>
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </li>
                     <li>
                        <a data-toggle="collapse" href="#settingss" class="collapsed" aria-expanded="false">
                           <p>Settings<b class="caret"></b></p>
                        </a>
                        <div class="collapse" id="settingss" aria-expanded="false" style="height: 0px;">
                           <ul class="nav">
                              <li class="">
                                 <a href="<?= APPURL."/settings/profile" ?>">
                                 <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                 <span class="sidebar-normal">Profile Setting</span>
                                 </a>
                              </li>
                              <li class="">
                                 <a href="<?= APPURL."/settings/application" ?>">
                                 <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                 <span class="sidebar-normal">Application Setting</span>
                                 </a>
                              </li>
                           </ul>
                        </div>
                  </ul>
               </div>
               <!--end responsive-->

               <!-- -->
               <div class="d-none d-md-block ">
                  <ul class="right-nav mb-0">
                     <li>
                        <a href="#">
                        <i class="ti-user"></i>
                        Welcome, <?= $AuthUser->get("lastname"); ?>
                        </a>
                     </li>
                     <li>
                        <a href="<?= APPURL."/settings/profile" ?>">
                        <i class="ti-settings"></i>
                        Profile Setting                    </a>
                     </li>
                     <li>
                        <a href="<?= APPURL."/logout" ?>">
                        <i class="ti-back-right"></i>
                        Logout                    </a>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>