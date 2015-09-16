<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class productosRequest extends Request {

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
	 * @return array
	 */
	public function rules()
	{
		return [
			//
            'SKU'=>'required|unique:productos',
            'producto'=>'required|unique:productos',
            'categoria_id'=>'required',
            'marca_id'=>'required',
            'venta'=>'required',
            'impuestos'=>'required',
		];
	}

}
