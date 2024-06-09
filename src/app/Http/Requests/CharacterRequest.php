<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|min:2|max:12',
            'enduser_id' => 'required',
            'bio' => 'nullable',
            'totalLevel' => 'required|numeric',
            'questPoints' => 'required|numeric',
            'image' => 'nullable|image',
            'collectionLogSlots' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Lauks ":attribute" ir obligāts',
            'min' => 'Laukam ":attribute" jābūt vismaz :min simbolus garam',
            'max' => 'Lauks ":attribute" nedrīkst būt garāks par :max simboliem',
            'boolean' => 'Lauka ":attribute" vērtībai jābūt "true" vai "false"',
            'unique' => 'Šāda lauka ":attribute" vērtība jau ir reģistrēta',
            'numeric' => 'Lauka ":attribute" vērtībai jābūt skaitlim',
            'image' => 'Laukā ":attribute" jāpievieno korekts attēla fails',
        ];
    }
    public function attributes(): array
    {
        return [
            'username' => 'Varoņa vārds',
            'enduser_id' => 'lietotājs',
            'totalLevel' => 'Kopējais prasmju līmenis',
            'questPoints' => 'Kvestu punktu skaits',
            'image' => 'attēls',
            'collectionLogSlots' => 'Kolekcijas priekšmetu skaits',
        ];
    }
}
