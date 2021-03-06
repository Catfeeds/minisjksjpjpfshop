<?php
namespace Api\Controller;
use Think\Controller;
class SearchController extends PublicController {
	//***************************
	//  获取会员 搜索记录接口
	//***************************
    public function index(){
    	$uid = intval($_REQUEST['uid']);
    	//获取热门搜索内容
        $remen = M('search_record')->group('keyword')->field('keyword')->order('addtime desc')->limit(10)->select();
        //获取历史搜索记录
        $history = array();
        if ($uid) {
            $history = M('search_record')->where('uid='.intval($uid))->order('addtime desc')->field('keyword')->limit(20)->select();
        }
        //获取热门商品
        $hot = M('product')->where('del=0 AND is_down=0 AND type=1')->order('renqi desc')->limit(8)->select();
        foreach($hot as $k => $v){
            $hot[$k]['photo_x'] =  __DATAURL__.$v['photo_x'];
            // $tag_id = M('attr_spec_price_store')->where('pid="'.$v['id'].'"')->getField('tag_id');
            // $hot[$k]['tag'] = M('tag')->where('id="'.$tag_id.'"')->getField('name');
            // $hot[$k]['price'] = M('attr_spec_price_store')->where('pid="'.$v['id'].'"')->getField('price_yh');
            // $pro[$k]['ping'] = M('product_dp')->where('pid="'.$v['id'].'"')->count();
        }
        echo json_encode(array('remen'=>$remen,'history'=>$history,'hot'=>$hot));
        exit();
    }

    //***************************
    //  产品商家搜索接口
    //***************************
    public function searches(){
        $uid = intval($_REQUEST['uid']);

        $keyword = trim($_REQUEST['keyword']);
        if (!$keyword) {
            echo json_encode(array('status'=>0,'err'=>'请输入搜索内容.'));
            exit();
        }

        if ($uid) {
            $check = M('search_record')->where('uid='.intval($uid).' AND keyword="'.$keyword.'"')->find();
            if ($check) {
               $num = intval($check['num'])+1;
               M('search_record')->where('id='.intval($check['id']))->save(array('num'=>$num));
            }else{
               $add = array();
               $add['uid'] = $uid;
               $add['keyword'] = $keyword;
               $add['addtime'] = time();
               M('search_record')->add($add);
            }
        }

        $page=intval($_REQUEST['page']);
        if (!$page) {
            $page=0;
        }

        $prolist = M('product')->where('del=0 AND pro_type=1 AND is_down=0 AND name like "%'.$keyword.'%"')->order('addtime desc')->limit($page.',10')->select();
        foreach($pro as $k => $v){
            $pro[$k]['photo_x'] =  __DATAURL__.$v['photo_x'];
            // $tag_id = M('attr_spec_price_store')->where('pid="'.$v['id'].'"')->getField('tag_id');
            // $pro[$k]['tag'] = M('tag')->where('id="'.$tag_id.'"')->getField('name');
            // $pro[$k]['price'] = M('attr_spec_price_store')->where('pid="'.$v['id'].'"')->getField('price_yh');
            // $pro[$k]['ping'] = M('product_dp')->where('pid="'.$v['id'].'"')->count();
        }

        // $page2=intval($_REQUEST['page2']);
        // if (!$page2) {
        //     $page2=0;
        // }

        // $condition = array();
        // $condition['status']=1;
        // //根据店铺名称查询
        // $condition['name']=array('LIKE','%'.$keyword.'%');
        // //获取所有的商家数据
        // $store_list = M('shangchang')->where($condition)->order('sort desc,type desc')->field('id,name,uname,logo,tel,sheng,city,quyu')->limit($page2.',6')->select();
        // foreach ($store_list as $k => $v) {
        //     $store_list[$k]['sheng'] = M('china_city')->where('id='.intval($v['sheng']))->getField('name');
        //     $store_list[$k]['city'] = M('china_city')->where('id='.intval($v['city']))->getField('name');
        //     $store_list[$k]['quyu'] = M('china_city')->where('id='.intval($v['quyu']))->getField('name');
        //     $store_list[$k]['logo'] = __DATAURL__.$v['logo'];
        //     $pro_list = M('product')->where('del=0 AND is_down=0 AND shop_id='.intval($v['id']))->field('id,photo_x,price_yh')->limit(4)->select();
        //     foreach ($pro_list as $key => $val) {
        //         $pro_list[$key]['photo_x'] = __DATAURL__.$val['photo_x'];
        //     }
        //     $store_list[$k]['pro_list'] = $pro_list;
        // }

        echo json_encode(array('status'=>1,'pro'=>$prolist,'shop'=>$store_list));
        exit();
    }

    public function getProduct(){
        $catid = intval($_REQUEST['cate_id']);
        if($_REQUEST['key']){
            $key = $_REQUEST['key'];
        }else{
            $key = '';
        }
        
        // if ($catid == '' && $key == '') {
        //     echo json_encode(array('status'=>0,'err'=>'没有找到产品数据.'));
        //     exit();
        // }
        if($catid){
            $pro = M('product')->where('del=0 AND is_down=0 AND pro_type=1 AND cid="'.$catid.'"')->select();
        }else if($key){
            $pro = M('product')->where('del=0 AND pro_type=1 AND is_down=0 AND name like "%'.$key.'%"')->order('addtime desc')->select();
        }
       if(!empty($_REQUEST['num'])){
            switch($_REQUEST['num']){
                case '0.1':
                    if($_REQUEST['key']){
                        $pro = M('product')->where('del=0 AND pro_type=1 AND is_down=0 AND name like "%'.$_REQUEST['key'].'%"')->order('addtime desc')->select();
                    }else if(!empty($_REQUEST['catid'])){
                        $catid = $_REQUEST['catid'];
                        $pro = M('product')->where('del=0 AND is_down=0 AND pro_type=1 AND cid="'.$_REQUEST['catid'].'"')->order('addtime desc')->select();
                    }
                    break;
                case '1':
                   if($_REQUEST['key']){
                        $pro = M('product')->where('del=0 AND pro_type=1 AND is_down=0 AND name like "%'.$_REQUEST['key'].'%"')->order('renqi desc')->select();
                    }else if($_REQUEST['catid']){
                        $catid = $_REQUEST['catid'];
                        $pro = M('product')->where('del=0 AND is_down=0 AND pro_type=1 AND cid="'.$_REQUEST['catid'].'"')->order('renqi desc')->select();
                    }
                    break;
                case '2':
                    if($_REQUEST['key']){
                        $pro = M('product')->where('del=0 AND pro_type=1 AND is_down=0 AND name like "%'.$_REQUEST['key'].'%"')->order('addtime desc')->select();
                        // foreach($pro as $k => $v){
                        //     $pro[$k]['price'] = M('attr_spec_price_store')->where('pid="'.$v['id'].'"')->getField('price_yh');
                        // }
                        $sort = array(  
                            'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序  
                            'field'     => 'price',       //排序字段  
                        );  
                        $arrSort = array();  
                        foreach($pro AS $uniqid => $row){  
                            foreach($row AS $key=>$value){  
                                $arrSort[$key][$uniqid] = $value;  
                            }  
                        }  
                        if($sort['direction']){  
                            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $pro);  
                        }  
                    }else if($_REQUEST['catid']){
                        $catid = $_REQUEST['catid'];
                        $pro = M('product')->where('del=0 AND is_down=0 AND pro_type=1 AND cid="'.$_REQUEST['catid'].'"')->select();
                        // foreach($pro as $k => $v){
                        //     $pro[$k]['price'] = M('attr_spec_price_store')->where('pid="'.$v['id'].'"')->getField('price_yh');
                        // }
                        $sort = array(  
                            'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序  
                            'field'     => 'price',       //排序字段  
                        );  
                        $arrSort = array();  
                        foreach($pro AS $uniqid => $row){  
                            foreach($row AS $key=>$value){  
                                $arrSort[$key][$uniqid] = $value;  
                            }  
                        }  
                        if($sort['direction']){  
                            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $pro);  
                        }  
                    }
                    break;
                case '3':
                   if($_REQUEST['key']){
                        $pro = M('product')->where('del=0 AND pro_type=1 AND is_down=0 AND name like "%'.$_REQUEST['key'].'%"')->order('addtime desc')->select();
                        // foreach($pro as $k => $v){
                        //     $pro[$k]['price'] = M('attr_spec_price_store')->where('pid="'.$v['id'].'"')->getField('price_yh');
                        // }
                        $sort = array(  
                            'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序  
                            'field'     => 'price',       //排序字段  
                        );  
                        $arrSort = array();  
                        foreach($pro AS $uniqid => $row){  
                            foreach($row AS $key=>$value){  
                                $arrSort[$key][$uniqid] = $value;  
                            }  
                        }  
                        if($sort['direction']){  
                            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $pro);  
                        }  
                    }else if($_REQUEST['catid']){
                        $catid = $_REQUEST['catid'];
                        $pro = M('product')->where('del=0 AND is_down=0 AND pro_type=1 AND cid="'.$_REQUEST['catid'].'"')->select();
                        // foreach($pro as $k => $v){
                        //     $pro[$k]['price'] = M('attr_spec_price_store')->where('pid="'.$v['id'].'"')->getField('price_yh');
                        // }
                        $sort = array(  
                            'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序  
                            'field'     => 'price',       //排序字段  
                        );  
                        $arrSort = array();  
                        foreach($pro AS $uniqid => $row){  
                            foreach($row AS $key=>$value){  
                                $arrSort[$key][$uniqid] = $value;  
                            }  
                        }  
                        if($sort['direction']){  
                            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $pro);  
                        }  
                    }
                    break;
            }
       }

        foreach($pro as $k => $v){
            $pro[$k]['photo_x'] =  __DATAURL__.$v['photo_x'];
            // $tag_id = M('attr_spec_price_store')->where('pid="'.$v['id'].'"')->getField('tag_id');
            // $pro[$k]['tag'] = M('tag')->where('id="'.$tag_id.'"')->getField('name');
            // $pro[$k]['price'] = M('attr_spec_price_store')->where('pid="'.$v['id'].'"')->getField('price_yh');
            // $pro[$k]['ping'] = M('product_dp')->where('pid="'.$v['id'].'"')->count();
        }

        //json加密输出
        //dump($json);
        $category = M('category')->where('bz_2=1 AND tid!=0')->order('bz_2 desc,sort desc')->field('id,name,bz_1')->select();
        if (empty($pro)) {
            echo json_encode(array('status'=>0,'err'=>'没有找到产品数据.','category'=>$category,'pro'=>$pro));
            exit();
        }
        $key = $_REQUEST['key'];

        echo json_encode(array('status'=>1,'pro'=>$pro,'catid'=>$catid,'key'=>$key,'category'=>$category));
        exit();
    }

}
