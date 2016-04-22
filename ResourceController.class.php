<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Home\Controller;

/**
 * Description of ResourceController
 *
 * @author Administrator
 */
class ResourceController extends \Think\Controller{
    public function getData(){
        $this->display();
    }
    
    public function getDBData(){
        $deviceModel = M('Device');
//        $returnCode = $deviceModel->field('device_position')->where('device_id=1')->select();
//        $returnCode = $deviceModel->distinct(true)->field('device_status')->select();
        $returnCode = $deviceModel->field('device_status,count(*)')->group('device_status')->select();

//        fout($returnCode);
        $rowcount = count($returnCode);
        $result= array();
        for ($i=0;$i<$rowcount;++$i){
            $result[]=array($returnCode[$i]['device_status'] => $returnCode[$i]['count(*)']);
        }
        
//        fout($result);
//        echo json_encode($result);
        $this->ajaxReturn($result,"JSON");
    }
}
