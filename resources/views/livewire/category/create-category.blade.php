<div>
    <x-create-data>
        <div>
            <h3 class="text-lg font-medium leading-6 " x-text="edit ? 'Editar usuario':'Crear Usuario'">Crear
                Usuario
            </h3>
        </div>
        <form x-ref="form_create" class="mt-3" wire:submit.prevent="save">
            <div class="divide-y divide-gray-100">
                <div class="flex items-center py-4 ">
                    <x-jet-label class="w-3/12">
                        Nombre

                    </x-jet-label>
                    <div class=" w-4/12">
                        <x-jet-input type="text" wire:model.defer="category.name">
                        </x-jet-input>
                        @error('category.name')
                            <span class="error error-input">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center py-4 ">
                    <x-jet-label class="w-3/12">
                        Slug

                    </x-jet-label>
                    <div class=" w-4/12">
                        <x-jet-input type="text" wire:model.defer="category.slug">
                        </x-jet-input>
                        @error('category.slug')
                            <span class="error error-input">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center py-4 ">
                    <x-jet-label class="w-3/12">
                        Activo

                    </x-jet-label>
                    <div class=" w-4/12">
                        <div class="flex items-center">
                            <div>
                                <span>SI</span>
                                <x-jet-input type="radio" name="active" value="1" wire:model.defer="category.active">
                                </x-jet-input>
                            </div>
                            <div class="ml-3">
                                <span>NO</span>
                                <x-jet-input type="radio" name="active" value="0" wire:model.defer="category.active">
                                </x-jet-input>
                            </div>
                        </div>
                        @error('category.active')
                            <span class="error error-input">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center py-4 ">
                    <x-jet-label class="w-3/12">Image</x-jet-label>

                    <div class="w-8/12">
                        <x-form-input-file :temp="$img" :multiple="false" name="img" :saved="$category->img" />
                        @error('img')
                            <span class="error error-input">{{ $message }}</span>
                        @enderror


                    </div>
                </div>




            </div>

        </form>
        <div class="text-right py-3">
            <x-jet-secondary-button x-on:click="$dispatch('list-show')" wire:loading.attr="disabled">
                volver
            </x-jet-secondary-button>
            <x-jet-button x-show="!edit" class="ml-2" wire:click="save" wire:loading.attr="disabled">
                Guardar
            </x-jet-button>
            <x-jet-button x-show="edit" x-on:click="$wire.update(id)" class="ml-2"
                wire:loading.attr="disabled">
                Editar </x-jet-button>

        </div>
    </x-create-data>

    <!--Modal confirmation delete-->
    <div>
        <div x-data="{
        show :@entangle('open_modal_confirmation').defer,
        id:null
    }" @open-modal-confirmation-delete.window="show = true;id=$event.detail;">

            <x-confirmation-modal>
                <x-slot name="title">
                    Borrar Categoria
                </x-slot>

                <x-slot name="content">
                    ¿Estás seguro de que deseas eliminar esta categoria?
                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button x-on:click="show=false" wire:loading.attr="disabled">
                        cancelar
                    </x-jet-secondary-button>

                    <x-jet-danger-button class="ml-2" x-on:click="$wire.delete(id)"
                        wire:loading.attr="disabled">
                        <span wire:loading.class="hidden" wire:target="delete">Borrar Categoria</span>
                        <span wire:loading wire:target="delete"> Borrando... </span>
                    </x-jet-danger-button>
                </x-slot>
            </x-confirmation-modal>
        </div>
    </div>
</div>
