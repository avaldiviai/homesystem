<div class="pla-card h-100">
    <div class="pla-card-header" style="background:{{ $color }};">
        <div class="pla-icon-wrap">
            <i class="{{ $icono }}"></i>
        </div>

        <div class="flex-grow-1">
            <div class="pla-card-title">
                {{ $titulo }}
            </div>

            <small style="opacity:.8;font-size:.73rem;">
                {{ $nota }}
            </small>
        </div>

        <span class="badge rounded-pill"
              id="cnt-{{ $tipo }}"
              style="background:rgba(255,255,255,.25);font-size:.7rem;">
            0
        </span>
    </div>

    <div class="pla-card-body">

        @if(!$sinTotal)
        <div class="pla-total-block">
            <div>
                <div class="pla-tlabel">
                    {{ $esAdmin ? '10% Calculado' : 'Total acumulado' }}
                </div>

                <div class="pla-tvalue" id="tv-{{ $tipo }}">
                    $ 0
                </div>

                <div class="pla-tnota">
                    {{ $esAdmin ? 'Basado en el total ingresado' : 'Suma de registros' }}
                </div>
            </div>
        </div>
        @endif

        <div class="pla-stat">
            <span class="pla-stat-num" style="background:{{ $color }};">
                {{ $tipo }}
            </span>

            <span>
                {{ $nota }}
            </span>
        </div>

        <div class="pla-actions">
            <button
                class="pla-abtn pla-abtn--filled btn-agregar"
                data-tipo="{{ $tipo }}"
                style="background:{{ $color }};">
                <i class="fa-solid fa-plus"></i>
                Agregar
            </button>

            <button
                class="pla-abtn btn-ver"
                data-tipo="{{ $tipo }}"
                style="border-color:{{ $color }}; color:{{ $color }};">
                <i class="fa-solid fa-eye"></i>
                Ver
            </button>
        </div>

    </div>
</div>