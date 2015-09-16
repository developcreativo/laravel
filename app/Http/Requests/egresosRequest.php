<?php namespace App\Http\Requests;

use App\Http\Requests\Request;


class egresosRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules =[
			//
            'proveedor_id' => 'required',
                'fecha' => 'required|date',
                'concepto' => 'required',
                'total' => 'required',
                'forma_pago_id' => 'required'
		];

        return $rules;
	}

}
