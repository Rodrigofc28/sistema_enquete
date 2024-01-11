<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div >
                <form action="{{route('enquete.update',['enquete_id'=>$enquete_id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    
                    <h3 class="text-center text-lg italic font-extrabold underline">Editar Enquete</h3>
                                <x-input-label for="titulo" :value="__('Titulo da Enquete')" />
                                <x-text-input id="titulo"  class="block mt-1 w-full" 
                                                type="text"
                                                name="titulo"
                                                value="{{$edit->titulo}}"
                                                required  />
                                            
                            <div >
                                <h3 class="text-center text-lg italic font-extrabold underline">Data e Hora</h3>
                                <x-input-label for="dataInicio" :value="__('Data Inicio')" />
                                <x-date-input id="dataInicio"  class="block mt-1 w-full" 
                                                type="datetime-local"
                                                name="dataInicio"
                                                value="{{$edit->dataInicio}}"
                                                required  />
                            </div>
                           
                            <div >
                                
                                <x-input-label for="dataFim" :value="__('Data Fim')" />
                                <x-date-input id="dataFim"  class="block mt-1 w-full" 
                                                type="datetime-local"
                                                name="dataFim"
                                                value="{{$edit->dataFim}}"
                                                required  />
                            </div>
                            <h3 class="text-center text-lg italic font-extrabold underline">3 opções de resposta</h3>
                            <div >
                                <x-input-label for="opcao1" :value="__('opção nº 1')" />
                                <x-text-input id="opcao1"  class="block mt-1 w-full" 
                                                type="text"
                                                name="opcao1"
                                                value="{{$edit->opcao1}}"
                                                required  />
                            </div>
                            <div >
                                <x-input-label for="opcao2" :value="__('opção nº 2')" />
                                <x-text-input id="opcao2"  class="block mt-1 w-full" 
                                                type="text"
                                                name="opcao2"
                                                value="{{$edit->opcao2}}"
                                                required  />
                            </div>
                            
                            
                            <div >
                                <x-input-label for="opcao3" :value="__('opção nº 3')" />
                                <x-text-input id="opcao3"  class="block mt-1 w-full" 
                                                type="text"
                                                name="opcao3"
                                                value="{{$edit->opcao3}}"
                                                required  />
                            </div>
                            
                             <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">
                                    {{ __('Editar Enquete') }}
                                </x-primary-button>
                                <x-back-button class="ms-4">
                                    {{ __('Voltar') }}
                                </x-back-button>
                                
                </form>
            </div>
        </div>
    
</x-app-layout>