<script>
    $(document).ready(function(){
	$(window).scroll(function(){
		if($(window).scrollTop()>100){
			$(".back-to-top").fadeIn()
		}
		else{
			$(".back-to-top").fadeOut()
		}
	});
	$(".back-to-top").click(function(){
		$("body,html").animate({
			scrollTop:0
		}
		,200);
		return false
	});

	$("#search-btn").click(function(){
		var kw=$('#keyword').val();
                if(typeof kw=='undefined'){
                    return false;
                }else if(kw==''){
                    alert('请输入搜索关键词');
                }else{
                    var url='<?php echo zmf::config('domain').Yii::app()->createUrl('posts/search');?>'; 
                    var sep;
                    if(url.indexOf('?')>0){sep='&';}else{sep='?';} 
                    location.href =url+sep+'keyword='+kw;
                }
	});

 }); 
</script>    
