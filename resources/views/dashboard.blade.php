<x-app-layout>
<html lang="id">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

                <div class="w-full">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner h-[600px]"> <!-- Atur tinggi sesuai keinginan -->
                        <div class="carousel-item active" data-bs-interval="3000">
                        <img src="{{ asset('images/ikan1.png') }}" class="d-block w-100 h-full object-cover" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                        <img src="{{ asset('images/ikan2.png') }}" class="d-block w-100 h-full object-cover" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                        <img src="{{ asset('images/ikan3.png') }}" class="d-block w-100 h-full object-cover" alt="...">
                        </div>
                        <!-- tombol panah -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</x-app-layout>