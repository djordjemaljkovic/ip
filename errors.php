<?php
    if(isset($_POST['insertpomocna'])){
        if (count($errors) > 0 ): ?>
        <div class="greske">
            <?php foreach ($errors as $error): ?>
            <p><?php echo "<span style='color:red'>$error</span>"; ?></p>
            <?php endforeach ?>
        </div>
        <?php endif;  
    }
    
    if(isset($_POST['loguj'])){
        if (count($errors) > 0 ): ?>
        <div class="greske">
            <?php foreach ($errors as $error): ?>
            <p><?php echo "<span style='color:red'>$error</span>"; ?></p>
            <?php endforeach ?>
        </div>
        <?php endif;  
    }
    
    if(isset($_POST['logujadmina'])){
        if (count($errors) > 0 ): ?>
        <div class="greske">
            <?php foreach ($errors as $error): ?>
            <p><?php echo "<span style='color:red'>$error</span>"; ?></p>
            <?php endforeach ?>
        </div>
        <?php endif;  
    }
    
    if(isset($_POST['insertknjiga'])){
        if (count($errors) > 0 ): ?>
        <div class="greske">
            <?php foreach ($errors as $error): ?>
            <p><?php echo "<span style='color:red'>$error</span>"; ?></p>
            <?php endforeach ?>
        </div>
        <?php endif;  
    }
    
?>