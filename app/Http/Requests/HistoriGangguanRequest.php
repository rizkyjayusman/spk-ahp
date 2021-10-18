<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoriGangguanRequest extends FormRequest
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
            'lokasi_id' => 'required',
            'kategori_gangguan_id' => 'required',
            'konklusi_id' => 'required',
            'awal_gangguan' => 'required|date_format:Y-m-d H:i:s',
            'akhir_gangguan' => 'required|date_format:Y-m-d H:i:s',
            // 'durasi_gangguan' => 'required|integer',
            'hasil_klasifikasi_id' => 'required',
        ];
    }
}
