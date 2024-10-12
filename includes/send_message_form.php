                      <h3 style="text-align:center;">Send Message</h3>
                              <form role="form" method="post" enctype="multipart/form-data" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                                  <div class="">
                                                        <label for="subject">Subject: <span class="error"><?php if(isset($_POST['client_submit_msg'])){echo $msg_subjectErr;} ?></span></label>
                                                        <input type="text" class="form-control" name="msg_subject" id="" required="required" maxlength="250" value="<?php if(isset($_POST['client_submit_msg'])){ echo htmlentities($msg_subject); }?>">
                                                  </div><br>
                                                  <div class="">
                                                        <label for="address">Message: <span class="error"><?php if(isset($_POST['client_submit_msg'])){echo $msg_bodyErr;} ?></span></label>
                                                        <textarea class="form-control" name="msg_body" rows = "5" id="message" required="required" >
                                                          <?php if(isset($_POST['client_submit_msg'])){ echo htmlentities($msg_body); }?>
                                                        </textarea>
                                                  </div>
                                                  <div class="spacebar"></div>
                                                  <div class="">
                                                       <label for="">Attach File (jpeg or pdf only): <span class="error"><?php if(isset($_POST['client_submit_msg'])){ echo $attachmentErr;} ?></span> </label>
                                                        <input type="file" name="attachment"> 
                                                  </div>
                                                  <div class="">
                                                        <input type="hidden" name="client_code" value="<?php echo $ecode; ?>">
                                                        <input type="hidden" name="client_email" value="<?php echo $client_email; ?>">
                                                  </div>
                                                  <div class="">
                                                        <div class="spacebar"></div>
                                                        <input type="submit" name="client_submit_msg" class="form-control btn btn-success" value="Send" id="button1" >
                                                  </div>  
                            </form>   