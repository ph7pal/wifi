
<div class="topDesc">
		  <div class="desc">
		    <p style=" margin-top:40px;">致力于提升客户品牌形象、实现客户商业目标!</p>
		    <p>Commitment to enhance customer brand image,customer business goals!</p>
		  </div>
</div>
<div class="wrap clear">
	<?php $this->renderPartial('aside',array('colid'=>$info['id']));?>
	<div class="mainBox">	
            <?php $this->renderPartial('bread',array('info'=>$info));?>
		<div class="listBox clear">
                    <ul class="title">
                        <?php foreach($posts as $row):?> 
                            <li class="clear">	
                                <h2>			
                                <p class="y"><span class="date"><?php echo date('Y-m-d H:i',$row['cTime']);?></span></p>
                                <?php echo CHtml::link($row['title'],array('posts/show','id'=>$row['id']),array('class'=>'title','target'=>'_blank'));?>
                                </h2>						
                            </li>
                        <?php endforeach;?>
                    </ul>
                    
		</div>
            <div class="pagebar clear"><?php  $this->renderPartial('/common/pager',array('pages'=>$pages)); ?></div>
	</div>
	
</div>