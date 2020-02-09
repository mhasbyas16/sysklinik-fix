<?php

namespace App\Http\Requests;

use App\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateEventRequest extends FormRequest
{
    /*public function authorize()
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }*/

    public function rules()
    {
        return [
            'id_pegawai'       => [
                'required',
            ],
            'id_asses'       => [
                'required',
            ],
            'id_terapipasien'       => [
                'required',
            ],
            'keterangan'       => [
                'required',
            ],
            'tgl' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'jam_masuk'   => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'recurrence' => [
                'required',
            ],
            'biaya' => [
                'required',
            ],
        ];
    }
}
