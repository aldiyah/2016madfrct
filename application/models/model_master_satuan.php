<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_satuan.php";

class Model_master_satuan extends Master_satuan {

    protected $rules = array(        
        array("kode_satuan", "required|min_length[1]"),
        array("nama_satuan", "required|min_length[3]|max_length[300]|alpha_dash"),
    );

    public function __construct() {
        parent::__construct();
    }
    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "nama_satuan",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

}

?>