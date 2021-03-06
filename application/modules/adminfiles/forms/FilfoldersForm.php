<?php
/**
 * File generated by the Sydney_Admin_Generator
 */

/**
 * Form to manage the data from the filfolders table
 * @package Admindb
 * @subpackage FormmodelGenerated
 */
class FilfoldersForm extends Sydney_Form
{
    public function __construct($options = null)
    {
        parent :: __construct($options);
        $this->setAttrib('accept-charset', 'UTF-8');
        $this->setName('filfolders');

        $id = new Zend_Form_Element_Hidden('id');

        $hash = new Zend_Form_Element_Hash('no_csrf_foo', array('salt' => '4s564evzaSD64sf'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $label = new Zend_Form_Element_Text('label');
        $label->setLabel('label');

        $desc = new Zend_Form_Element_Textarea('desc');
        $desc->setLabel('desc');

        $parentId = new Zend_Form_Element_Select('parent_id');
        $options = new Filfolders();
        $parentId->addMultiOption('', '----------');
        foreach ($options->fetchAlltoFlatArray() as $k => $v) {
            $parentId->addMultiOption($k, $v['mlabel']);
        }

        $parentId->setLabel('parent_id');

        $safinstancesId = new Zend_Form_Element_Select('safinstances_id');
        $options = new Safinstances();
        $safinstancesId->addMultiOption('', '----------');
        foreach ($options->fetchAlltoFlatArray() as $k => $v) {
            $safinstancesId->addMultiOption($k, $v['mlabel']);
        }

        $safinstancesId->setLabel('safinstances_id');

        $isNode = new Zend_Form_Element_Text('isnode');
        $isNode->setLabel('isnode');

        $isParam = new Zend_Form_Element_Text('isparam');
        $isParam->setLabel('isparam');

        $relevance = new Zend_Form_Element_Text('relevance');
        $relevance->setLabel('relevance');

        $pagOrder = new Zend_Form_Element_Text('pagorder');
        $pagOrder->setLabel('pagorder');

        $linkedTo = new Zend_Form_Element_Textarea('linkedto');
        $linkedTo->setLabel('linkedto');

        $isSystemFolder = new Zend_Form_Element_Text('isSystemFolder');
        $isSystemFolder->setLabel('isSystemFolder');

        $fileFoldersFileFiles = new FilfileslistForm('FilfoldersFilfiles');
        $fileFoldersFileFiles->setLabel('FilfoldersFilfiles');
        $fileFoldersUsers = new UserslistForm('FilfoldersUsers');
        $fileFoldersUsers->setLabel('FilfoldersUsers');

        $this->addElements(array(
            $id,
            $hash,
            $label,
            $desc,
            $parentId,
            $safinstancesId,
            $isNode,
            $isParam,
            $relevance,
            $pagOrder,
            $linkedTo,
            $isSystemFolder,
            $fileFoldersFileFiles,
            $fileFoldersUsers,
        ));
        $this->addElements(array($submit));
    }

}
