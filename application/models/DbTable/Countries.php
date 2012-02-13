<?php

class Application_Model_DbTable_Countries extends Zend_Db_Table_Abstract
{

    protected $_name = 'countries';

    public function getCountryList()
    {
        $data = $this->select()
             ->from('countries',
                    array('id', 't'));
        $countryData = array();
        $countries = $data->query()->fetchAll();
        foreach($countries as $country) {
            $countryData[$country['id']] = $country['t'];
        }

        return $countryData;
    }


}

