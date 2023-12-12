@auth 
    <h3>Olá, {{ auth()->user()->name }}</h3>
    <hr>
    <p>ID: {{ auth()->user()->id }}</p>
    <p>E-mail: {{ auth()->user()->email }}</p>
@endauth

@guest
    <h2>Boas-vindas, pessoa convidada!</h2>
@endguest