@if (count($servicos) > 0)
@foreach($servicos as $index => $servico)
    <li class="tr dd-item" data-id="{{ $index }}">
        <div class="td col-md-2 dd-handle">{{ $servico['servico'] }}</div>
        <div class="td col-md-2 dd-handle center">{{ $servico['quantidade'] }}</div>
        <div class="td col-md-2 dd-handle left">R$ {{ number_format($servico['valor'], 2, ',', '.') }}</div>
        <div class="td col-md-2 dd-handle left">R$ {{ number_format($servico['subtotal'], 2, ',', '.') }}</div>
        <div class="td col-md-1 dd-handle left">{{ $servico['discount'] }}%</div>
        <div class="td col-md-2 dd-handle left">R$ {{ number_format($servico['total'], 2, ',', '.') }}</div>
        <div class="td col-md-1 dd-nodrag right">
            <button type="button" class="btn btn-success btn-xs action" data-toggle="modal"
                    data-target="#modal" data-action="editServico" data-id="{{ $index }}">
                <i class="fa fa-pencil"></i>
            </button>
            <a href="" class="btn btn-danger btn-xs action" data-action="destroyServico" data-id="{{ $index }}"><i class="fa fa-trash"></i></a>
        </div>
    </li>
@endforeach
<li class="tr total col-md-12">
    <div class="td col-md-2 col-md-offset-7 left">
        <span class="label">Total Serviços</span>
    </div>
    <div class="td col-md-2 left">
    <span class="value">R$ {{ number_format($total, 2, ',', '.') }}</span>
    </div>
</li>
@else
    <div class="tr">
        <div class="td col-md-12">Não foram encontrados serviços.</div>
    </div>
@endif
