<?php

class My_Application_Resource_Jquery
    extends ZendX_Application_Resource_Jquery
{
    protected function _parseOptions(array $options)
    {
        $options = array_merge(array('cdn_ssl' => false), $options);

        foreach ($options as $key => $value) {
            switch($key) {
                case 'noconflictmode':
                    if (!(bool)$value) {
                        ZendX_JQuery_View_Helper_JQuery::disableNoConflictMode();
                    } else {
                        ZendX_JQuery_View_Helper_JQuery::enableNoConflictMode();
                    }
                    break;
                case 'version':
                    $this->_view->JQuery()->setVersion($value);
                    break;
                case 'localpath':
                    $this->_view->JQuery()->setLocalPath($value);
                    break;
                case 'uiversion':
                case 'ui_version':
                    $this->_view->JQuery()->setUiVersion($value);
                    break;
                case 'uilocalpath':
                case 'ui_localpath':
                    $this->_view->JQuery()->setUiLocalPath($value);
                    break;
                case 'cdn_ssl':
                    $this->_view->JQuery()->setCdnSsl($value);
                    break;
                case 'render_mode':
                case 'rendermode':
                    $this->_view->JQuery()->setRenderMode($value);
                    break;
                case 'javascriptfile':
                    $this->_view->JQuery()->addJavascriptFile($value);
                    break;
                case 'javascriptfiles':
                    foreach($options['javascriptfiles'] as $file) {
                        $this->_view->JQuery()->addJavascriptFile($file);
                    }
                    break;
                case 'stylesheet':
                    $this->_view->JQuery()->addStylesheet($value);
                    break;
                case 'stylesheets':
                    foreach ($value as $stylesheet) {
                        $this->_view->JQuery()->addStylesheet($stylesheet);
                    }
                    break;
                case 'use_min':
                    $this->_view->JQuery()->setUseMin($value);
                    break;
            }
        }

        if ((isset($options['uienable']) && (bool) $options['uienable'])
            || (isset($options['ui_enable']) && (bool) $options['ui_enable'])
            || (!isset($options['ui_enable']) && !isset($options['uienable'])))
        {
            $this->_view->JQuery()->uiEnable();
        } else {
            $this->_view->JQuery()->uiDisable();
        }
    }
}
