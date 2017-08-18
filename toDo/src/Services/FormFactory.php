<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 08/06/2017
 * Time: 16:46
 */

namespace TODO\Services;

use TODO\Entity\Statut;
use TODO\Entity\Task;

class FormFactory
{

    public static $bootstrap = false;

    private $datas;


    //construct
    public function __construct($datas = [])
    {
        $this->datas = $datas;
        //print_r($datas);
    }


    private function bootstrap($html){

        if (static::$bootstrap){
            return '<div class="form-control">'.$html.'</div>';
        }else{
            return $html;
        }
    }

    private function getValue($name){
        //Si $this->datas est un objet c'est que la class Formfactory traite une instance et donc une modification. Si c'est un tableau ($_POST) alors on est en mode création
        if(is_object($this->datas)){
            $getter = "get";
            $getter .=ucfirst($name);
            return $this->datas->$getter();
        }
        return isset($this->datas[$name]) ? $this->datas[$name]: null;
    }

    private function isRequired($name){
        /*$require = false;
        $aste = $this->input($options);
        if($this->getValue($name) == 'email_expediteur' ){
            $this->input($options['style']) = '';*/
        //}
        //return

    }

    //Fonction des entrées input et textarea**************************
    public function input($name,$label,$options = ['type' => 'text','css' => null, 'required'=> false]){
        $type= isset($options['type']) ?$options['type']: 'text';

//__________________________________________________________________________________________
        /*public function isRequired($is_required){
                    $is_required = $is_required ? '<span style="color: red"> *</span>': false;
                    return $is_required;
            }*/


        // OU

        if($options['required']== true ){
            $req = '<span style="color: red"> *</span>';
            $label = '<label for="'.$name.'">'.$label.$req.'</label>';
        }else{

            $label = '<label for="'.$name.'">'.$label.'</label>';
        }
//________________________________________________asterisques rouges





        $input = '<input value="'.$this->getValue($name).'" class="'.$options['css'].'" type="'.$options['type'].'" id="'.$name.'" name="'.$name.'" placeholder="">';


        if($options['type'] == "textarea"){
            $input = "<textarea class='{$options['css']}' id='$name' name='$name'>{$this->getValue($name)}</textarea>";
        }

        return $this->bootstrap($label.$input);//$label.$this->>isRequired($options['required']));
        //concatenation de deux variables en return
    }

    public function select($name,$label,$propositions,$options = ['css'=>'form-control','required'=>false]){
            $label ='<label for='.$name.'>'.$label.'</label>';
            $select ='<select class='.$options['css'].' name='.$name.' id='.$name.'>';
            foreach ($propositions as $proposition){
                $selected = $this->getValue($name) == $proposition->getValue() ? "selected" : "";
                $select .="<option $selected value='{$proposition->getValue()}'>{$proposition}</option>";
           // $select .= $propositions;
            }
            $select .= '</select>';
        return $label.$select;

    }



    // Fonction pour l'input submit**********************************
    public function submit($options=['css'=>null,'value'=>'Valier']){
        $html = "<input type='submit' class='{$options['css']}' value='{$options['value']}'>";

        return $this->bootstrap($html);
    }

}