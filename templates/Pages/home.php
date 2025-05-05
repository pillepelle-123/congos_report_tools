<!-- <div class="users view content"> -->
<h1>Hallo <?= $this->Identity->get('username') ?> </h1>
    <div class="home app-list">
            <?= $this->AppCards->renderAll($user->get('role')) ?>
    </div>  
<!-- </div> -->
    
