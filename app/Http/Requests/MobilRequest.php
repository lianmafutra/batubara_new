<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MobilRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
      return true;
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, mixed>
    */
   public function rules()
   {
      if (in_array($this->method(), ['PUT', 'PATCH'])) {
         return [
            'plat' => 'required|min:5',
            'jenis'   => 'required',
            'pemilik_mobil_id' => 'required',
         ];
      }

      if (in_array($this->method(), ['POST'])) {
         return [
            'plat' => 'required|min:5|unique:mobil',
            'jenis'   => 'required',
            'pemilik_mobil_id' => 'required',
         ];
      }
   }
}
