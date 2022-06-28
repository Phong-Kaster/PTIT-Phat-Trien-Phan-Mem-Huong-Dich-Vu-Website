<div class="content">
            <div class="container-fluid">
               <div class="row">
                  <div class="card col-xl-8 col-md-12 col-xs-12">
                     <div class="header">
                        <h4 class="title"><?= __("Application Setting") ?></h4>
                     </div>
                     <div class="content">
                        <form action="#"  name="formsetting" id="formsetting" method="POST">
                           <input type="hidden" name="action" value="save">
                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label><?= __("Site Name") ?></label>
                                    <input type="text" class="form-control" name="site_name"  id="site_name" placeholder="<?= __("Site Name") ?>" required value="<?= htmlchars($Settings->get("site_name")) ?>">
                                 </div>
                                 <div class="form-group">
                                    <label><?= __("Site Slogan") ?></label>
                                    <input type="text" class="form-control" name="site_slogan"  id="site_slogan" placeholder="<?= __("Site Slogan") ?>" required value="<?= htmlchars($Settings->get("site_slogan")) ?>">
                                 </div>
                                 <div class="form-group">
                                    <label><?= __("Site Description ") ?></label>
                                    <textarea class="form-control" name="site_description"  id="site_description" placeholder="<?= __("Site Description ") ?>" required><?= $Settings->get("site_description") ?></textarea>
                                 </div>
                                 <div class="form-group">
                                    <label><?= __("Currency") ?></label>
                                    <input type="text" class="form-control" name="currency"  id="currency" placeholder="<?= __("Currency") ?>" required value="<?= htmlchars($Settings->get("currency")) ?>">
                                 </div>
                                 
                                
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label><?= __("Logotype") ?></label>
                                    <div class="input-group">
                                       <input class="form-control"
                                             name="logotype" 
                                             id="logotype"
                                             type="text" 
                                             value="<?= htmlchars($Settings->get("logotype")) ?>" 
                                             maxlength="100">
                                       <span class="input-group-append">
                                             <button type="button" class="btn btn-primary logotype"><i class="fa fa-image"></i></button>
                                       </span>
                                    </div>
                                 </div>
                                 
                                 <div class="form-group">
                                    <label><?= __("Logomark") ?></label>
                                    <div class="input-group">
                                       <input class="form-control"
                                             name="logomark" 
                                             id="logomark"
                                             type="text" 
                                             value="<?= htmlchars($Settings->get("logomark")) ?>" 
                                             maxlength="100">
                                       <span class="input-group-append">
                                             <button type="button" class="btn btn-primary logomark"><i class="fa fa-image"></i></button>
                                       </span>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label><?= __("Site Keywords") ?></label>
                                    <textarea class="form-control" name="site_keywords"  id="site_keywords" placeholder="<?= __("Site Keywords") ?>" required><?= $Settings->get("site_keywords") ?></textarea>
                                 </div>
                                 <div class="form-group">
                                    <label><?= __("Language") ?></label>
                                    <?php $l = $Settings->get("language"); ?>
                                    <select name="language" id="language" class="form-control valid" required="" aria-invalid="false">
                                       <?php foreach (Config::get("applangs") as $al): ?>
                                             <option value="<?= $al["code"] ?>" <?= $al["code"] == $l ? "selected" : "" ?>><?= $al["name"] ?></option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-6" style="padding-left:15px;padding-bottom:15px;">
                                 <button type="submit" class="btn btn-info btn-fill btn-wd" id="save"><i class="ti-check"></i> <?= __("Save Setting") ?></button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>