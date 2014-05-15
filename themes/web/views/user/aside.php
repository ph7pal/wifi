<div class="aside">
    <div class="mod" id="aside_face">
        <div class="bd">
            <div class="site_pic">                
                <img src="<?php echo zmf::avatar($this->uid,'big',true);?>" alt="<?php echo $this->userInfo['truename'];?>">
            </div>
            <div class="desc">
            </div>
            <div class="site-info">                
            </div>
            <?php if($this->showNavs){?>
            <div class="site_action config">
                <?php $userAside=Users::userAside($this->uid);if(!empty($userAside)){?>
                <?php foreach($userAside as $ua){?>
                <?php echo $ua['url'];?>
                <?php }?>
                <?php }?>
            </div>
            <?php }?>
        </div>
    </div>        
</div>