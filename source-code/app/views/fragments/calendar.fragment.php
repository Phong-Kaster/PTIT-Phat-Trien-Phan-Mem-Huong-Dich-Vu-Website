<div class="content"><!-- content -->

		    <div class="container-fluid">
			<div class="row">
					<div class="col-md-4 pb-2">
								<div class="d-flex align-items-center">
		                    <div class="home-icon-content background-blue color-white p-3 rounded flex-fill">
		                        <p class="home-icon mb-0"><i class="ti-angle-double-up"></i></p>
		                    </div>
		                    <div class="background-grey p-3 rounded flex-fill">
		                        <p class="transactiontitle"><span class="currency"><?= $Settings->get("currency") ?></span><span id="incomemonth"></span></p> 
		                        <p class="small-font mb-0"><?= __("This Month") ?> (<?= date("F") ?>)</p>
		                    </div>
		                </div>
		            </div>

								<div class="col-md-4 pb-2">
		                <div class="d-flex align-items-center">
		                    <div class="home-icon-content background-red color-white p-3 rounded flex-fill">
		                        <p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
		                    </div>
		                    <div class="background-grey p-3 rounded flex-fill">
		                        <p class="transactiontitle"><span class="currency"><?= $Settings->get("currency") ?></span><span id="expensemonth"></span></p> 
		                        <p class="small-font mb-0"><?= __("This Month") ?> (<?= date("F") ?>)</p>
		                    </div>
		                </div>
		            </div>

		            <div class="col-md-4 pb-2">
		                <div class="d-flex align-items-center">
		                    <div class="home-icon-content background-green color-white p-3 rounded flex-fill">
		                        <p class="home-icon mb-0"><i class="ti-wallet"></i></p>
		                    </div>
		                    <div class="background-grey p-3 rounded flex-fill">
		                        <p class="transactiontitle"><span class="currency"><?= $Settings->get("currency") ?></span><span id="monthbalance"></span></p> 
		                        <p class="small-font mb-0"><?= __("Balance This Month") ?> (<?= date("F") ?>)</p>
		                    </div>
		                </div>
		            </div>

		           
		            <div class="col-lg-12 col-md-11 pt-4">
		                <div class="card">
		                	<div class="header">
		                			<h4 class="title"><?= __("Income / Expense") ?></h4> 
		                	</div>
		                	<div class="content">
													<div id="mycalendar"></div>
											</div>
		                </div>
		            </div>
			</div>

		</div><!-- end content -->