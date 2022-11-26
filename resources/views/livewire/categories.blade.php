<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
        </x-jet-button>
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @if($data->count())
                @foreach($data as $item)
                <tr>
                    <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $item->name }}</td>
                    <td class="px-6 py-4 text-sm whitespace-no-wrap">{!! $item->description !!}</td>
                    <td class="px-6 py-4 text-right">
                    <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                        {{ __('Update') }}
                    </x-jet-button>
                    <x-jet-danger-button wire:click="deleteShowModal({{ $item->id }})">
                        {{ __('Delete') }}
                    </x-jet-button>
                    </td>
                </tr>
                @endforeach
            @else 
                <tr>
                    <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">No result found.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{ $data->links() }}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Category Details') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="name" />
                @error('name')<span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Description') }}" />
                <div class="rounded-md shadow-sm">
                    <div class="mt-1 bg-white">
                        <div class="body-content" wire:ignore>
                            <trix-editor class="trix-content" x-ref="trix" wire:model.debounce.10000ms="description" wire:key="trix-content-unique-key"></trix-editor>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            
            <x-jet-danger-button class="ml-3" wire:click="save({{ $catId }})" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
