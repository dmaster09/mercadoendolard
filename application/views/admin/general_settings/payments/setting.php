<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

        <div class="card card-default color-palette-bo">

            <div class="card-header">

              <div class="d-inline-block">

                  <h3 class="card-title"> <i class="fa fa-plus"></i>

                  Payment Settings </h3>

              </div>

            </div>

            <div class="card-body">   

                <!-- For Messages -->

                <?php $this->load->view('admin/includes/_messages.php') ?>



                <?php echo form_open_multipart(base_url('admin/general_settings/payments')); ?>	

                <!-- Nav tabs -->

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#paypal" role="tab" aria-controls="main" aria-selected="true">Paypal Settings</a>
                  </li>
                  <li class="nav-item">

                    <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#stripe" role="tab" aria-controls="main" aria-selected="true">Stripe Settings</a>

                  </li>

                </ul>

                 <!-- Tab panes -->

                <div class="tab-content">
                    
                    
                    <!-- Paypal -->
                    <div role="tabpanel" class="tab-pane active" id="paypal">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label">Paypal Sandbox</label>
                                    <?= form_dropdown('paypal_sandbox',array('1' => 'Enable', '0' => 'Disable'),$paypal['paypal_sandbox'],'class="form-control"') ?>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label">Paypal Sandbox URL</label>
                                    <input type="text" class="form-control" name="paypal_sandbox_url" placeholder="Paypal Sandbox URL" value="<?php echo html_escape($paypal['paypal_sandbox_url']); ?>">
                                </div>
                            </div>
                        
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label">Paypal Live URL</label>
                                    <input type="text" class="form-control" name="paypal_live_url" placeholder="Paypal Live URL" value="<?php echo html_escape($paypal['paypal_live_url']); ?>">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label">Paypal Email</label>
                                    <input type="text" class="form-control" name="paypal_email" placeholder="Enter Paypal Email" value="<?php echo html_escape($paypal['paypal_email']); ?>">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label">Client ID</label>
                                    <input type="text" class="form-control" name="client_id" placeholder="Enter Client ID" value="<?php echo html_escape($paypal['paypal_client_id']); ?>">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <?= form_dropdown('paypal_status',array('1' => 'Enable', '0' => 'Disable'),$paypal['paypal_status'],'class="form-control"') ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stripe -->

                    <div role="tabpanel" class="tab-pane" id="stripe">

                        <div class="row">

                            <div class="col-6">

                                <div class="form-group">

                                    <label class="control-label">Publishable Key</label>

                                    <input type="text" class="form-control" name="publishable_key" placeholder="Enter Publish Key" value="<?php echo html_escape($stripe['publishable_key']); ?>">

                                </div>

                            </div>



                            <div class="col-6">

                                <div class="form-group">

                                    <label class="control-label">Secret Key</label>

                                    <input type="text" class="form-control" name="secret_key" placeholder="Enter Secret Key" value="<?php echo html_escape($stripe['secrate_key']); ?>">

                                </div>

                            </div>



                            <div class="col-6">

                                <div class="form-group">

                                    <label class="control-label">Status</label>

                                    <?= form_dropdown('stripe_status',array('1' => 'Enable', '0' => 'Disable'),$stripe['stripe_status'],'class="form-control"') ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="box-footer">

                    <input type="submit" name="submit" value="Save Changes" class="btn btn-primary pull-right">

                </div>	

                <?php echo form_close(); ?>

            </div>

        </div>

    </section>

</div>



<script>



$("#setting").addClass('active');

$('#myTabs a').on('click',function (e) {

 e.preventDefault()

 $(this).tab('show');

});



</script>