<?php
/**
 * File generated by the Sydney_Admin_Generator
 */

/**
 * Form to manage the data from the usersgroups table
 * @package Admindb
 * @subpackage FormmodelGenerated
 */
class UsersgroupsForm extends Sydney_Form
{
    public function __construct($options = null)
    {
        parent :: __construct($options);
        $this->setAttrib('accept-charset', 'UTF-8');
        $this->setName('usersgroups');

        $id = new Zend_Form_Element_Hidden('id');

        $hash = new Zend_Form_Element_Hash('no_csrf_foo', array('salt' => '4s564evzaSD64sf'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('name');

        $desc = new Zend_Form_Element_Text('desc');
        $desc->setLabel('desc');

        $parentId = new Zend_Form_Element_Select('parent_id');
        $options = new Usersgroups();
        $parentId->addMultiOption('', '----------');
        foreach ($options->fetchAlltoFlatArray() as $k => $v) {
            $parentId->addMultiOption($k, $v['mlabel']);
        }

        $parentId->setLabel('parent_id');

        $this->addElements(array($id, $hash, $name, $desc, $parentId));
        $this->addElements(array($submit));
    }

}