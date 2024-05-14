<?php 
include("inc/top.php");
?>
<div>
    <form class="form-horizontal" method="POST" action="contact.php">
        <fieldset>
            <div class="control-group">
                <input type="text" name="name" placeholder="Nom" class="input-xlarge"/>
            </div>
            <div class="control-group">
                <input type="text" name="email" placeholder="Email" class="input-xlarge"/>
            </div>
            <div class="control-group">
                <textarea rows="3" name="message" class="input-xlarge"></textarea>
            </div>
            <button class="shopBtn" type="submit">Envoyer</button>
        </fieldset>
    </form>
</div>
<?php
include("inc/bottom.php");
?>
