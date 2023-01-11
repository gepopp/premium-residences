<?php

namespace App\Http\Livewire\Registraion;


use App\Models\Image;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ValidateCompanyEmailNotification;




class Company extends Component
{

    use WithFileUploads;




    public $companies;




    public $company = false;




    public $selected = null;




    public $logo;




    public $saved_logo;




    public $name, $email, $phone, $description;




    public $code;




    public function mount()
    {

        $this->companies = \App\Models\Company::with('address')->with('logo')->get()->toArray();
    }





    public function createCompany()
    {

        $this->validate([
            'name'        => [ 'string', 'required', 'max:250' ],
            'email'       => [ 'email:rfc,dns', 'required', Rule::unique('companies', 'email') ],
            'phone'       => [ 'string', 'required', 'max:250' ],
            'description' => [ 'string', 'required', 'min:100', 'max:160' ],
        ]);

        /**
         * @var $company \App\Models\Company
         */
        $company = \App\Models\Company::create([
            'name'        => $this->name,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'description' => $this->description,
        ]);

        $this->saved_logo->update([
            'alt'            => 'Logo ' . $this->name,
            'imageable_id'   => $company->id,
            'imageable_type' => get_class($company),
        ]);

        $this->code = Str::random(5);

        $company->notify( new ValidateCompanyEmailNotification($this->code));


    }




    public function updatedLogo()
    {

        $this->validate([
            'logo' => 'image|max:1024',
        ]);


        $folder = time();
        $path = 'images/' . $folder . '/' . $this->logo->getClientOriginalName();

        $this->logo->storeAs('images/' . $folder, $this->logo->getClientOriginalName(), 's3');
        $image = \Intervention\Image\Facades\Image::make(Storage::disk('s3')->get($path));

        $this->saved_logo = Image::create([
            'imageable_field' => 'logo',
            'alt'             => '{"de":"Logo", "en":"Logo"}',
            'path'            => $path,
            'folder'          => $folder,
            'url'             => Storage::disk('s3')->url($path),
            'width'           => $image->width(),
            'height'          => $image->height(),
            'size'            => $image->filesize(),
        ]);

    }




    public function deleteLogo()
    {

        $this->saved_logo->delete();
        $this->saved_logo = $this->logo = null;
    }




    public function render()
    {

        return view('livewire.registraion.company');
    }
}
