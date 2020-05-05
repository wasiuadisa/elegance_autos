<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EleganceFormEditRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //This form data go in the post's main table
            'VehicleType'   => 'required|integer',
            'Brand'         => 'required|integer',
            'Model'         => 'required|string',
            'Title'         => 'required|string|between:10,150',
            'Description'   => 'required|string|between:0,1500',
            'Transmission'  => 'required|string|in:Automatic,Manual,Hybrid',
            'ManufactureDate'=> 'required|numeric|max:' . date('Y'),
            'MaintenanceHistory' => 'required|in:Yes,No',
            'UsedOrNew'     => 'required|in:Used,New',
            'Price'         => '|numeric|digits_between:1,20',
            'Condition'     => 'required|in:Drive-off,Tow-away',
            'Mileage'       => 'numeric|integer|digits_between:0,15',
            'Customizations'=> 'required|in:Yes,No',
            'Modifications' => 'string|between:0,1000',
            'EngineChange'  => 'required|in:Yes,No',
            'ExteriorFinish'=> 'required|in:Factory-paint,Repaint',
            'ExteriorColour'=> 'required|string',
            'InteriorFinish'=> 'required|in:Leather,Fabric',
            'Roof'          => 'required|in:Covered,Sun-roof,Moon-roof,Convertible',
            'Accessories'   => 'required|in:Tool-box,Jack,Caution-signs,Manual',
            'Tags'          => 'string|between:10,500',
        ];
    }
}
