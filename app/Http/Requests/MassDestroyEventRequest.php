<?php

namespace App\Http\Requests;

use App\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEventRequest extends FormRequest
{
    // public function authorize()
    // {
    //     abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return true;
    // }

    public function rules()
    {
        return [
            'id_jadwals'   => 'required|array',
            'id_jadwals.*' => 'exists:events,id_jadwal',
        ];
    }
}
