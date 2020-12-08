<?php
namespace Ia\Sdata;

/**
 *
 * @author Aaron Lozier <aaron@informationarchitech.com>
 */

class Conn
{

    protected $_options = array(
        'hostname'    => false,
        'website'     => 'sdata',
        'username'    => '',
        'password'    => '',
        'application' => 'MasApp',
        'contract'    => 'MasContract',
        'company'     => false,
    );

    protected $basic;

    protected $_requiredOptions = array(
        'hostname', 'website', 'application', 'contract', 'company', 'username', 'password',
    );

    public function __construct($options)
    {
        $this->_options = array_merge($this->_options, $options);
        $this->_validateOptions();
        $this->basic = $this->_options['username'] . ":" . $this->_options['password'];
        return $this;
    }

    public function getUrlPrefix($includeHostname = true)
    {
        $this->_validateOptions();
        $url = (($includeHostname) ? $this->_options['hostname'] : '') . '/' .
        $this->_options['website'] . '/' .
        $this->_options['application'] . '/' .
        $this->_options['contract'] . '/' .
        $this->_options['company'] . '/';
        return $url;
    }

    public function getOption($key)
    {
        return (isset($this->_options[$key])) ? $this->_options[$key] : false;
    }
    public function getBasic()
    {
        return $this->basic;
    }

    protected function _validateOptions()
    {

        foreach ($this->_requiredOptions as $key) {
            if (!isset($this->_options[$key]) || !$this->_options[$key]) {
                throw new \Exception('`' . $key . '` is a required configuration option.');
            }
        }
    }

}
