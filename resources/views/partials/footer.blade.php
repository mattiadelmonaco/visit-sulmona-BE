<footer class="content shadow py-3">
    <div
        class="container d-flex justify-content-around align-items-center flex-wrap gap-4 border-bottom border-white pb-3">
        <a href="{{ url('/') }}">
            <div class="bg-white p-3 rounded-circle shadow">
                <img src="{{ asset('storage/visits-sulmona-logo-backoffice.svg') }}" alt="logo" style="width: 120px">
            </div>
        </a>
        <a href="#"
            class="text-decoration-none text-danger fw-bold bg-light px-4 py-2 rounded-3 text-center d-block fs-5 hover-scale">Vai
            al
            sito per visitatori</a>
    </div>

    <p class="m-0 mt-2 py-2 bg-white text-center">Made with <i class="fa-solid fa-heart"></i> by Mattia Del Monaco
    </p>

</footer>

<style>
    .hover-scale {
        transition: transform 0.2s ease;
    }

    .hover-scale:hover {
        transform: scale(1.05);
    }
</style>
