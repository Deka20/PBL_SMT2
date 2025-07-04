<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ulasan Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#d94c82',
                        secondary: '#ffd6e7',
                    }
                }
            }
        }
    </script>
    <style>
        .half-star {
            position: relative;
            display: inline-block;
        }

        .half-star::before {
            content: "\2605";
            position: absolute;
            width: 50%;
            overflow: hidden;
            color: #fbbf24;
        }

        .rating-label {
            cursor: pointer;
            color: #d1d5db;
        }

        .rating-label.selected {
            color: #fbbf24;
        }
    </style>
</head>

<body class="bg-gray-100 flex">
    <x-sidebar></x-sidebar>

    <div class="flex-1 container mx-auto p-8 lg:ml-64">
        <div class="bg-white p-8 rounded-lg shadow-md mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-4">Ulasan Pengguna</h2>
            <div class="flex items-center mb-4">
                <div class="text-6xl font-bold text-primary mr-4">{{ number_format($averageRating, 1) }}</div>
                <div>
                    <div class="text-yellow-400 text-3xl mb-1">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($averageRating))
                                ★
                            @elseif($i - 0.5 <= $averageRating)
                                <span class="half-star"></span>
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <div class="text-gray-600 text-sm">Dari {{ $totalReviews }} Ulasan</div>
                </div>
            </div>

            <hr class="my-6 border-gray-200">

            <div class="space-y-3">
                @foreach ([5, 4, 3, 2, 1] as $rating)
                    <div class="flex items-center text-sm">
                        <span class="text-gray-700 font-medium mr-2">{{ $rating }} Bintang</span>
                        <div class="w-48 h-3 bg-gray-200 rounded-full mx-2 relative">
                            @php
                                $percentage =
                                    $totalReviews > 0 ? (($ratingCounts[$rating] ?? 0) / $totalReviews) * 100 : 0;
                            @endphp
                            <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span class="text-gray-700">{{ $ratingCounts[$rating] ?? 0 }} Orang</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="space-y-6">
            @foreach ($reviews as $review)
                <div class="bg-white p-6 rounded-lg shadow-md flex justify-between items-start">
                    <div class="flex items-start">
                        <div class="w-14 h-14 bg-gray-200 rounded-full mr-4 overflow-hidden flex-shrink-0">
                            @if ($review->user->foto)
                                <img src="{{ asset('storage/' . $review->user->foto) }}" alt="Profile"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-primary text-white text-xl font-semibold">
                                    {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="font-bold text-lg text-gray-800">{{ $review->user->nama_lengkap }}</div>
                            <div class="text-gray-500 text-sm mb-2">{{ $review->user->nama_pengguna }}</div>
                            <div class="text-yellow-400 text-xl mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                            <p class="text-gray-700 text-base leading-relaxed">{{ $review->review }}</p>
                            <div class="text-xs text-gray-400 mt-3">
                                {{ $review->created_at->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
