<?php

namespace App\Http\Livewire\Account;

use App\Models\Image;
use App\Models\Property;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowProperty extends Component
{
    use WithFileUploads;
    public $property = null;
    public $photos = [];

    public function uploadAdditionalPhotos()
    {
        $this->validate([
            'photos.*' => 'image|mimes:jpg,jpeg,bmp,png|max:2048' // 2Mb Max
        ]);
        foreach ($this->photos as $photo){
            $directory = "images/properties/{$this->property->id}";
            $path = $photo->store($directory, 'public'); // in public disk storage
            $fileName = $photo->hashName();
            $this->property->images()->save(new Image([
                'user_id' => auth()->user()->id,
                'name' => $fileName,
                'path' => "/storage/{$path}",
                'thumbnail_name' => $fileName,
            ]));
        }
        $count = count($this->photos);
        $this->photos = [];
        // clear the temp folder
        // Storage::disk('local')->deleteDirectory("livewire-tmp");
        session()->flash('success', "Successfully uploaded {$count} additional photos!");
        redirect()->route('view-property', ['id' => $this->property->id]);
    }

    public function publish(){
        $this->property->status = Property::STATUS_VERIFIED;
        $this->property->save();
        $this->property->refresh();
        session()->flash('success', "Property published!");
    }

    public function unpublish(){
        $this->property->status = Property::STATUS_PENDING;
        $this->property->save();
        $this->property->refresh();
        session()->flash('success', "Property unpublished!");
    }

    public function mount($property_id)
    {
        $this->property = Property::find($property_id);
    }

    public function render()
    {
        return view('livewire.account.show-property')
            ->extends('manager.layout')
            ->section('content');
    }
}
