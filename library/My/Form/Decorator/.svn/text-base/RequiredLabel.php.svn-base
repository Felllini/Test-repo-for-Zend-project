<?php

require_once 'Zend/Form/Decorator/Label.php';

class My_Form_Decorator_RequiredLabel extends Zend_Form_Decorator_Label
{
	public function render($content)
	{
		$element=$this->getElement();
		$view=$element->getView();
		if (null===$view)
		{
			return $content;
		}
		
		$label=$this->getLabel();
		$separator=$this->getSeparator();
		$placement=$this->getPlacement();
		$tag=$this->getTag();
		$id=$this->getId();
		$class=$this->getClass();
		$options=$this->getOptions();
		
        $requredSymbol = '*';
        $requredSymbolPlacement = '';
        
        if(isset($options['requredSymbol'])){
            $requredSymbol = $options['requredSymbol'];   
        }
        //$requredSymbol = $options['requredSymbol'] ? $options['requredSymbol'] : '*';
        if(isset($options['requredSymbolPlacement'])){
		$requredSymbolPlacement = $options['requredSymbolPlacement'];
        }
		
		if (empty($label)&&empty($tag))
		{
			return $content;
		}
		
		if ($element->isRequired())
		{
			if ($requredSymbolPlacement==self::APPEND)
			{
				$label=$requredSymbol.$label;
			}
			else
			{
				$label.=$requredSymbol;
			}
		}
		
		if (!empty($label))
		{
			$options ['class']=$class;
			$label=$view->formLabel($element->getFullyQualifiedName(),trim($label),$options);
		}
		else
		{
			$label='&#160;';
		}
		
		if (null!==$tag)
		{
			require_once 'Zend/Form/Decorator/HtmlTag.php';
			$decorator=new Zend_Form_Decorator_HtmlTag();
			$decorator->setOptions(array
			(
				'tag' => $tag, 
				'id' => $this->getElement()->getName().'-label',
                'class' => $this->getClassName())
			);
			
			$label=$decorator->render($label);
		}
		
		switch ($placement)
		{
			case self::APPEND:
				return $content.$separator.$label;
			case self::PREPEND:
				return $label.$separator.$content;
		}
	}
    
    public function getClassName(){
        $name   = '';
        $element = $this->getElement();

        $className = $this->getOption('className');
        if (!empty($className)) {
            $name = $className;
        }

        return $name;    
    }
}
