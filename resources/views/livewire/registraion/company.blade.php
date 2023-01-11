<div x-data="{
            companies: $wire.companies,
            search: '',
            filtered: $wire.companies,
            focused: -1,
            drag: false,
            isUploading: false,
            progress: 0,
            selected: @entangle('company'),
            upload(event){
                @this.upload('logo', event.target.files[0],
                (uploadedFilename) => {
                    // Success callback.
                    this.isUploading = false;
                }, () => {
                    // Error callback.
                }, (event) => {
                    // Progress callback.
                    this.isUploading = true;
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                    this.progress = event.detail.progress;
                })
            },
            next(){
                this.focused = this.focused < this.filtered.length -1 ? this.focused + 1 : 0;
            },
            previous(){
                this.focused = this.focused > 0 ? this.focused - 1 : this.focused.length - 1;
            },
            filter(search){
                this.filtered = this.companies.filter( company => {
                    return company.name.toLowerCase().includes(search.toLowerCase());
                });
            }
        }"
     x-init="$watch('search', () => filter(search))">
    <div class="p-5 border border-logo grid md:grid-cols-2 md:gap-10">
        <div>
            <h3 class="font-semibold text-lg mb-4">{{ __('Select an existing company') }}</h3>
            <x-jet-input type="text" placeholder="{{ __('search') }}"
                         class="w-full"
                         x-model="search"
                         x-on:keydown.down="next"
                         x-on:keydown.up="previous"
            />
            <ul class="mt-4 h-96 overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-900 scrollbar-track-gray-100">
                <template x-for="( company, index ) in filtered">
                    <li class="border-b border-logo py-2 cursor-pointer hover:bg-gray-100 p-1 flex space-x-3"
                        :class="{ 'bg-gray-100' : focused == index }"
                        x-on:click="selected = company"
                    >
                        <div class="shrink-0">
                            <div class="w-10 aspect-square bg-gray-300 bg-center bg-no-repeat bg-contain" :style="{ backgroundImage: 'url(' + company.logo?.url + ')'}"></div>
                        </div>
                        <div>
                            <p x-text="company.name"></p>
                            <p class="text-sm font-light">
                                <span x-text="company.address.line_1"></span>
                                ,&nbsp;
                                <span x-text="company.address.zip"></span>
                                &nbsp;
                                <span x-text="company.address.city"></span>
                            </p>
                        </div>
                    </li>
                </template>
            </ul>
        </div>
        <div wire:loading.remove class="mt-10 md:mt-0 border-t md:border-t-0 pt-5 md:pt-0 border-logo">
            <template x-if="!selected">
                <div>
                    <h3 class="font-semibold text-lg mb-4">{{ __('Register a new company') }}</h3>
                    <form wire:submit.prevent="createCompany">
                        <div class="mt-4 relative">
                            @if(is_null($saved_logo))
                                <x-jet-label for="logo">{{ __('Logo Upload') }}<span class="text-red-500">*</span></x-jet-label>
                                <input type="file"
                                       accept="image/png, image/jpeg, image/jpg"
                                       class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
                                       x-on:change="upload"
                                       x-on:dragenter="drag = true"
                                       x-on:dragleave="drag = false"
                                       x-on:drop="drag = false"
                                >
                                <div class="p-3 border-2 border-logo border-dashed flex justify-center cursor-pointer"
                                     :class="drag ? 'bg-blue-50' : ''">
                                    <div>
                                        <p class="text-sm text-logo">{{ __('Drag here or click to select') }}</p>
                                    </div>
                                </div>
                                <div x-show="isUploading" class="w-full">
                                    <progress max="100" x-bind:value="progress" class="w-full"></progress>
                                </div>
                            @else
                                <x-jet-label>{{ __('Logo Preview') }}</x-jet-label>
                            <div class="grid grid-cols-2 gap-5">
                                <div>
                                    <img src="{{ $saved_logo->url }}">
                                </div>
                                <div class="flex flex-col justify-end">
                                    <x-jet-danger-button wire:click="deleteLogo">{{ __('delete') }}</x-jet-danger-button>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="name">{{ __('Company Name') }}<span class="text-red-500">*</span></x-jet-label>
                            <x-jet-input type="text" class="w-full" name="name" id="name" wire:model="name"></x-jet-input>
                            <x-jet-input-error for="name"></x-jet-input-error>
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="email">{{ __('Email Address') }}<span class="text-red-500">*</span></x-jet-label>
                            <x-jet-input type="text" class="w-full" name="name" id="email" wire:model="email"></x-jet-input>
                            <x-jet-input-error for="email"></x-jet-input-error>
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="phone">{{ __('Phone') }}<span class="text-red-500">*</span></x-jet-label>
                            <x-jet-input type="text" class="w-full" name="phone" id="phone" wire:model="phone"></x-jet-input>
                            <x-jet-input-error for="phone"></x-jet-input-error>
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="description">{{ __('Description') }}<span class="text-red-500">*</span></x-jet-label>
                            <p class="text-xs text-logo">{{ __('Please enter between 100 and 160 Characters.') }}</p>
                            <textarea rows="6" type="text" class="border-gray-300 focus:border-logo focus:ring focus:ring-logo focus:ring-opacity-50 shadow-sm w-full" name="description" id="description" wire:model="description"></textarea>
                            <x-jet-input-error for="description"></x-jet-input-error>
                        </div>
                        <div class="flex justify-end">
                            <x-jet-button>{{ __('submit') }}</x-jet-button>
                        </div>
                    </form>
                </div>
            </template>

            <template x-if="selected">
                <div>
                    <h3 class="font-semibold text-lg mb-4">{{ __('Selected company') }}</h3>
                    <div class="border border-logo p-3 flex space-x-3">
                        <div class="shrink-0">
                            <div class="w-10 aspect-square bg-gray-300 bg-center bg-no-repeat bg-contain" :style="{ backgroundImage: 'url(' + selected.logo?.url + ')'}"></div>
                        </div>
                        <div>
                            <p x-text="selected.name"></p>
                            <p class="text-sm font-light">
                                <span x-text="selected.address.line_1"></span>
                                ,&nbsp;
                                <span x-text="selected.address.line_2"></span>
                                &nbsp;
                                <span x-text="selected.address.city"></span>
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end items-center space-x-3">
                        <p class="text-logo text-sm cursor-pointer" x-on:click="selected = null">{{ __('remove') }}</p>
                        <x-jet-button>{{ __('next') }}</x-jet-button>
                    </div>
                </div>
            </template>
        </div>
        <div wire:loading>
            <div class="w-full h-full flex flex-col justify-center items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-logo" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>
