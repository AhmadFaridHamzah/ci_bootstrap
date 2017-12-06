<?php
$strb=['class'=>'form-horizontal'];
?>
<?=form_open('admin/user/add_user',$strb)?>
<fieldset>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="username">Name</label>  
  <div class="col-md-8">
  <input id="username" name="username" type="text" placeholder="" class="form-control input-md">
  <span class="help-block">name</span> 
  <?=form_error('username','<p class="has-error">','</p>')?> 
  </div>
</div>

<!-- Text input-->
<div class="form-group <?php if(form_error('email')){ echo 'has-error';}?>   ">
  <label class="col-md-4 control-label" for="email">Email</label>  
  <div class="col-md-8">
  <input id="email" name="email" type="text" placeholder="email" class="form-control input-md">
  <span class="help-block">email</span> 
  <?=form_error('email','<p class="help-block with-errors">','</p>')?> 
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btnadduer"></label>
  <div class="col-md-4">
    <button id="btnadduer" name="btnadduer" class="btn btn-primary">Add</button>
  </div>
</div>

</fieldset>
</form>

