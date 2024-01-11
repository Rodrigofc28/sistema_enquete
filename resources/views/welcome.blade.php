
<x-app-layout>
        <div>
            <h1>GERENCIAMENTO DE ENQUETES</h1>
            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{route('enquete.show')}}">APRESENTAÇÃO DAS ENQUETES</a>
            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{route('create.enquete')}}">CRIAR ENQUETE</a>
        </div>
           
        
        <div class="flex-container ">
            
            @foreach ($enqueteDb as $enquete)
            <div class="flex-item">
                <div class="enqueteDiv">
                    <div>
                        
                        <span id="titulo">{{ $enquete->titulo }}</span>
                    </div>
                    <div style="display: block">
                        <div>
                            <label id="dataIn" for="">Data de Inicio</label>
                        <span id="dataIn">{{ \Carbon\Carbon::parse($enquete->dataInicio)->format('d-m-Y') }}</span>
                        </div>
                        <div>
                            <label id="dataIn" for="">Hora</label>
                        <span id="dataIn">{{ \Carbon\Carbon::parse($enquete->dataInicio)->format('H:i') }}</span>
                        </div>
                        
                    </div>
                    <div style="display: block">
                        <div>
                            <label for="dataFn">Data Final</label>
                            <span id="dataFn">{{ \Carbon\Carbon::parse($enquete->dataFim)->format('d-m-Y') }}</span>
                        </div>
                        <div>
                            <label for="dataFn">Hora</label>
                            <span id="dataFn">{{ \Carbon\Carbon::parse($enquete->dataFim)->format('H:i') }}</span>
                        </div>
                        
                    </div>
                    <div class="flex-container ">
                        
                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{route('enquete.edit',['enquete_id'=>$enquete->id])}}">Editar</a>
                        <form action="{{route('enquete.destroy',['enquete_id'=>$enquete->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <x-danger-button>Deletar</x-danger-button>
                        </form>
                        
                    </div>
                    
                
                </div>
           
        </div>
    @endforeach
     
    </div>
    <script src="/js/socket.io.js"></script>
    <script src="/js/echo.js"></script>
    <!-- Adicione o código JavaScript para ouvir eventos Laravel Echo -->
    <script>
        
        window.Echo.channel('enquete-channel')
            .listen('EnqueteStatusUpdated', (event) => {
                // const enqueteId = event.enquete.id;
                // console.log(enqueteId)
                // // Encontrar o elemento HTML correspondente à enquete
                // const enqueteElement = document.querySelector(`[data-enquete-id="${enqueteId}"]`);

                // if (enqueteElement) {
                //     // Atualizar o status da enquete no elemento HTML
                //     const statusElement = enqueteElement.querySelector('.status');
                //     if (statusElement) {
                //         statusElement.innerHTML = `Status: ${event.enquete.status}`;
                //     }

                //     // Atualizar a interface do usuário conforme necessário
                //     console.log('Enquete Status Atualizado em tempo real', event.enquete);
                // }
            });
    </script>
    </x-app-layout>


