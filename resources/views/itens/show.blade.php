@if (count($itens) > 0)
@foreach($itens as $index => $item)
    <li class="tr dd-item" data-id="{{ $index }}">
        <div class="td col-md-5 dd-handle">{{ $item['item'] }}</div>
        <div class="td col-md-2 dd-handle">{{ $item['quantidade'] }}</div>
        <div class="td col-md-2 dd-handle">
            @if($item['valor'])
                R$ {{ number_format($item['valor'], 2, ',', '.') }}
            @endif
        </div>
        <div class="td col-md-2 dd-handle">
            @if($item['total'])
                R$ {{ number_format($item['total'], 2, ',', '.') }}
            @endif
        </div>
        <div class="td col-md-1 dd-nodrag">
            <button type="button" class="btn btn-success btn-xs action" data-toggle="modal"
                    data-target="#modal" data-action="editItem" data-id="{{ $index }}">
                <i class="fa fa-pencil"></i>
            </button>
            <a href="" class="btn btn-danger btn-xs action" data-action="destroyItem" data-id="{{ $index }}"><i class="fa fa-trash"></i></a>
        </div>
    </li>
@endforeach
@if($total)
    <li class="tr total col-md-12">
        <div class="td col-md-2 col-md-offset-7 left">
            <span class="label">Total Serviços</span>
        </div>
        <div class="td col-md-2 left">
            <span class="value">R$ {{ number_format($total, 2, ',', '.') }}</span>
        </div>
    </li>
@endif
@else
    <div class="tr">
        <div class="td col-md-12">Não foram encontrados itens.</div>
    </div>
@endif
