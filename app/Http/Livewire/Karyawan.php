<?php

namespace App\Http\Livewire;
use App\Models\User;

use Livewire\Component;
use Illuminate\Http\Request;

class Karyawan extends Component
{
    public $search;
    public $modalDetail = false;
    public $modalAdd = false;
    public $emit;

    public $nama,$alamat,$telepon,$email='@gmail';

    public function datatable(Request $request){
        $data = User::role('user')->get();

        if($request->ajax()){
            $table = datatables()->of($data);
            $table->addIndexColumn();

            $table->editColumn('aksi',function ($row) {
                return '
                    <td style="white-space: nowrap; width: 1%;"><div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                        <div class="btn-group btn-group-sm" style="float: none;">
                            <button type="button" wire:click="detail('.$row['id'].')" class="tabledit-detail-button-'.$row['id'].' btn btn-sm btn-secondary" style="float: none;">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button type="button" onclick="modalEditBuku('.$row['id'].')" class="tabledit-edit-button-'.$row['id'].' btn btn-sm btn-success" style="float: none;">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <a href="" type="button" class="tabledit-delete-button-'.$row['id'].' btn btn-sm btn-danger mt-0" style="float: none;">
                                <i class="fas fa-book"></i>
                            </a>
                        </div>
                    </td>
                ';
            });

            $table->rawColumns(['aksi']);
            return $table->make(true);
        }
    }

    public function render()
    {
        if($this->search === null || $this->search === ''){
            $data = User::role('user')->get();
        }else{
            $data = User::role('user')->where('name','like','%'.$this->search.'%')->get();
        }
        //dd($data);
        return view('livewire.karyawan',compact('data'))
                ->extends('layouts.app')
                ->section('content');
    }

    public function detail($id){
        $this->modalDetail=true;
        $note= User::find($id);
        $this->nama = $note->name;
        $this->alamat = $note->alamat;
        $this->telepon = $note->telepon;
        $this->email = $note->email;
        $this->modal = true;
        //dd("hallo");

        //$this->emit('renderDT');
        
        //$this->dispatchBrowserEvent('say-goodbye', []);

    }

    public function store(){
        $user = User::updateOrCreate(['id' => $this->id],[
            'name' => $this->nama,
            'email' => $this->email,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'password' => '1234',
            'foto' => "foto",
            'jenkel' => 'l',
        ]);

        $user->assignRole('user');

        $this->nama='';
        $this->alamat='';
        $this->telepon='';
    }

    public function closeModal(){
        $this->modalDetail = false;
    }

    
}