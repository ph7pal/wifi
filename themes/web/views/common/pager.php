<div class="manu">
 <?php 
 //分页widget代码: 
 $this->widget('CLinkPager',
         array(
            'header'=>'',
             'firstPageLabel' => '首页',
             'lastPageLabel' => '末页',    
             'prevPageLabel' => '上一页',    
             'nextPageLabel' => '下一页',    
             'pages' => $pages,    
             'maxButtonCount'=>13         
         )
         
         );
 ?>
</div>  