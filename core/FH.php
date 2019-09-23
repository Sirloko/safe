<?php
    namespace Core;
    use Core\Session;

class FH {
    public static function inputBlock($type, $label, $name, $value='', $inputAttrs=[], $divAttrs=[]){
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);
        $html = '<div' . $divString . '>';
        $html .= '<label for="'.$name.'">'.$label.'</label>';
        $html .= '<input type="'.$type.'" id= "'.$name.'" name="'.$name.'" placeholder="Please Provide Input" value="'.$value.'"'.$inputString.' />';
        $html .= '</div>';
    
        return $html;
    }
    public static function messageBlock($type, $name,  $inputAttrs=[], $divAttrs=[]){
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);
        $html = '<div' . $divString . '>';
        $html .= '<input type="'.$type.'" id= "'.$name.'" name="'.$name.'" placeholder="enter message" '.$inputString.' />';
        $html .= '</div>';
    
        return $html;
    }
    public static function inputHiddenBlock($type, $name, $value){
        // $divString = self::stringifyAttrs($divAttrs);
        // $inputString = self::stringifyAttrs($inputAttrs);
        //$html = '<div' . $divString . '>';
        $html = '<input type="'.$type.'" id= "'.$name.'" name="'.$name.'" value="'.$value.'" />';
        //$html .= '</div>';
    
        return $html;
    }
    public static function uploadBlock($type, $label, $name=[], $multiple, $inputAttrs=[], $divAttrs=[]){
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);
        //$inputString = self::stringifyAttrs($name);
        $html = '<div' . $divString . '>';
       $html .= '<label for="'.$name.'">'.$label.'</label>';
        $html .= '<input type="'.$type.'" id= "'.$name.'" '.$multiple.' name="'.$name.'" '.$inputString.' />';
        $html .= '</div>';
    
        return $html;
    }
    public static function textareaBlock($label, $name, $value='', $inputAttrs=[], $divAttrs=[]){
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);
        $html = '<div' . $divString . '>';
        $html .= '<label for="'.$name.'">'.$label.'</label>';
        $html .= '<textarea rows="4" cols="50" id= "'.$name.'"  name="'.$name.'" value="'.$value.'"'.$inputString.'>';
        $html .= "$value";
        $html .= '</textarea>';
        $html .= '</div>';
    
        return $html;
    }

    public static function selectBlock($label,$category, $name, $value='', $inputAttrs=[], $divAttrs=[]){
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);
        $html = '<div' . $divString . '>';
        $html .= '<label for="'.$name.'">'.$label.'</label>';
        $html .= '<select name="'.$name.'" '.$inputString.'>';
        if($value){
            $html .= '<option value="'.$value.'">'.$value.'';
        }
        $menu = H::fetchContent($category);
            foreach($menu as $key => $val){
                $html .= '<option value="'.$key.'">'.$val.'';
            }
        $html .= '</select>';
        $html .= '</div>';
    
        return $html;
    }
    public static function aclBlock($label,$category, $name, $value, $inputAttrs=[], $divAttrs=[]){
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);
        $html = '<div' . $divString . '>';
        $html .= '<label for="'.$name.'">'.$label.'</label>';
        $html .= '<select name="'.$name.'"'.$inputString.'>';
        if($value){
            $html .= '<option value="'.$value.'">'.$value.'';
            
        }else{
            $html .= '<option value=" "> ';
        }
        $menu = H::fetchContent($category);
      
            foreach($menu as $key => $val){ 
                if(isset($key)){
                     $html .= '<option value="'.$key.'">'.$val.'';
                }else{
                    $html .= '<option value=" "> ';
                }
               
            }
        $html .= '</select>';
        $html .= '</div>';
           
        return $html;
    }
    public static function HODBlock($label,$options, $name, $inputAttrs=[], $divAttrs=[]){
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);
        $html = '<div' . $divString . '>';
        $html .= '<label for="'.$name.'">'.$label.'</label>';
        $html .= '<select name="'.$name.'" '.$inputString.'>';
        foreach($options as $option){
            $html .= '<option value="'.$option['id'].'">'.$option['username'].'';
        }
            
        $html .= '</select>';
        $html .= '</div>';
    
        return $html;
    }
    
    public static function submitTag($buttonText, $inputAttrs=[]){
        $inputString = self::stringifyAttrs($inputAttrs);
        $html = '<input type="submit" value="'.$buttonText.'" '.$inputString.'/>';
        return $html;
    }
    
    public static function submitBlock($buttonText, $inputAttrs=[], $divAttrs=[]){
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);
        $html = '<div '.$divString.'>';
        $html .= '<input type="submit" value="'.$buttonText.'" '.$inputString.'/>';
        $html .= '</div>';
        return $html;
    }
    
    public static function checkboxBlock($label,$name,$checked=false,$inputAttrs=[],$divAttrs=[]){
        $divString = self::stringifyAttrs($divAttrs);
        $inputString = self::stringifyAttrs($inputAttrs);
        $checkString = ($checked)? 'checked ="checked"' : '';
        $html = '<div'.$divString.'>';
        $html .= '<label for="'.$name.'">'.$label.'<input type="checkbox" id="'.$name.'" name="'.$name.'" value ="on"'.$checkString.$inputString.'></label>';
        $html .= '</div>';
        return $html;
    }
    
    public static function stringifyAttrs($attrs){
        $string = '';
        foreach($attrs as $key => $val){
            $string .= ' ' . $key . '="' . $val . '"';
        }
        return $string;
    }

    public static function generateToken(){
        $token = base64_encode(openssl_random_pseudo_bytes(32));
        Session::set('csrf_token',$token);
        return $token;
    }

    public static function checkToken($token){
        return (Session::exists('csrf_token') && Session::get('csrf_token') == $token);
    }

    public static function csrfInput(){
        return '<input type="hidden" name="csrf_token" id="csrf_token" value="'.self::generateToken().'">';
    }
    public static function sanitize($dirty) {
        return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
    }
    
    public static function posted_values($post){
        $clean_ary = [];
        foreach ($post as $key => $value) {
            $clean_ary[$key] = self::sanitize($value);
        }
        return $clean_ary;
    }

    public static function displayErrors($errors){
        $hasErrors = (!empty($errors))? ' has-errors' : '';
        $html = '<div class="form-errors"><ul class="bg-danger '.$hasErrors.'">';
        foreach($errors as $field => $error) {
            $html .= '<li class="text-danger">'.$error.'</li>';
            $html .= '<script>jQuery("document").ready(function(){jQuery("#'.$field.'").parent().closest("div").addClass("has-error");});</script>';    
        }
        $html .= '</ul></div>';
        return $html;
    }
}