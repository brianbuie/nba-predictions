<form action="post.php" method="post">
    <h2 class="center">Submit Your Prediction</h2>
    <div class="form-group row">
        <?php foreach($teams as $division => $teams){ ?>
            <div class="form-group col-lg-6 division">
                <h5><?php echo $division; ?></h5>
                <?php $i = 1; while($i < 9){ ?>
                    <div class="form-group row">
                        <div class="form-group col-xs-8">
                            <select class="form-control" id="<?php echo $division . $i; ?>" name="<?php echo $division . $i; ?>" required>
                                <option value="" disabled selected><?php echo $i; ?></option>
                                <?php foreach ($teams as $team){
                                    echo '<option value="' . $team . '">' . $team . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group col-xs-4">
                            <input class="form-control" type="number" placeholder="wins" id="<?php echo $division . $i; ?>-wins" name="<?php echo $division . $i; ?>-wins" required>
                        </div>
                    </div>
                <?php $i++; } ?>
            </div>
        <?php } ?>
    </div>
    <div class="form-group row">
        <div class="form-group col-xs-12">
            <input type="text" class="form-control" placeholder="Your Name" name="name" required>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<div class="row">
    <div class="col-xs-12">
        <p>To change your prediction, submit a new one and use the same name. Don't be a dick and change other people's picks. If you fuck up, let me know and I can revert it back.</p>
        <p>The form will be up for a week or so, then I gotta take it down, since I completely neglected all security measures with this project.</p>
    </div>
</div>
