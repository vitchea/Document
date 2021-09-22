<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Filein;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Schema;
use App\Http\Livewire\Request;
use PDF;
use Mpdf\Output\Destination\FILE;

use Livewire\WithPagination;
class Fileins extends Component
{
    use WithFileUploads;
    use WithPagination;
   // public $fileins;
    public $date,$filesource,$subject,$file,$fileid,$file_id;
    public $isModalOpen=0;
    public $search;
   

    public function render()
    {
        //  $this->fileins = FileIn::all();
        //  return view('livewire.fileins');
         
         return view('livewire.fileins', [
            'fileins' => FileIn::where('date', 'like', '%'.$this->search.'%')
                        ->orWhere('filesource', 'like', '%'.$this->search.'%')
                        ->orWhere('subject', 'like', '%'.$this->search.'%')
                        ->orWhere('fileid','like','%'.$this->search.'%')
                        ->paginate(10),
            // 'fields' => FileIn::select('year','code','title','filename')->get(),
        ]);
    }



 
     public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->date = '';
        $this->filesource = '';
        $this->subject = '';
        $this->fileid = '';
        $this->file = '';
    }
    public function store()
    {
        // $this->validate([
        //     'date' => 'required' ,
        //     'filesource' => 'required',
        //     'subject' => 'required',
        //     'fileid' => 'required',
        //     'file' => 'required',
        // ]);

        $validateData = [
            'date' => 'required' ,
            'filesource' => 'required',
            'subject' => 'required',
            'fileid' => 'required',
        ];

        $data = [
            'date' => $this->date,
            'filesource' => $this->filesource,
            'subject' => $this->subject,
            'fileid' => $this->fileid,
        ];

        if(!empty($this->file)){
            
            $doc = $this->file->store('file_in');

            $validateData = array_merge($validateData,[
                'file' => 'required'
            ]);
            $data = array_merge($data,[
                'file' =>  $doc
            ]);

        }
        $this->validate($validateData);

         // $filePath = $this->file->store('file_in');
        if($this->file_id){
          
            FileIn::find($this->file_id)->update($data);
        }else {
            FileIn::create($data);
        }
       
      // $filePath = $this->file->store('file_in');
        // FileIn::create([
        //     'date' => $this->date,    
        //     'filesource' => $this->filesource,
        //     'subject' => $this->subject,
        //     'fileid' => $this->fileid,
        //     'file' => $this->file->store('file_in'), 
        // ]);
         
        session()->flash('message', $this->file_id ? 'File updated.' : 'File created.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $filein = FileIn::findOrFail($id);
        $this->file_id = $id;
        $this->date = $filein->date;
        $this->filesource = $filein->filesource;
        $this->subject = $filein->subject;
        $this->fileid = $filein->fileid;
      
        $this->openModalPopover();
         
    }
   
    public function delete($id,$link)
    {
        FileIn::find($id)->delete();
        Storage::disk('local')->delete($link);
        session()->flash('message', 'FileIn deleted.');
    }
    
   public function export($link)
    { 
        
        $str = 'សាដ';
        $str = mb_convert_encoding($str, "UTF-8");
        return Storage::disk('local')->download($link,$str);  
              
    }
   
    
 

}
