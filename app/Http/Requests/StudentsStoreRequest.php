<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentsStoreRequest extends FormRequest
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
            'stdDepartment'   => 'required',
            'stdDegree'       => 'required',
            'stdName'         => 'required|min:3',
            'stdfName'        => 'required|min:3',
            'stddob'          => 'required',
            'stdDomicile'     => 'required',
            'stdAddress'      => 'required',
            'stdPhoto'        => 'required',
            'metricSelect'    => 'required',
            'metricGroup'     => 'required',
            'metricRollno'    => 'required|numeric',
            'metricYear'      => 'required|numeric',
            'metricObtMarks'  => 'required|numeric',
            'metricTotMarks'  => 'required|numeric',
            'metricInstitue'  => 'required',
            'fscBoard'        => 'required',
            'stdEmail'        => 'required|email',
            'stdContact'      => 'required|min:13|max:13',
        ];
    }
}
