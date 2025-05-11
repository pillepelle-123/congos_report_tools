<!-- <div class="users view content"> -->
<h1>Hallo <?= $this->Identity->get('username') ?> </h1>
    <div class="home app-list">
            <?= $this->HomeCards->renderAll($this->getTemplate(), $user->get('role')) ?>
    </div>  
<!-- </div> -->
    
