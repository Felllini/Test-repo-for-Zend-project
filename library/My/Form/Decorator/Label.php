<?php

require_once 'Zend/Form/Decorator/Label.php';

class My_Form_Decorator_Label extends Zend_Form_Decorator_Label
{
    public function render($content)
    {
        $element = $this->getElement();
        $view    = $element->getView();
        if (null === $view) {
            return $content;
        }

        $label     = $this->getLabel();
        $separator = $this->getSeparator();
        $placement = $this->getPlacement();
        $tag       = $this->getTag();
        $id        = $this->getId();
        $class     = $this->getClass();
        $options   = $this->getOptions();
        /*$divClass  = $this->getDivClass();
        $className = $this->getClassName();*/
        


        if (empty($label) && empty($tag)) {
            return $content;
        }
        
        $tagOptions=array();
        if (isset($options['tagOptions']))
        {
        	$tagOptions=$options['tagOptions'];
        	unset($options['tagOptions']);
        }
        
        if (!empty($label)) {
            $options['class'] = $class;
            $label = $view->formLabel($element->getFullyQualifiedName(), trim($label), $options);
        } else {
            $label = '&#160;';
        }
        
        if (null !== $tag) {
            require_once 'Zend/Form/Decorator/HtmlTag.php';
            $decorator = new Zend_Form_Decorator_HtmlTag();
            $decorator->setOptions(array_merge
            (
            	$tagOptions,
            	array
            	(
            		'tag' => $tag,
                'id'  => $this->getElement()->getName() . '-label'
            	)
            ));

            $label = $decorator->render($label);
        }

        switch ($placement) {
            case self::APPEND:
                return $content . $separator . $label;
            case self::PREPEND:
                return $label . $separator . $content;
        }
    }
    
}
