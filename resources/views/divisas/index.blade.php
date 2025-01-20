@include('inc.header')

<main id="main-section">

    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ Session::get('mensaje')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(Session::has('mensajeerror'))
        <div class="alert alert-warning alert-dismissible" role="alert">
            {{ Session::get('mensaje')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1>Conversión de Divisas</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('divisas.convertir') }}" method="POST">
    @csrf
    <div>
        <label for="cantidad">Cantidad a Convertir:</label>
        <input type="number" id="cantidad" name="cantidad" required>
    </div>

    <div>
        <label for="de">Moneda de Origen (ej. USD):</label>
        <input type="text" id="de" name="de" required placeholder="Ej: USD">
    </div>

    <div>
        <label for="a">Moneda de Destino (ej. EUR):</label>
        <input type="text" id="a" name="a" required placeholder="Ej: EUR">
    </div>

    <button type="submit">Convertir</button>
</form>

</main>

