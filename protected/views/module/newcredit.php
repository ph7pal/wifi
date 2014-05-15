<style>
/* 本例子css */
.logobanner{ width:100%; height:220px; overflow:hidden; position:relative; border:1px solid #ddd;  }
.logobanner .hd{ height:15px; overflow:hidden; position:absolute; right:5px; bottom:5px; z-index:1; }
.logobanner .hd ul{ overflow:hidden; zoom:1; float:left;  }
.logobanner .hd ul li{ float:left; margin-right:2px;  width:15px; height:15px; line-height:14px; text-align:center; background:#fff; cursor:pointer; }
.logobanner .hd ul li.on{ background:#f00; color:#fff; }
.logobanner .bd{ position:relative; height:100%; z-index:0;   }
.logobanner .bd li{ zoom:1; vertical-align:middle; }
.logobanner .bd img{ display:block;  }

/* 下面是前/后按钮代码，如果不需要删除即可 */
.logobanner .prev,
.logobanner .next{ position:absolute; left:3%; top:50%; margin-top:-25px; display:block; width:32px; height:40px; background:url(../images/slider-arrow.png) -110px 5px no-repeat; filter:alpha(opacity=50);opacity:0.5;   }
.logobanner .next{ left:auto; right:3%; background-position:8px 5px; }
.logobanner .prev:hover,
.logobanner .next:hover{ filter:alpha(opacity=100);opacity:1;  }
.logobanner .prevStop{ display:none;  }
.logobanner .nextStop{ display:none;  }
</style>

<?php 
$users = UserCredit::getNews(); ?>
<?php if (!empty($users)) {?>
<div class="col-xs-<?php echo $colnum;?> col-md-<?php echo $colnum;?> moduleBox">    
    <div class="panel panel-<?php echo $this->theme_panelStyle;?>">
        <div class="panel-heading">            
            <h3 class="panel-title">
                最新认证              
            </h3>
        </div>
        <div class="panel-body">
          <div class="logobanner">
                <div class="bd">
                <ul>
                    <?php foreach ($users as $key=>$ci) { ?> 

                        <li>
                            <a href="<?php echo Yii::app()->createUrl('mobile/index',array('uid'=>$ci['uid']));?>">
                            <img src="<?php echo zmf::avatar($ci['uid'],'big',true);?>" class="img-responsive"/>
                            </a>
                        </li>

                    <?php }?>
                </ul>
                </div>
            </div>
        </div>
    </div>    
</div>









<?php
    echo '<script>jQuery(".logobanner").slide({mainCell:".bd ul",effect:"left",autoPlay:true});</script>';

?>
<?php }?>