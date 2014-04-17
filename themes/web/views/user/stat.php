<div class="mod">   
        <?php
//very useful google chart
        $this->widget('ext.googlechart.HzlVisualizationChart', array('visualization' => 'PieChart',
            'data' => array(
                array('Task', '统计'),
                array('文章', intval($postNum)),
                array('图片', intval($attachNum)),
                array('评论', 2),
                array('用户',30)
            ),
            'options' => array('title' => '总量统计')));
 
        $this->widget('ext.googlechart.HzlVisualizationChart', array('visualization' => 'LineChart',
            'data' => array(
                array('Task', '次数'),
                array('周一', intval($weekly['1'])),
                array('周二', intval($weekly['2'])),
                array('周三', intval($weekly['3'])),
                array('周四', intval($weekly['4'])),
                array('周五', intval($weekly['5'])),
                array('周六', intval($weekly['6'])),
                array('周日', intval($weekly['7']))
            ),
            'options' => array('title' => '近一周访问')));
        ?>
     <?php
        $this->widget('ext.googlechart.HzlVisualizationChart', array('visualization' => 'LineChart',
                    'data' => array(
                        array('Year', '访问'),//
                        array('一月', intval($yearly[1])),
                        array('二月', intval($yearly[2])),
                        array('三月', intval($yearly[3])),
                        array('四月', intval($yearly[4])),
                        array('五月', intval($yearly[5])),
                        array('六月', intval($yearly[6])),
                        array('七月', intval($yearly[7])),
                        array('八月', intval($yearly[8])),
                        array('九月', intval($yearly[9])),
                        array('十月', intval($yearly[10])),
                        array('十一月', intval($yearly[11])),
                        array('十二月', intval($yearly[12])),
                    ),
                    'options' => array(
                        'title' => '近一年访问量',
                        'titleTextStyle' => array('color' => '#FF0000'),
                        'vAxis' => array(
                            'title' => '访问',
                            'gridlines' => array(
                                'color' => 'transparent'  //set grid line transparent
                            )),
                        'hAxis' => array('title' => '月份'),
                        'curveType' => 'function', //smooth curve or not
                        'legend' => array('position' => 'bottom'),
                )));
        ?>
</div>
