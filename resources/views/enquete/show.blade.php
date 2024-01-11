<x-app-layout>
    <h1>APRESENTAÇÃO</h1>
    <x-back-button class="ms-4">
        {{ __('Voltar') }}
    </x-back-button>

    <div class="flex-container">
        @foreach ($enquetesComVotos as $enqueteData)
            <div class="flex-item" data-enquete-id="{{ $enqueteData['enquete']->id }}">
                <div class="enqueteDiv">
                    <div>
                        <span id="titulo">{{ $enqueteData['enquete']->titulo }}</span>
                    </div>
                    
                    <div style="display: block">
                        <div>
                            <label id="dataIn" for="">Data de Inicio</label>
                            <span id="dataIn">{{ \Carbon\Carbon::parse($enqueteData['enquete']->dataInicio)->format('d-m-Y') }}</span>
                        </div>
                        <div>
                            <label id="dataIn" for="">Hora</label>
                            <span id="dataIn">{{ \Carbon\Carbon::parse($enqueteData['enquete']->dataInicio)->format('H:i') }}</span>
                        </div>
                        <div>
                            <label for="dataFn">Data Final</label>
                            <span id="dataFn">{{ \Carbon\Carbon::parse($enqueteData['enquete']->dataFim)->format('d-m-Y') }}</span>
                        </div>
                        <div>
                            <label for="dataFn">Hora</label>
                            <span id="dataFn">{{ \Carbon\Carbon::parse($enqueteData['enquete']->dataFim)->format('H:i') }}</span>
                        </div>
                    </div>

                    <div>
                        <p class="status" @if ($enqueteData['status']=='Não Iniciada')style="background-color:yellow"@elseif($enqueteData['status']=='Em Andamento') style="background-color:rgb(21, 212, 46)" @elseif($enqueteData['status']=='Finalizado') style="background-color:rgb(241, 31, 31)"@endif>Status: {{ $enqueteData['status'] }}</p>

                        <!-- Restante do seu código HTML para a enquete -->
                        
                        <form action="{{ route('enquete.resp', ['enquete_id' => $enqueteData['enquete']->id]) }}" method="post">
                            @csrf
                            <ul id="res">
                                @foreach ($enqueteData['opcoesComVotos'] as $opcaoData)
                                    <li>
                                        <span class="votos">{{ $opcaoData['votos'] }} votos</span>
                                        <input type="radio" name="opcao" value="{{ $opcaoData['opcao'] }}" id="">
                                        {{ $opcaoData['opcao'] }}
                                    </li>
                                @endforeach
                            </ul>
                            @if (($enqueteData['status']=='Não Iniciada')||$enqueteData['status']=='Finalizado')
                                
                            @else
                                <x-primary-button >Enviar Resposta</x-primary-button>
                            @endif
                            
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
   
</x-app-layout>

