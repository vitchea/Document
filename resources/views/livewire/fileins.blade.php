

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            <div class="flex justify-between py-4 px-4">
                
                    <input wire:model="search" type="search" placeholder="ស្វែងរក" class="my-4 rounded-lg focus:ring-2 focus:ring-blue-600" style="width: 70%" > 
                
                
                <button wire:click="create()"
                class=" my-4 rounded-md border border-transparent px-4 py-2 bg-blue-600 text-base font-bold text-white shadow-sm hover:bg-blue-700">
                បញ្ចូលឯកសារ
                </button> 
                
            </div>
            
             @if($isModalOpen)
            @include('livewire.create')
            @endif 
             <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100 ">
                        <th class="px-4 py-2 w-2/12">កាលបរិច្ជេទចូល</th>
                        <th class="px-4 py-2 w-4/12">ប្រភពឯកសារ</th>
                        <th class="px-4 py-2 w-4/12">ប្រធានបទ</th>
                        <th class="px-4 py-2 w-2/12">លេខឯកសារ</th>
                        <th class="px-4 py-2 w-1/12"></th>
                        <th class="px-4 py-2 w-2/12"></th>
                    </tr>
                </thead>
                <tbody>
                  
                    @foreach($fileins as $filein)
                    <tr class="hover:bg-blue-50">
                        <td class="border px-4 py-2">{{ $filein->date }}</td>
                        <td class="border px-4 py-2">{{ $filein->filesource }}</td>
                        <td class="border px-4 py-2">{{ $filein->subject }}</td>
                        <td class="border px-4 py-2">{{ $filein->fileid }}</td>
                        <td class="border px-4 py-2 hover:bg-white">
                                        
                            <button wire:click="export('{{$filein->file}}','{{$filein->subject}}')" class=" px-4 py-2 cursor-pointer rounded-l-md hover:text-yellow-600">
                                Download 
                            </button>
                            <a href="{{ asset('storage/file_in/'.$filein->file) }}" target="_blank"> a</a>
                        </td>
                        <td class="border flex flex-row px-4 py-2">
                            <button  wire:click="edit({{ $filein->id }})"
                                class=" px-4 py-2 bg-green-500 text-white hover:bg-green-900 cursor-pointer rounded-l-md w-24">កែប្រែ</button>
                            <button wire:click="delete('{{ $filein->id }}','{{$filein->file}}')"
                                class=" px-4 py-2 bg-red-500 text-white hover:bg-red-900 cursor-pointer rounded-r-md w-24">លុប</button>
                        </td>
                    </tr>
                    @endforeach
                  
                </tbody>
            </table>
        </div>
        <div class="px-6 py-6">
             {{$fileins->links()}}
        </div>
      
    </div>
</div>






{{-- <x-slot name="header">
    <h2 class="text-center">Laravel 8 Livewire CRUD Demo</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            <button wire:click="create()"
                class="my-4 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base font-bold text-white shadow-sm hover:bg-red-700">
                Create File
            </button>
            @if($isModalOpen)  
            @include('livewire.create') 
            @endif  
             @include('livewire.create') 
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Filename</th>
                        <th class="px-4 py-2">File</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>`
                    
                     @foreach($fileins as $filein)
                    <tr>
                       
                        <td class="border px-4 py-2">{{ $filein->title }}</td>
                        <td class="border px-4 py-2">{{ $filein->filename}}</td>
                        <td class="border px-4 py-2">{{ $filein->file}}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $filein->id }})"
                                class="flex px-4 py-2 bg-gray-500 text-gray-900 cursor-pointer">Edit</button>
                            <button wire:click="delete({{ $filein->id }})"
                                class="flex px-4 py-2 bg-red-100 text-gray-900 cursor-pointer">Delete</button>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div> --}}
