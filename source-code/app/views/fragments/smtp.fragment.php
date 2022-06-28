<div class="content">
            <div class="container-fluid">
               <div class="row">
                  <div class="card col-xl-6">
                     <div class="header">
                        <h4 class="title"><?= __("SMTP Setting") ?></h4>
                     </div>
                     <div class="content">
                        <form action="#"  name="formsetting" id="formsetting" method="POST">
                           <input type="hidden" name="action" value="save">
                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <div class="form-label"><?= __("SMTP Server") ?></div>
                                    <input class="form-control"
                                          name="host" 
                                          type="text" 
                                          value="<?= htmlchars($SMTP->get("host")) ?>" 
                                          maxlength="200">
                                    <small class="help-block"><?= __("If you left this field empty then other field values will be ignored and server's default configuration will be used.") ?></small>
                                 </div>
                              </div>

                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <div class="form-label"><?= __("From") ?></div>
                                    <input class="form-control"
                                          name="from" 
                                          type="text" 
                                          value="<?= htmlchars($SMTP->get("from")) ?>" 
                                          maxlength="200">
                                    <small class="help-block"><?= __("All emails will be sent from this email address.") ?></small>
                                 </div>
                                 
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <div class="form-label"><?= __("Port") ?></div>
                                          <select name="port" class="form-control">
                                             <?php $port = $SMTP->get("port") ?>
                                             <option value="25" <?= $port == "25" ? "selected" : "" ?>>25</option>
                                             <option value="465" <?= $port == "465" ? "selected" : "" ?>>465</option>
                                             <option value="587" <?= $port == "587" ? "selected" : "" ?>>587</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <div class="form-label"><?= __("Encryption") ?></div>
                                          <select name="encryption" class="form-control">
                                             <?php $encryption = $SMTP->get("encryption") ?>
                                             <option value=""><?= __("None") ?></option>
                                             <option value="ssl" <?= $encryption == "ssl" ? "selected" : "" ?>>SSL</option>
                                             <option value="tls" <?= $encryption == "tls" ? "selected" : "" ?>>TLS</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 ml-4">
                                 <div class="checkbox">
                                    <input class="form-check-input" type="checkbox" name="auth" value="1" <?= $SMTP->get("auth") ? "checked" : "" ?>>
                                    <label class="form-check-label"><?= __('SMTP Auth') ?></label>
                                 </div>
                              </div>  
                           </div>
                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label class="form-label"><?= __("Auth. username") ?></label>

                                    <input class="form-control"
                                             name="username" 
                                             type="text" 
                                             value="<?= htmlchars($SMTP->get("username")) ?>" 
                                             maxlength="200">
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group">
                                       <label class="form-label"><?= __("Auth. password") ?></label>


                                       <input class="form-control"
                                             name="password" 
                                             type="password" 
                                             value="<?= htmlchars($SMTP->get("password")) ?>" 
                                             maxlength="200">
                                 </div>
                              </div>  
                           </div>
                           <div class="col-lg-6" style="padding-left:15px;padding-bottom:15px;">
                              <button type="submit" class="btn btn-info btn-fill btn-wd" id="save"><i class="ti-check"></i> <?= __("Save Setting") ?></button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>