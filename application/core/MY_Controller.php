<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  /**
   * The models to be autoloaded
   *
   * @var       array
   * @access    protected 
   */
  protected $_autoload_models = array();

  /**
   * Constructor
   *
   * Calls the parent contstructor and the loads the models defined
   * in the autoload array. It finally checks and displays the profiler
   * if env.php has been configured to do so.
   * 
   * @access    public
   */
  public function __construct()
  {
    parent::__construct();

    // call the autoload model function
    $this->_load_models();
    
    // if env.php has profiler output enabled, display profiler upon each
    // each controller request
    if ($this->config->item('output_profiler'))
      $this->output->enable_profiler(TRUE);
  }

  /**
   * Disable Profiler Output
   *
   * Disables profiler output for the subsequent request output.
   * Useful when you have profiler output enabled in a development
   * envoiroument and have say a restful action that you do not want profiler
   * output displayed at anytime
   *
   * @access    public
   * @return    void
   */
  public function disable_profiler()
  {
    $this->output->enable_profiler(FALSE);
  }

  /**
   * Autoload models
   *
   * Loads models that have been defined in the _autoload_models array.
   * Any model name provided is located by following the *MODEL*_model file pattern,
   * and then imported with the name entered in the array.
   *
   * @access    private
   * @return    void
   */
  private function _load_models()
  {
    foreach($this->_autoload_models as $model)
      $this->load->model($model . '_model', $model);
  }

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */