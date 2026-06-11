@php
    $iniciales = collect(explode(' ', $user->name))
                    ->map(fn($p) => isset($p[0]) ? strtoupper($p[0]) : '')
                    ->filter()->take(2)->join('');
    $cargo   = optional($user->cargo)->nombre ?? 'Sin cargo';
    $banco   = $user->datosBancarioUser;
@endphp

<div class="rrhh-card"
     data-busqueda="{{ strtolower($user->name . ' ' . ($user->rut ?? '') . ' ' . $cargo . ' ' . $user->email) }}">

    {{-- Header --}}
    <div class="rrhh-card-header">
        <div class="rrhh-avatar">{{ $iniciales }}</div>
        <div style="min-width:0;">
            <p class="rrhh-card-name">{{ $user->name }}</p>
            <p class="rrhh-card-cargo">
                <i class="fas fa-briefcase" style="font-size:.65rem;"></i>
                <span class="rrhh-cargo-badge">{{ $cargo }}</span>
            </p>
        </div>
    </div>

    {{-- Body --}}
    <div class="rrhh-card-body">

        <div class="rrhh-field">
            <div class="rrhh-field-label"><i class="fas fa-id-card"></i> RUT</div>
            <div class="rrhh-field-value {{ $user->rut ? '' : 'empty' }}">
                {{ $user->rut ?: 'No registrado' }}
            </div>
        </div>

        <div class="rrhh-field">
            <div class="rrhh-field-label"><i class="fas fa-envelope"></i> Correo</div>
            <div class="rrhh-field-value">{{ $user->email }}</div>
        </div>

        <div class="rrhh-field">
            <div class="rrhh-field-label"><i class="fas fa-map-marker-alt"></i> Dirección</div>
            <div class="rrhh-field-value {{ $user->direccion ? '' : 'empty' }}">
                {{ $user->direccion ?: 'No registrada' }}
            </div>
        </div>

        {{-- Datos de cuenta bancaria --}}
        <div class="rrhh-field">
            <div class="rrhh-field-label"><i class="fas fa-university"></i> Datos de cuenta</div>
            @if($banco && ($banco->nombre_banco || $banco->numero_cuenta))
                <div style="background:var(--rrhh-bg); border-radius:8px; border:1px solid var(--rrhh-border); padding:8px 12px; font-size:.8rem;">
                    @if($banco->nombre_banco)
                        <div style="display:flex; align-items:center; gap:6px; margin-bottom:4px;">
                            <i class="fas fa-building-columns" style="color:var(--rrhh-accent); font-size:.75rem;"></i>
                            <span style="color:var(--rrhh-muted); font-size:.7rem; font-weight:700; text-transform:uppercase;">Banco</span>
                            <span style="font-weight:600; color:var(--rrhh-text);">{{ $banco->nombre_banco }}</span>
                        </div>
                    @endif
                    @if($banco->numero_cuenta)
                        <div style="display:flex; align-items:center; gap:6px; margin-bottom:4px;">
                            <i class="fas fa-hashtag" style="color:var(--rrhh-accent); font-size:.75rem;"></i>
                            <span style="color:var(--rrhh-muted); font-size:.7rem; font-weight:700; text-transform:uppercase;">N° Cuenta</span>
                            <span style="font-weight:600; color:var(--rrhh-text);">{{ $banco->numero_cuenta }}</span>
                        </div>
                    @endif
                    @if($banco->tipo_cuenta)
                        <div style="display:flex; align-items:center; gap:6px;">
                            <i class="fas fa-credit-card" style="color:var(--rrhh-accent); font-size:.75rem;"></i>
                            <span style="color:var(--rrhh-muted); font-size:.7rem; font-weight:700; text-transform:uppercase;">Tipo</span>
                            <span style="font-weight:600; color:var(--rrhh-text);">{{ $banco->tipo_cuenta }}</span>
                        </div>
                    @endif
                </div>
            @else
                <div class="rrhh-field-value empty" style="cursor:pointer;" onclick="abrirModalUsuario({{ $user->id }})">
                    <i class="fas fa-pencil-alt me-1" style="color:var(--rrhh-accent);"></i>
                    Sin datos bancarios — clic para agregar
                </div>
            @endif
        </div>

        {{-- Archivos adjuntos --}}
        <div class="rrhh-field">
            <div class="rrhh-field-label"><i class="fas fa-paperclip"></i> Archivos adjuntos</div>
            @if($user->archivosRrhh && $user->archivosRrhh->count() > 0)
                <div class="rrhh-archivos-list">
                    @foreach($user->archivosRrhh->take(3) as $archivo)
                        @php
                            $ext = strtolower($archivo->tipo_archivo ?? '');
                            $iconMap = [
                                'pdf'  => ['fa-file-pdf',   'pdf'],
                                'xls'  => ['fa-file-excel', 'excel'],
                                'xlsx' => ['fa-file-excel', 'excel'],
                                'doc'  => ['fa-file-word',  'word'],
                                'docx' => ['fa-file-word',  'word'],
                                'jpg'  => ['fa-file-image', 'img'],
                                'jpeg' => ['fa-file-image', 'img'],
                                'png'  => ['fa-file-image', 'img'],
                            ];
                            $icon = $iconMap[$ext] ?? ['fa-file', 'other'];
                        @endphp
                        <div class="rrhh-archivo-item">
                            <i class="fas {{ $icon[0] }} rrhh-archivo-icon {{ $icon[1] }}"></i>
                            <span class="rrhh-archivo-name" title="{{ $archivo->nombre_archivo }}">
                                {{ $archivo->nombre_archivo }}
                            </span>
                            <a href="{{ asset('storage/' . $archivo->ruta_archivo) }}"
                               target="_blank" class="rrhh-archivo-del" title="Ver archivo">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    @endforeach
                    @if($user->archivosRrhh->count() > 3)
                        <div style="font-size:.74rem; color:var(--rrhh-muted); padding:4px 10px;">
                            +{{ $user->archivosRrhh->count() - 3 }} más — edita para ver todos
                        </div>
                    @endif
                </div>
            @else
                <div class="rrhh-field-value empty">Sin archivos adjuntos</div>
            @endif
        </div>

    </div>

    {{-- Footer --}}
    <div class="rrhh-card-footer">
        <button class="rrhh-icon-btn rrhh-icon-btn-edit"
                onclick="abrirModalUsuario({{ $user->id }})"
                title="Editar colaborador">
            <i class="fas fa-edit"></i>
        </button>
        <button class="rrhh-icon-btn rrhh-icon-btn-del"
                onclick="eliminarUsuario({{ $user->id }}, '{{ addslashes($user->name) }}')"
                title="Eliminar colaborador">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>

</div>