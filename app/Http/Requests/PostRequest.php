<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PostRequest extends FormRequest
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
            'guid' => 'required|unique:posts,guid',
            'title' => 'required|string',
            'link' => 'url|nullable ',
            'description' => 'string',
            'author' => 'string|nullable ',
            'pub_time' => 'date_format(Y-m-d H:i:s)|nullable ',
            'feeds_id' => 'required|exists:feeds,id'
        ];

        switch ($this->getMethod()) {
            case 'GET':
                return [
                    'id' => 'required|integer|exists:posts,id',
                ];
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'id' => 'required|integer|exists:posts,id',
                ] + $rules;
                // case 'PATCH':
            case 'DELETE':
                return [
                    'id' => 'required|integer|exists:posts,id'
                ];
        }
    }
    public function messages()
    {
        return [
            'guid.required' => 'Feed must have GUID',
            'guid.unique' => 'Post with this guid already exists',
            'title.required' => 'Post mast have Title',
            'description' => 'Description mast be a string',
            'author' => 'Description mast be a string',
            'pub_time.date_format'  => 'A date must be in format: Y-m-d H:i:s',
            'feeds_id.required'  => 'You mast provide ID of Feed',
            'feeds_id.exists'  => 'Feed with this ID doesn\'t exists',
            'id.required'  => 'You mast provide ID of Post',
            'id.integer'  => 'ID of post must be a integer',
            'id.exists'  => 'Post with this ID doesn\'t exists'
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
