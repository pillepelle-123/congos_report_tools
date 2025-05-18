<!-- <div class="users view content"> -->
<h1>Hallo <?= $this->Identity->get('username') ?> </h1>
    <div class="home home-card-list">
            <?= $this->Cards->renderAllHome($this->getTemplate(), $user->get('role')) ?>
    </div>  
<!-- </div> -->
    
