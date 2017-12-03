<select id="second" data-placeholder="Choose a Country..." class="chosen-select" multiple style="width:350px;" tabindex="4">
          <option value=""></option>
          <option value="United States">United States</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="Afghanistan">Afghanistan</option>
          <option value="Albania">Albania</option>
          <option value="Algeria">Algeria</option>
          <option value="American Samoa">American Samoa</option>
          <option value="Andorra">Andorra</option>
          <option value="Angola">Angola</option>
          <option value="Anguilla">Anguilla</option>
        </select>
<br /><br />
<select id="first" data-placeholder="Choose a Country..." class="chosen-select" multiple style="width:350px;" tabindex="4">
          <option value=""></option>
          <option value="United States">United States</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="Afghanistan">Afghanistan</option>
          <option value="Albania">Albania</option>
          <option value="Algeria">Algeria</option>
          <option value="American Samoa">American Samoa</option>
          <option value="Andorra">Andorra</option>
          <option value="Angola">Angola</option>
          <option value="Anguilla">Anguilla</option>
        </select>
<br /><br />
<button class="btn">Reset</button>

<script type="text/javascript">
$(".chosen-select").chosen();
$('button').click(function(){
      $(".chosen-select").val('').trigger("chosen:updated");
});
</script>
