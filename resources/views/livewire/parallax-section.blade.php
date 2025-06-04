<div>
    <section class="parallax-section" id="parallax-section">
        <div class="parallax-container">
            <img src="{{ asset('images/sticky.jpg') }}" alt="Parallax Background" class="parallax-image">
        </div>

        <div class="content-overlay">
            <!-- Optional text di tengah -->
            <!-- <h1>Selamat Datang</h1> -->
        </div>

        <!-- Tambahkan card di atas parallax -->
        <div class="parallax-card-overlay flex justify-center items-center">
            <div class="scroll-wrapper flex gap-4">
                <a href="{{ route('jenis.index') }}">
                    <div class="relative w-48 h-64 rounded-lg overflow-hidden shadow-lg bg-cover bg-center"
                        style="background-image: url('{{ asset('images/jenis.jpg') }}')">
                        <div class="absolute bottom-10 w-full bg-black bg-opacity-50 text-white text-center py-2 font-bold">
                            JENIS
                        </div>
                    </div>
                </a>
                <a href="{{ route('aquarium.index') }}">
                    <div class="relative w-48 h-64 rounded-lg overflow-hidden shadow-lg bg-cover bg-center"
                        style="background-image: url('{{ asset('images/aquarium.jpg') }}')">
                        <div class="absolute bottom-10 w-full bg-black bg-opacity-50 text-white text-center py-2 font-bold">
                            AQUARIUM
                        </div>
                    </div>
                </a>
                <a href="{{ route('perawatan.index') }}">
                    <div class="relative w-48 h-64 rounded-lg overflow-hidden shadow-lg bg-cover bg-center"
                        style="background-image: url('{{ asset('images/perawatan.jpg') }}')">
                        <div class="absolute bottom-10 w-full bg-black bg-opacity-50 text-white text-center py-2 font-bold">
                            PERAWATAN
                        </div>
                    </div>
                </a>
                <a href="{{ route('aksesoris.index') }}">
                    <div class="relative w-48 h-64 rounded-lg overflow-hidden shadow-lg bg-cover bg-center"
                        style="background-image: url('{{ asset('images/aksesoris.jpg') }}')">
                        <div class="absolute bottom-10 w-full bg-black bg-opacity-50 text-white text-center py-2 font-bold">
                            AKSESORIS
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</div>
