<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

  /**
   * The table name
   *
   * @var       string
   * @access    protected
   */
  protected $_table = NULL;

  /**
   * The table's primary key
   *
   * @var       string
   * @access    protected
   */
  protected $_primary_key = 'intId';

  /**
   * The table's column used to flag a record as deleted, 
   * (an alternative to actually removing the record)
   *
   * @var       string
   * @access    protected
   */
  protected $_delete_flag = 'bolDeleted';

  /**
   * The model's validation rules
   *
   * @var       array
   * @access    protected
   */
  protected $_validate = array();

  /**
   * The mappings between database field names and
   * post/get input names
   *
   * @var       array
   * @access    protected
   */
  protected $_field_mapping = array();

  /**
   * The default option for skipping validation
   * checks or not
   *
   * @var       bool
   * @access    protected
   */
  protected $_skip_validation = FALSE;

  /**
   * Constructor
   *
   * Calls the parent constructor and then attempts to work out the models
   * table name based on model name if the env.php option is set to TRUE
   *
   * @access    public
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->helper('inflector');

    $this->_fetch_table();
  }

  /**
   * Get Record by Id
   *
   * Returns a single record from the table (as an object) based on the passed in id
   *
   * Example usage:
   * <code>
   * <?php
   * $first_record = $this->get(1);
   * ?>
   * </code>
   *
   * @access    public
   * @param     int       $id    primary key value to search for
   * @return    object    the found record
   */
  public function get($id)
  {
    return $this->db->where($this->_primary_key, $id)
                    ->get($this->_table)
                    ->row();
  }

  /**
   * Get Records by Where
   *
   * Returns an array of records (as objects) based on the passed in where clause
   *
   * Example usage:
   * <code>
   * <?php
   * $open_records   = $this->get_by('status', 'open');
   * $closed_deleted_records = $this->get_by(array('status' => 'closed', 'deleted' => 1))
   * ?>
   * </code>
   *
   * @access    public
   * @param     array|string    $where    an array of key-value where conditions or where column
   * @param     string          $value    the where condition value (optional)
   * @return    array           the found records based on where clause
   */
  public function get_by(/* no params defined */)
  {
    /**
     * An array comprising of the functions argument list
     *
     * @var       array
     * @access    private
     * @link      http://php.net/manual/en/function.func-get-args.php
     */
    $where = func_get_args();

    // set the query where clause using internal function
    $this->_set_where($where);

    return $this->db->get($this->_table)
                    ->result();
  }

  /**
   * Get all records
   *
   * Returns all records and columns in the table
   *
   * @access    public
   * @return    array     the found records
   */
  public function get_all()
  {
    return $this->db->get($this->_table)
                    ->result();
  }

  /**
   * Insert new record
   * 
   * Inserts a new record into the database based on the passed in data,
   * optionaly before inserting it can run the data through the validation rules.
   * When successfully inserted the new records id is returned.
   *
   * @access    public
   * @param     array     $data               an key-value array with the column/value data
   * @param     bool      $skip_validation    optionaly set whether to skip the validation step
   * @return    int       the newly inserted records id
   */
  public function insert($data = array(), $skip_validation = FALSE)
  {
    if (is_array($this->_field_mapping)) {
      // if the field map is an array loop through its contents
      foreach ($this->_field_mapping as $k => $v) {
        // if a mapping column does not exist in the passed in data array
        // attempt to retrieve it from either get/post input sources
        if (!isset($data[$k]))
          $data[$k] = $this->input->get_post($v);
      }
    }

    $valid = TRUE;

    if ($skip_validation === FALSE)
      $valid = $this->_run_validation($data);

    if ($valid) {
      $this->db->insert($this->_table, $data);

      return $this->db->insert_id();
    }

    return FALSE;
  }

  /**
   * Insert multiple new records
   *
   * Inserts multiple new records based on the passed in data array,
   * looping through each new record it calls the models insert() function
   * with the new data. Optionally before inserting it can run the data through
   * the validation rules. When successfully inserted the new records id's are returned
   * in an array.
   * 
   * @access    public
   * @param     array     $data               an array with key-value array with new column/value data
   * @param     bool      $skip_validation    optionaly set whether to skip the validation step
   * @return    array     an int array with the newly inserted ids
   */
  public function insert_many($data, $skip_validation = FALSE)
  {
    $ids = array();

    foreach ($data as $row)
      $ids[] = $this->insert($row, $skip_validation);

    return $ids;
  }

  /**
   * Update record
   *
   * Updates a defined record based on the passed in primary key value,
   * new record values are passed in as a key-value array (column/value).
   * Optionally the validation check can be skipped.
   *
   * @access    public
   * @param     int       $id                 the records primary key value
   * @param     array     $data               key-value array of the columns, new values
   * @param     bool      $skip_validation    optionaly set whether to skip the validation step
   * @return    bool      the status of the attempted update
   */
  public function update($id, $data, $skip_validation = FALSE)
  {
    if (is_array($this->_field_mapping)) {
      // if the field map is an array loop through its contents
      foreach ($this->_field_mapping as $k => $v) {
        // if a mapping column does not exist in the passed in data array
        // attempt to retrieve it from either get/post input sources
        if (!isset($data[$k]))
          $data[$k] = $this->input->get_post($v);
      }
    }

    $valid = TRUE;

    if ($skip_validation === FALSE)
      $valid = $this->_run_validation($data);

    if ($valid) {
      return $this->db->where($this->_primary_key, $id)
                      ->set($data)
                      ->update($this->_table);
    }

    return FALSE;
  }

  /**
   * Update many records
   *
   * Updates many records based on the passed in id array and the key-value
   * data array. Optionally the validation check can be skipped.
   *
   * @access    public
   * @param     array     $ids                the records primary key values
   * @param     array     $data               key-value array of the columns, new values
   * @param     bool      $skip_validation    optionaly set whether to skip the validation step
   * @return    bool      the status of the attempted updates
   */
  public function update_many($ids, $data, $skip_validation = FALSE)
  {
    $valid = TRUE;

    if ($skip_validation === FALSE)
      $valid = $this->_run_validation($data);

    if ($valid) {
      return $this->db->where_in($this->_primary_key, $ids)
                      ->set($data)
                      ->update($this->_table);
    }

    return FALSE;
  }

  /**
   * Update Records by Where
   *
   * Updates a set of records based on a passed in where clause 
   *
   * Example usage:
   * <code>
   * <?php
   * // update all record status which are open to closed
   * $this->update_by('status', 'open', array('status', 'closed'));
   * // update all record names which are closed and not deleted
   * $this->update_by(
   *   array('status' => 'closed', 'deleted' => 0),
   *   array('name' => 'test'),
   * );
   * ?>
   * </code>
   *
   * @access    public
   * @param     array|string    $where    an array of key-value where conditions or where column
   * @param     string          $value    the where condition value (optional)
   * @param     array           $data     key-value array of the columns, new values
   * @return    bool            the status of the attempted updates
   */
  public function update_by(/* no params defined */)
  {
    /**
     * An array comprising of the functions argument list
     *
     * @var       array
     * @access    private
     * @link      http://php.net/manual/en/function.func-get-args.php
     */
    $args = func_get_args();

    /**
     * An array with all column-value updates to the record set.
     * Data var is created using the array_pop() function which 
     * pops and returns the last value of the function argument list
     *
     * @var       array
     * @access    private
     * @link      http://php.net/manual/en/function.array-pop.php
     */
    $data = array_pop($args);

    $this->_set_where($args);

    if ($this->_run_validation($data)) {
      return $this->db->set($data)
                      ->update($this->_table);
    }

    return FALSE;
  }

  /**
   * Update all records in table
   *
   * Updates all records in the table based on the passed in column-value array
   *
   * @access    public
   * @param     array     $data    key-value array of the columns, new values
   * @return    bool      the status of the attempted updates
   */
  public function update_all($data)
  {
    return $this->db->set($data)
                    ->update($this->_table);
  }

  /**
   * Delete a Record by Id
   *
   * Deletes a record based on the passed in primary key value
   *
   * @access    public
   * @param     int       $id    the primary key value to delete
   * @return    bool      the status of the attempted delete
   */
  public function delete($id)
  {
    return $this->db->where($this->_primary_key, $id)
                    ->delete($this->_table);
  }

  /**
   * Flag a Record as Deleted by Id
   *
   * Flags a record as deleted (alternative option to actually removing it)
   * based on the passed in primary key value
   *
   * @access    public
   * @param     int       $id    the primary key value to delete
   * @return    bool      the status of the attempted delete
   */
  public function delete_flag($id)
  {
    return $this->db->where($this->_primary_key, $id)
                    ->set($this->_delete_flag, 1)
                    ->update($this->_table);
  }

  /**
   * Delete Records By Where
   *
   * Deletes records in a the table that match the given where clause
   *
   * Example usage:
   * <code>
   * <?php
   * // delete all records with a status of open
   * $this->delete_by('status', 'open');
   * // delete all record with a status of closed and not deleted
   * $this->delete_by(array('status' => 'open', 'deleted' => 0));
   * ?>
   * </code>
   *
   * @access    public
   * @param     array|string    $where    an array of key-value where conditions or where column
   * @param     string          $value    the where condition value (optional)
   * @return    bool            the status of the attempted delete
   */
  public function delete_by()
  {
    /**
     * An array comprising of the functions argument list
     *
     * @var       array
     * @access    private
     * @link      http://php.net/manual/en/function.func-get-args.php
     */
    $where = func_get_args();
    
    $this->_set_where($where);

    return $this->db->delete($this->_table);
  }

  /**
   * Delete many records
   *
   * Deletes many records based on the passed in id array
   *
   * @access    public
   * @param     array     $ids                the records primary key values
   * @return    bool      the status of the attempted delete
   */
  public function delete_many($ids)
  {
    return $this->db->where_in($this->_primary_key, $ids)
                    ->delete($this->_table);
  }

  /**
   * Count by Where
   *
   * Returns the count of the records that meet a passed in where clause
   *
   * @access    public
   * @param     array|string    $where    an array of key-value where conditions or where column
   * @param     string          $value    the where condition value (optional)
   * @return    int             the record count
   */
  public function count_by()
  {
    /**
     * An array comprising of the functions argument list
     *
     * @var       array
     * @access    private
     * @link      http://php.net/manual/en/function.func-get-args.php
     */
    $where = func_get_args();
    
    $this->_set_where($where);

    return $this->db->count_all_results($this->_table);
  }

  /**
   * Count all Records
   * 
   * Returns the total count for all records in the table
   *
   * @access    public
   * @return    int       the record count
   */
  public function count_all()
  {
    return $this->db->count_all($this->_table);
  }

  /**
   * Skip Insert/Update Validation
   * 
   * Sets the insert/update functions to skip validation
   *
   * @access    public
   * @return    object       the current model, used for chaining methods
   */
  public function skip_validation()
  {
    $this->_skip_validation = TRUE;

    return $this;
  }

  /**
   * Order by Columns
   * 
   * A wrapper around the order by function in CI ActiveRecord, used
   * for chaining method calls
   *
   * @access    public
   * @param     array|string    $criteria    an array of column/order params or a single column name
   * @param     string          $order       optionally choose which order the passed in column should be displayed in
   * @return    object          the current model, used for chaining methods
   */
  public function order_by($criteria, $order = 'ASC')
  {
    if (is_array($criteria)) {
      foreach ($criteria as $k => $v)
        $this->db->order_by($k, $v);
    } else {
      $this->db->order_by($criteria, $order);
    }

    return $this;
  }

  /**
   * Limit records
   * 
   * A wrapper around the limit function in CI ActiveRecord, used
   * for chaining method calls
   *
   * @access    public
   * @param     int       $limit     limit record count
   * @param     int       $offset    optionally set the limits offset
   * @return    object    the current model, used for chaining methods
   */
  public function limit($limit, $offset = 0)
  {
    $this->db->limit($limit, $offset);

    return $this;
  }

  /**
   * Run validation
   * 
   * An internall function which runs the passed in data through the validation
   * rules set for the model. CI's form validation library is used to validate the data
   *
   * @access    private
   * @param     array      $data    key/value array with the column name and values inputted   
   * @return    bool       the validation status
   */
  private function _run_validation($data)
  {
    // return true if the user has decided to skip the validation process
    if ($this->_skip_validation)
      return TRUE;

    if (!empty($this->_validate)) {
      // loop through all the dataset and add them to the PHP POST array
       foreach ($data as $k => $v) {
        // check if field mapping is present for data item
        if (isset($this->_field_mapping[$k])) {
          // if so set field mapped input name to the value
          $_POST[$this->_field_mapping[$k]] = $v;
        } else {
          // else use table column name
          $_POST[$k] = $v;
        }
      }

      $this->load->library('form_validation');

      // set initial result value
      $result = FALSE;

      if (is_array($this->_validate)) {

        // if an array has been created loop through contents
        foreach ($this->_validate as &$v) {
          // if a field mapping is present for a rule set change the
          // fields name to the input get/post name
          // this is done to maintain full use of form validation functionality
          if (isset($this->_field_mapping[$v['field']])) {
            $v['field'] = $this->_field_mapping[$v['field']];
          }
        }

        // set the form validation libraries rules to this array
        // before attempting to run the validation
        $this->form_validation->set_rules($this->_validate);

        $result = $this->form_validation->run();
      } else {
        $result = $this->form_validation->run($this->_validate);
      }

      return $result;
    }

    // if the validation ruleset is empty return true
    return TRUE;
  }

  /**
   * Set where clause
   * 
   * Wraps the CI where function and sets the where clause based on the passed in arguments.
   *
   * @access    private
   * @param     array      $params    the where clause params   
   * @return    bool       the validation status
   */
  private function _set_where($params)
  {
    if (count($params) === 1) {
      $this->db->where($params[0]);
    } else {
      $this->db->where($params[0], $params[1]);
    }
  }

  /**
   * Fetch table name
   * 
   * Attempts to predict the table name based on the name of the model name,
   * the table prefix is found from in the env.php config file.
   * i.e. User_model, would assume to have a table called tblUsers
   *
   * @access    private 
   * @return    void
   */
  private function _fetch_table()
  {
    if ($this->_table === NULL)
      $this->_table = 'tbl' . plural(preg_replace('/_model$/', '', get_class($this)));
  }
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */