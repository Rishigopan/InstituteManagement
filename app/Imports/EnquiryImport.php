<?php
namespace App\Imports;

use App\Models\Enquiry;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class EnquiryImport implements ToModel,WithHeadingRow
{
        protected $branch_id;
        protected $enq_source;
        protected $leaddata;
        protected $duplicates = [];
    
        public function __construct($branch_id,$enquirytype_id,$leaddata)
        {
            $this->branch_id = $branch_id;
            $this->enq_source = $enquirytype_id;
            $this->leaddata = $leaddata;
        }
    
        public function model(array $row)
    {
        
        return new Enquiry([
            'name'    =>  $row['name'],
            'mob_no'    => $row['mob_no'],
            'course'    => $row['Course'],
            'updated_at'=>  $row['updated_at'],
            'created_at'=>   $row['created_at']  
          ]);
    }
    
        public function duplicates()
        {
            return $this->duplicates;
        }
    }