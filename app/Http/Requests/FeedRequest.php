<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FeedRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules = [
            'url_rss' => 'required|url|unique:feeds,url_rss',
            'name' => 'required|string',
            'url' => 'url',
            'description' => 'string',
            'pub_time' => 'date_format(Y-m-d H:i:s)'
        ];

        switch ($this->getMethod()) {
            case 'GET':
                return [
                    'id' => 'required|integer|exists:feeds,id',
                ];
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'id' => 'required|integer|exists:feeds,id',
                ] + $rules;
                // case 'PATCH':
            case 'DELETE':
                return [
                    'id' => 'required|integer|exists:feeds,id'
                ];
        }
    }
    public function messages()
    {
        return [
            'url_rss.required' => 'Feed must have url_rss',
            'url_rss.unique' => 'This feed already exists',
            'url_rss.url' => 'Need valid url in url_rss',
            'name.required' => 'Feed mast have Name',
            'description' => 'Description mast be a string',
            'pub_time.date_format'  => 'A date must be in format: Y-m-d H:i:s',
            'id.required'  => 'You mast provide ID of feed',
            'id.integer'  => 'ID of feed must be a integer',
            'id.exists'  => 'This ID doesn\'t exists'
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all($keys = null);
        switch ($this->getMethod()) {
            case 'GET':
                $data['id'] = $this->route('id');
            case 'PUT':
                $data['id'] = $this->route('id');
                // case 'PATCH':
            case 'DELETE':
                $data['id'] = $this->route('id');
        }
        return $data;
    }
}
