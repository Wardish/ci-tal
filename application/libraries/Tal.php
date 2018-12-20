<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Tal {

    private $PHPTAL = NULL;
    private $CI     = NULL;

    public function __construct($config = array())
    {
        $this->PHPTAL = new PHPTAL();
        $this->CI =& get_instance();
    }

    /*
     * Method: fetch
     *
     * @param  str tmplatename
     * @param  arr options meta-http, meta-name, js, css,etc
     *
     */
    public function fetch($tmpl, $category='default', $options = array()) {
        $this->CI->load->config('tal');

        $config   = $this->CI->config->config;
        $outputMode   = $config['output_mode'];
        $suffix   = $config['suffix'];

        $tmplPath = sprintf('%s%s/%s%s', VIEWPATH, $category, $tmpl, $suffix);
        if ( !file_exists($tmplPath) ) {
            $tmplPath = sprintf('%s%s/%s%s', VIEWPATH, 'default', $tmpl, $suffix);
        }


        // instance
        $phptal = $this->PHPTAL;
        $phptal->setOutputMode($outputMode);

        //set CI Library
        $phptal->this = $this->CI;
        //config
        $phptal->config = $config;



        $phptal->setTemplate($tmplPath);

        // execute the template
        try {
            $result = $phptal->execute();
        }
        catch (Exception $e){
            echo $e;
            exit;
        }

        return $result;
    }

    /*
     * Method: set
     *
     * @param  str property
     * @param  arr data
     *
     */
    public function set($property, $data) {
        // instance
        $phptal = $this->PHPTAL;
        $phptal->$property = $data;
    }

    /*
     * Method: view
     *
     * @param  str tmplatename
     * @param  arr options meta-http, meta-name, js, css,etc
     *
     */
    public function view($tmpl, $category='default', $options = array()) {
        $this->CI->output->set_output($this->fetch($tmpl, $category, $options));
    }
}
