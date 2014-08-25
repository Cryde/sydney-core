<?php

/**
 *
 * @package SydneyLibrary
 * @subpackage Form
 */
class Sydney_Form extends Zend_Form
{
    protected $safinstancesid = null;
    protected $config;
    protected $registry;
    /*
     * Zend_Db_Table_Row object
     */
    private static $params = array();



    /** @var array Decorators to use for standard form elements */
    // these will be applied to our text, password, select, checkbox and radio elements by default
    protected  $elementDefaultDecorators = array(
        'ViewHelper',
        'Errors',
        array('Description', array('tag' => 'p', 'class' => 'description')),
        array(array("innerwrapper" => "HtmlTag"), array("tag" => "div", "class" => "col-sm-10")),
        array('Label',       array('class' => 'col-sm-2 control-label', 'requiredSuffix' => '*')),
        array(array("outerwrapper" => "HtmlTag"), array("tag" => "div", "class" => "form-group")),

    );

    /** @var array Decorators for File input elements */
    // these will be used for file elements
    protected $fileDecorators = array(
        'File',
        'Errors',
        array('Description', array('tag' => 'p', 'class' => 'description')),
        array('HtmlTag',     array('class' => 'form-div')),
        array('Label',       array('class' => 'form-label', 'requiredSuffix' => '*'))
    );

    /** @var array Decorator to use for standard for elements except do not wrap in HtmlTag */
    // this array gets set up in the constructor
    // this can be used if you do not want an element wrapped in a div tag at all
    protected $elementDecoratorsNoTag = array();

    /** @var array Decorators for button and submit elements */
    // decorators that will be used for submit and button elements
    protected $buttonDecorators = array(
        'ViewHelper',
        array('HtmlTag', array('tag' => 'div', 'class' => 'form-button'))
    );



    /**
     *  setRow
     * @param Zend_Db_Table_Row $rowObject
     */
    public static function setParams($params, $key = '')
    {
        if (!empty($key)) {
            self::$params[$key] = $params;
        } elseif (is_array($params)) {
            self::$params = $params;
        }
    }

    public static function getParams($key = '')
    {
        if (empty($key)) {
            return self::$params;
        } else {
            return self::$params[$key];
        }
    }


    /**
     * Constructor overriding the parent constructor
     * @param null $options
     */
    public function __construct($options = null)
    {
        $this->registry = Zend_Registry :: getInstance();
        $this->config = $this->registry->get('config');

        $this->safinstancesid = $this->config->db->safinstances_id;

        $this->addElementPrefixPath('Sydney', 'Sydney/');
        $this->addPrefixPath('Sydney_Decorator', 'Sydney/Decorator/', 'decorator');
        $this->addElementPrefixPath('Sydney_Decorator', 'Sydney/Decorator/', 'decorator');


        $this->setAttrib('accept-charset', 'UTF-8');



        // first set up the $elementDecoratorsNoTag decorator, this is a copy of our regular element decorators, but do not get wrapped in a div tag
        foreach($this->elementDefaultDecorators as $decorator) {
            if (is_array($decorator) && $decorator[0] == 'HtmlTag') {
                continue; // skip copying this value to the decorator
            }
            $this->elementDecoratorsNoTag[] = $decorator;
        }

        // set the decorator for the form itself, this wraps the <form> elements in a div tag instead of a dl tag
        $this->setDecorators(array(
            array('FormElements', array('tag' => 'div', 'class' => 'form-group')),
            array('HtmlTag', array('tag' => 'div')),
            'Form'));
        $this->addAttribs(array('class' => 'form-horizontal'));

        // set the default decorators to our element decorators, any elements added to the form
        // will use these decorators
        $this->setElementDefaultDecorators($this->elementDefaultDecorators);

        parent::__construct($options);
        // parent::__construct must be called last because it calls $form->init()
        // and anything after it is not executed

    }

    public function addDecoratorToElements(){

        foreach($this->getElements() as $element){
            if($element instanceof Zend_Form_Element_Text
                || $element instanceof Zend_Form_Element_Password
                || $element instanceof Zend_Form_Element_Select
                || $element instanceof Zend_Form_Element_Checkbox){
                $element->setDecorators($this->elementDefaultDecorators);
                $element->setAttrib('class', 'form-control');
            }
            if($element instanceof Zend_Form_Element_Button
                || $element instanceof Zend_Form_Element_Submit){
                $element->setDecorators($this->buttonDecorators);
                $element->setAttrib('class', 'form-control btn btn-primary');
            }
        }
    }


    /**
     * Setup the translation, this is not used for the moment
     *
     * @return void
     * @todo See if we need to implement that to make translation work automatically
     */
    protected function _setupTranslation()
    {
        $registry = Zend_Registry :: getInstance();
        $translate = $registry->get('Zend_Translate');
        $this->setTranslator($translate);
    }
}
