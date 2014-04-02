 <div class="mod-title">
 	 <p><?php echo $info['title'];?></p>
 </div>
<div class="listBox clear">
    <ul>
        <?php foreach($posts as $row):?> 
            <li>
                <p><?php echo CHtml::link('['.Columns::getOne($row['colid'],'title').']'.$row['title'],array('posts/show','id'=>$row['id']));?></p>
                
            </li>
        <?php endforeach;?>
    </ul>                    
</div>
<div class="pagebar clear"><?php  $this->renderPartial('/common/pager',array('pages'=>$pages)); ?></div>