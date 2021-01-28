<?php

namespace App\Http\Livewire;

use App\Models\Perusahaan;
use Livewire\Component;

class Perusahan extends Component
{
    public $nama, $alamat, $nomor_telepon, $nomor_fax, $website, $provinsi, $kota, $kode_pos;

    public function render()
    {
        return view('livewire.perusahan');
    }

    private function resetInputFields(){
        $this->nama = '';
        $this->alamat = '';
        $this->nomor_fax = '';
        $this->nomor_telepon = '';
        $this->website = '';
        $this->provinsi = '';
        $this->kota ='';
        $this->kode_pos = '';
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'nomor_fax' => 'string',
            'website' => 'string',
            'provinsi' => 'string',
            'kota' => 'string',
            'kode_pos' => 'integer',
        ]);

        $perusahaan = new Perusahaan();
        $perusahaan->nama = $this->nama;
        $perusahaan->alamat = $this->alamat;
        $perusahaan->nomor_telepon = $this->nomor_telepon;
        $perusahaan->nomor_fax = $this->nomor_telepon;
        $perusahaan->website = $this->website;
        $perusahaan->provinsi = $this->provinsi;
        $perusahaan->kota = $this->kota;
        $perusahaan->kode_post = $this->kode_pos;
        $perusahaan->save();

        $this->resetInputFields();

        $this->emit('userStore'); // Close model to using to jquery

    }
}
