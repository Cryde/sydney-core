<?php
/**
 * File generated by the Sydney_Admin_Generator
 */

/**
 * Form to manage the data from the languages table
 * @package Admindb
 * @subpackage FormmodelGenerated
 */
class LanguagesForm extends Sydney_Form
{
    public function __construct($options = null)
    {
        parent :: __construct($options);
        $this->setAttrib('accept-charset', 'UTF-8');
        $this->setName('languages');

        $id = new Zend_Form_Element_Hidden('id');

        $hash = new Zend_Form_Element_Hash('no_csrf_foo', array('salt' => '4s564evzaSD64sf'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $label = new Zend_Form_Element_Text('label');
        $label->setLabel('label');

        $isocode = new Zend_Form_Element_Text('isocode');
        $isocode->setLabel('isocode');

        $active = new Zend_Form_Element_Checkbox('active');
        $active->setLabel('active');

        $this->addElements(array($id, $hash, $label, $isocode, $active));
        $this->addElements(array($submit));
    }

}
