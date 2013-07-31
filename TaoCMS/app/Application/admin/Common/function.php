<?php
function substr_pic($str){
    return substr($str, 0,strpos($str,".0")).".0.80x80.jpg";
}
function nodeTozh($node){
    $node=ucwords(strtolower($node));
    $result=M("Node")->where("name='{$node}' and level<3")->find();
    return $result["title"];
}
function node_merge($node,$pid=0){
    $arr=array();
    foreach ($node as $v){
        if ($v["pid"]==$pid){
            $v["children"]=node_merge($node,$v["id"]);
            $arr[]=array_filter($v);
        }
    }
    return $arr;
}
/**
+----------------------------------------------------------
 * 功能：计算文件大小
+----------------------------------------------------------
 * @param int $bytes
+----------------------------------------------------------
 * @return string 转换后的字符串
+----------------------------------------------------------
 */
function byteFormat($bytes) {
    $sizetext = array(" B", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), 2) . $sizetext[$i];
}
function urlchange($str){
    return basename($str);
}
function chuli($arr){
    $where=array();
    foreach ($arr["rules"] as $value) {
        switch ($value["op"]) {
            case "like":
                $where[$value["field"]]=array(act($value['op']),"%".$value["value"]."%");
                break;
            case "startwith":
                $where[$value["field"]]=array(act($value['op']),$value["value"]."%");
                break;
            case "endwith":
                $where[$value["field"]]=array(act($value['op']),"%".$value["value"]);
                break;
            default:
                $where[$value["field"]]=array(act($value['op']),$value["value"]);
                break;
        }
        // $where[$value["field"]]=array(act($value['op']),$value["value"]);
        $where["_logic"]=$arr["op"];

    }
    return $where;
}
function act($op)
{
    switch (strtolower($op))
    {

        case "equal":
            return "eq";
        case "greater":
            return "gt";
        case "greaterorequal":
            return "egt";
        case "less":
            return "lt";
        case "lessorequal":
            return "elt";
        case "like":
            return "like";
        case "startwith":
            return "like";
        case "endwith":
            return "like";
        case "notequal":
            return "neq";
        case "and":
            return "and";
        case "or":
            return "or";
        case "in":
            return "in";
        case "notin":
            return "not in";
        default:
            return "eq";
    }
}
function noserialize($data_value)
{
    $vars = preg_split('/([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\|/', $data_value, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE
    );
    for ($i = 0; isset($vars[$i]); $i++)
    {
        $result[$vars[$i++]] = unserialize($vars[$i]);
    }
    return $result;
}
	
	
	
	
	
	
	
	
	
	
	 

