<?php

class Sydney_Form_Login extends Sydney_Form{


    public function __construct($options){


        parent::__construct($options);
        $this->removeAttrib('class');
    }

    protected  $elementPlaceholderDecorators = array(
        'ViewHelper',
        'Errors',
        array('Description', array('tag' => 'p', 'class' => 'description')),
        array(array("innerwrapper" => "HtmlTag"), array("tag" => "div", "class" => "form-group")),
    );
    protected  $checkboxBeforeLabelDecorator = array(
        'ViewHelper',
        'Errors',
        array('Description', array('tag' => 'p', 'class' => 'description')),
        array(array("innerwrapper" => "HtmlTag"), array("tag" => "div", "class" => "pull-left col-sm-offset-1")),
        array('label',       array('class' => '')),
        array(array("outerwrapper" => "HtmlTag"), array("tag" => "div", "class" => "checkbox")),

    );


    public function addDecoratorToElements(){
        foreach($this->getElements() as $element){
            if($element instanceof Zend_Form_Element_Text
                || $element instanceof Zend_Form_Element_Password
                || $element instanceof Zend_Form_Element_Select){
                $element->setDecorators($this->elementPlaceholderDecorators);
                $element->setAttrib('class', 'form-control');
            }
            if($element instanceof Zend_Form_Element_Checkbox){
                $element->setDecorators($this->checkboxBeforeLabelDecorator);
            }
            if($element instanceof Zend_Form_Element_Button
                || $element instanceof Zend_Form_Element_Submit){
                $element->setDecorators($this->buttonDecorators);
                $element->setAttrib('class', 'form-control btn btn-primary');
            }
        }
    }

}