<?php

namespace App\Http\Resources;

use DB;
use App\Models\Customer\Customer;


use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = Customer::where('userid', $this->id)->first();
        $fullname = '';
        $mobile_no = '';
        $dob = '';
        $bill_str_address = '';
        $bill_province_id = '';
        $bill_district_id = '';
        $bill_mun_vdc_id = '';
        $bill_postal_zip_code = '';
        $shipping_address = '';
        $ship_str_address = '';
        $ship_province_id = '';
        $ship_district_id = '';
        $ship_mun_vdc_id = '';
        $ship_postal_zip_code = '';
        $primary_email = '';
        $secondary_email = '';
        $attachment = '';

        if (!empty($result)) {
            $result = $result->toArray();
            $mobile_no = !empty($result['mobile_no']) ? $result['mobile_no'] : '';
            $fullname = !empty($result['fullname']) ? $result['fullname'] : '';
            $dob = !empty($result['dob']) ? $result['dob'] : '';
            $attachment = !empty($result['attachment']) ? $result['attachment'] : '';
            $bill_str_address = !empty($result['bill_str_address']) ? $result['bill_str_address'] : '';
            $bill_province_id = !empty($result['bill_province_id']) ? $result['bill_province_id'] : '';
            $bill_district_id = !empty($result['bill_district_id']) ? $result['bill_district_id'] : '';
            $bill_mun_vdc_id = !empty($result['bill_mun_vdc_id']) ? $result['bill_mun_vdc_id'] : '';
            $bill_postal_zip_code = !empty($result['bill_postal_zip_code']) ? $result['bill_postal_zip_code'] : '';
            $shipping_address = !empty($result['shipping_address']) ? $result['shipping_address'] : '';
            $ship_str_address = !empty($result['ship_str_address']) ? $result['ship_str_address'] : '';
            $ship_province_id = !empty($result['ship_province_id']) ? $result['ship_province_id'] : '';
            $ship_district_id = !empty($result['ship_district_id']) ? $result['ship_district_id'] : '';
            $ship_mun_vdc_id = !empty($result['ship_mun_vdc_id']) ? $result['ship_mun_vdc_id'] : '';
            $ship_postal_zip_code = !empty($result['ship_postal_zip_code']) ? $result['ship_postal_zip_code'] : '';
            $primary_email = !empty($result['primary_email']) ? $result['primary_email'] : '';
            $secondary_email = !empty($result['secondary_email']) ? $result['secondary_email'] : '';
        }

        $retArray = [
            'id' => $this->id,
            'email' => $this->email,
            'username' => $this->username,
            'fullname' => $fullname,
            'contact' => $this->contact,
            'email_verified_at' => $this->email_verified_at,
            'is_verified' => $this->is_verified,
            'mobile_no' => $mobile_no,
            'dob' => $dob,
            'primary_email' => $primary_email,
            'secondary_email' => $secondary_email,
            'bill_str_address' => $bill_str_address,
            'bill_province_id' => $bill_province_id,
            'bill_district_id' => $bill_district_id,
            'bill_mun_vdc_id' => $bill_mun_vdc_id,
            'bill_postal_zip_code' => $bill_postal_zip_code,
            'shipping_address' => $shipping_address,
            'ship_str_address' => $ship_str_address,
            'ship_province_id' => $ship_province_id,
            'ship_district_id' => $ship_district_id,
            'ship_mun_vdc_id' => $ship_mun_vdc_id,
            'ship_postal_zip_code' => $ship_postal_zip_code,
            'attachment' => $attachment
        ];

        return $retArray;
    }
}
