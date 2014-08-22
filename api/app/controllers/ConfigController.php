<?php

class ConfigController extends BaseController
{

    public function getIndex()
    {
        $forms=FormConfig::with(array('fields' => function ($query) {
            $query->with('property');
        }))->get()->toArray();
        $output=array();
        foreach($forms as $form){
            $formsOutput=array();
            foreach($form as $key=>$value){
                $fieldsOutput=array();
               if($key!="fields" && $key!="name"){
                   $formsOutput=array_merge($formsOutput,array($key=>$value));
               }else if($key=="fields"){
                   $fieldsOrder=array();
                   foreach($value as $field){

                       $fieldOutput=array();
                       foreach($field as $fieldKey=>$fieldValue){
                           if($fieldKey=="property"){
                               foreach($fieldValue as$property){
                                   $fieldOutput=array_merge($fieldOutput,array($property['key']=>$property['value']));
                               }
                           }else $fieldOutput=array_merge($fieldOutput,array($fieldKey=>$fieldValue));
                       }
                       $fieldsOutput=array_merge($fieldsOutput,array($field['name']=>$fieldOutput));
                       $fieldsOrder=array_merge($fieldsOrder,array($field['name']));
                   }
                   $formsOutput=array_merge($formsOutput,$fieldsOutput,array('order'=>$fieldsOrder));
               }

            }
            $output=array_merge($output,array($form['name']=>$formsOutput));

        }

        return $output;
    }

    public function postAddForm()
    {
        $validator = Validator::make(Input::all(), array(
            "name" => "required",
            "edit" => "numeric",
            "delete" => "numeric",
            "add" => "numeric"
        ));
        if ($validator->fails()) {
            return ProcessResponse::getError(1000,  $validator->messages());
        } else {
            FormConfig::create(Input::all());
            return ProcessResponse::$error;
        }

    }
    public function getForm(){
        if(Input::get('name')){
            return ProcessResponse::process(FormConfig::with('fields')->where('name','=',Input::get('name'))->get());
        } else {
            return ProcessResponse::getError(1001,"Specify name for the requested form");
        }

    }
    public function postAddField(){
        $validator = Validator::make(Input::all(), array(
            "name" => "required",
            "edit" => "numeric",
            "visible" => "numeric",
            "required" => "numeric"
        ));
        if ($validator->fails()) {
            return ProcessResponse::getError( 0,$validator->messages());
        } else {
            Field::create(Input::all());
            return ProcessResponse::$error;
        }
    }
    public function getField(){
        if(Input::get('name')){
            return ProcessResponse::process(Field::where('name','=',Input::get('name'))->get());
        } else {
            return ProcessResponse::getError(1001,"Specify name for the requested form");
        }
    }
    public function postAttachField(){
        $field=Field::where('name','=',Input::get('field_name'))->first();
        FormConfig::where('name','=',Input::get('form_name'))->first()->fields()->attach($field->id);
        return ProcessResponse::$error;
    }
    public function postAddProperty(){
        $field=Field::where('name','=',Input::get('field_name'))->first();
        $property=new FieldConfig;
        $property->key=Input::get('key');
        $property->value=Input::get('value');
        $field->property()->save($property);
        return ProcessResponse::$error;
    }
}