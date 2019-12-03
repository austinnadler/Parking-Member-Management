<p>
                <p><b>Vehicle Information</b></p>
                <p class="w3-text-red w3-small">No special characters or leading/trailing spaces in any fields.</p>
                <span class="w3-tiny">Make, max 15 characters</span><br>
                <input  required
                        type="text" 
                        name="make"
                        id="make"
                        placeholder="Make"
                        maxlength="15"
                        value="<?php echo $make ?>">
                        <span id="makeValidIcon" class="w3-text-red"> *</span> 
            </p>
            <p>
                <span class="w3-tiny">Model, max 20 characters</span><br>
                <input  required
                        type="text" 
                        name="model"
                        id="model"
                        placeholder="Model"
                        maxlength="20"
                        value="<?php echo $model ?>">
                        <span id="modelValidIcon" class="w3-text-red"> *</span> 
            </p>
            <p>
                <span class="w3-tiny">License Plate, max 10 characters</span><br>
                <input  required
                        type="text" 
                        name="licensePlate"
                        id="licensePlate"
                        placeholder="License Plate"
                        maxlength="10"
                        value="<?php echo $license ?>">
                        <span id="licensePlateValidIcon" class="w3-text-red"> *</span>  
            </p>
            <p>
                <button class="w3-btn w3-round-large w3-blue" name="submit">Submit</button>
            </p>
        </form>
    </div>
        <p class="w3-text-red w3-center">
            <?php if(!empty($error))        { echo $error; }
                  if(!empty($makeError))    { echo '<br>' . $makeError;}
                  if(!empty($modelError))   { echo '<br>' . $modelError; } 
                  if(!empty($licenseError)) { echo '<br>' . $licenseError; }  
            ?>
        </p>
</div>
<script src="js/editVehicle-createNewVehicle.js"></script>
<?php require 'includes/inc.footer.php'?>