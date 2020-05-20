<?php

/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 11/10/2017
 * Time: 10:55
 */
class vc_module
{
    public $category = "viruscomm components";
    public $prefix_shortCode = "vsc_";
    public $list_of_modules=[];
    function __construct()
    {
        add_action('vc_before_init',array(&$this,"on_loaded"));
    }
    function on_loaded(){

        foreach ($this->list_of_modules as $module)
        {
            $newSlugName=$this->init_shortCode($module["slugName"],$module["fn"]);
            $this->vc_map_call($newSlugName,$module["name"],$module["params"],$module["extend"]);
        }
    }
    function vc_map_call($slugName, $name, $params, $extend = [])
    {
        $setting = array(
            "name" => __($name, "my-text-domain"),
            "base" => $slugName,
            "class" => "",
            "category" => __($this->category, "my-text-domain"),
            "params" =>$params
        );
        $setting = array_merge($setting, $extend);
        vc_map($setting);
    }

    function all_in_one($slugName,$fn,$name,$params,$extend=[])
    {
        $this->list_of_modules[]=[
          "slugName"=>$slugName,
            "fn"=>$fn,
            "name"=>$name,
            "params"=>$params,
            "extend"=>$extend
        ];
    }

    function init_shortCode($slugName, $fn)
    {

        add_shortcode($this->prefix_shortCode . $slugName, $fn);
        return $this->prefix_shortCode . $slugName;
    }
    function getDirContents($dir,&$results=[]){
        $files = scandir($dir);
        foreach($files as $key => $value){
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
            if(!is_dir($path)) {
                $results[] = $path;
            } else if($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
            }
        }

        return $results;
    }
}
$vc_module=new vc_module();
foreach ($vc_module->getDirContents(ABSPATH.'wp-content/themes/vsc-theme/vc_extend/') as $filename)
{
    include_once $filename;
}