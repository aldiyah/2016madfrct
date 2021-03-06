<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_102E1.php";

class model_tr_102E1 extends tr_102E1 {

    public function __construct() {
        parent::__construct();
    }

    protected $rules = array(
        array("id_f102E1", ""),
        array("id_triwulan", ""),
        array("id_kotama", ""),
        array("path_excel", ""),
        array("tanggal_upload", ""),
        array("tanggal_ttd", ""),
        array("uraian_atas_ttd", ""),
        array("jabatan_ttd", ""),
        array("nama_ttd", ""),
        array("pangkat_ttd", ""),
        array("nrp_ttd", ""),
        array("id_kabupaten_kota", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "tanggal_upload",
                    "tanggal_ttd",
                    "nama_ttd",
                    "pangkat_ttd",
                    "nrp_ttd",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

}
