<?php
class Manage extends CFormModel{
    public $ids;
    public $type;
    public $table;    
    public function attributeLabels(){
        return array(
            'ids'=>'ids',
            'type'=>'type',
            'table'=>'table'            
        );
    }
}

