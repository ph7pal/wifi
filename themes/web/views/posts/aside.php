<div class="sidebar">
    <div class="mbox sideNav">        
        <?php 
        if($type=='album'){
            echo '<h2>相册</h2>';
            $asides=Album::allAlbums(false);
            if(!empty($asides)){?>
               <ul>
                    <?php foreach($asides as $_sk=>$_sc){
                        if($_sc['id']==$colid){
                            $class='current';
                        }else{
                            $class='';
                        }
                        ?>
                    <li><?php echo CHtml::link($_sc['title'],array('posts/images','id'=>$_sc['id']),array('class'=>$class));?></li>
                    <?php }?>
                </ul> 
        <?php }}else{
        echo '<h2>导航</h2>';
        if($this->_noColButOther=='login' || $this->_noColButOther=='reg'){?>
        <ul>
            <li><?php echo CHtml::link('立即登录',array('site/login'),array('class'=>($this->_noColButOther=='login')?'current':''));?></li>
            <li><?php echo CHtml::link('快速注册',array('site/reg'),array('class'=>($this->_noColButOther=='reg')?'current':''));?></li>
        </ul>  
        <?php }else{            
            if($colid!=''){
                $asideCols=Columns::getAllByOne($colid);
            }else{                
                $_asideCols=Columns::allCols(1,0,0);
                $asideCols=CHtml::listData($_asideCols,'id','title');
            } 
            
        if(!empty($asideCols)){
        ?>
        <ul>
            <?php foreach($asideCols as $_ak=>$_ac){
                if($_ak==$colid){
                    $class='current';
                }else{
                    $class='';
                }
                ?>
            <li><?php echo CHtml::link($_ac,array('posts/index','colid'=>$_ak),array('class'=>$class));?></li>
            <?php }?>
        </ul>
        <?php }}}?>
    </div>	
</div>