@if ($total > 0)
    <div class="td col-md-2 col-md-offset-7 left">
        <span class="label">Total Orçamento</span>
    </div>
    <div class="td col-md-2 left">
        <span class="value">R$ {{ number_format($total, 2, ',', '.') }}</span>
    </div>
@endif
