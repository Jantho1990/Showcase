<?php

namespace Showcase\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisplayRequest extends FormRequest
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
        $name = $this->method() === 'PUT'
            ? 'required|string|max:255'
            : 'required|string|unique:'.config('showcase.table_prefix').'displays,name|max:255';

        return [
            'name' => $name,
            'component_view' => 'required|string',
            'default_trophy_component_view' => 'required|string',
            'force_trophy_default' => 'nullable|boolean'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            collect($validator->errors()->all())->each(function ($message) {
                flash()->error($message);
            });
        });
    }
}