<?php
namespace Models;

use App\Database;
use Lib\Slug;

class ValidationModel {
    protected $db;
    protected $slug;

    public function __construct() {
        $this->db = new Database();
        $this->slug = new Slug();
    }

    public function prepareOrder() {
        
    }
}