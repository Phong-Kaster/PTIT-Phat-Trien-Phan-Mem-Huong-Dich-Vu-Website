<div class="content">
   <!-- content -->
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-11">
            <div class="card">
               <div class="header">
                  <div class="d-flex justify-content-between flex-sm-row flex-column">
                     <div class="pb-3 pb-md-0">
                        <h4 class="title"><?= __("Goals List") ?></h4>
                     </div>
                     <div class="">
                        <div class="d-flex flex-row">
                           <a href="#" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?= __("Add Goal") ?></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="content">
                  <div class="table-responsive">
                     <table id="data" class="table" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th><?= __("Goal ID") ?></th>
                              <th><?= __("Name") ?></th>
                              <th><?= __("Opening") ?></th>
                              <th><?= __("Amount") ?></th>
                              <th><?= __("Remaining") ?></th>
                              <th><?= __("Date") ?></th>
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
<!-- end content -->

<!-- end delete data -->
<div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="#" id="formedit" autocomplete="off">
            	<div class="modal-header">
                <h5 class="modal-title"><?= __("Edit") ?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
               <div class="row">
					 <div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?= __("Name") ?></label>
					    <input type="text" class="form-control" name="editname" required  id="editname" placeholder="Name">
					</div>
					<div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?= __("Opening Balance") ?></label>
					    <div class="input-group">
							<span class="input-group-addon currency" id="currency"  style="border: 1px solid #cecece;"><?= $Settings->get("currency") ?></span>
								<input class="form-control number" required placeholder="<?= __("Opening Balance") ?>" id="editopening" name="editopening" type="text" >
						</div>
					</div>
					
				</div>
                <div class="row">
					<div class="form-group col-lg-6">
					<label><small class="req text-danger">* </small><?= __("Target") ?></label>
						<div class="input-group">
							<span class="input-group-addon currency" id="editcurrency"  style="border: 1px solid #cecece;"><?= $Settings->get("currency") ?></span>
								<input class="form-control number" required placeholder="<?= __("Target") ?>" id="edittarget" name="edittarget" type="text" >
						</div>
					</div>
					<div class="form-group col-lg-6" id="targetdate">
									<label for="date" class="control-label"> 
									<small class="req text-danger">* </small><?= __("Target Date") ?></label>
									<div  class="input-group date" data-date-format="mm-dd-yyyy">
										<input id="edate" class="form-control" type="text" value="<?= date("Y-m-d") ?>" required name="edate"/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
					</div>
				</div>
              </div>
              <div class="modal-footer">
				<input type="hidden" value="" name="id" id="idedit"/>
                <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?= __("Close") ?></button>
                <input type="submit" class="btn btn-sm btn-fill btn-info" value="<?= __("Save") ?>"/>
              </div>
            </form>
          </div>
        </div>
      </div> 
  
</div>	
<!--end edit data -->
<div id="deposit" class="modal fade" role="dialog">
   <!-- Make deposit -->
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <form action="#" id="formdeposit" autocomplete="off">
            <div class="modal-header">
               <h5 class="modal-title"><?= __("Deposit") ?></h5>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="form-group col-lg-12">
                     <label><small class="req text-danger">* </small><?= __("Deposit") ?></label>
                     <div class="input-group">
                        <span class="input-group-addon currency" id="currency" style="border: 1px solid #cecece;"><?= $Settings->get("currency") ?></span>
                        <input class="form-control number" required placeholder="<?= __("Deposit") ?>" id="depositvalue" name="depositvalue" type="text" >
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <input type="hidden" value="" name="id" id="iddeposit"/>
               <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?= __("Close") ?></button>
               <input type="submit" class="btn btn-sm btn-fill btn-info" value="<?= __("Save") ?>"/>
            </div>
         </form>
      </div>
   </div>
   
   <!-- div id=add stand here before -->
</div><!-- End Make deposit -->


<div id="add" class="modal fade" role="dialog">
      <!--add new data -->
      <div class="modal-dialog">
         <div class="modal-content">
            <form action="#" id="formadd"  autocomplete="off">
               <div class="modal-header">
                  <h5 class="modal-title"><?= __("Add Goal") ?></h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="form-group col-lg-6">
                        <label><small class="req text-danger">* </small><?= __("Name") ?></label>
                        <input type="text" class="form-control" name="name" required  id="name" placeholder="<?= __("Name") ?>">
                     </div>
                     <div class="form-group col-lg-6">
                        <label><small class="req text-danger">* </small><?= __("Opening Balance") ?></label>
                        <div class="input-group">
                           <span class="input-group-addon currency" id="currency"  style="border: 1px solid #cecece;"><?= $Settings->get("currency") ?></span>
                           <input class="form-control number" placeholder="<?= __("Opening Balance") ?>" id="opening" name="opening" type="text" >
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="form-group col-lg-6">
                        <label><small class="req text-danger">* </small><?= __("Target") ?></label>
                        <div class="input-group">
                           <span class="input-group-addon currency" id="goalcurrency"  style="border: 1px solid #cecece;"><?= $Settings->get("currency") ?></span>
                           <input class="form-control number" required placeholder="<?= __("Target") ?>" id="target" name="target" type="text" >
                        </div>
                     </div>

                     <div class="form-group col-lg-6">
                        <label for="date" class="control-label"> 
                        <small class="req text-danger">* </small><?= __("Target Date") ?></label>
                        <div  class="input-group date" data-date-format="mm-dd-yyyy">
                           <input id="tdate" class="form-control" type="text" value="<?= date("Y-m-d") ?>" required name="tdate" id="tdate" placeholder="<?= __("Target Date") ?>"/>
                           <span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?= __("Close") ?></button>
                  <input type="submit" class="btn btn-sm btn-fill btn-info" id="save" value="<?= __("Save") ?>"/>
               </div>
            </form>
         </div>
      </div>
   </div>
<!--end add new data -->
</div><!-- end right screen -->