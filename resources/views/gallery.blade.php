<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery</title>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        /* Base */
        body{font-family:Instrument Sans, system-ui, sans-serif; background:#0a0a0a;color:#fff;padding:2rem}
    /* Masonry-like multi-column layout */
    /* slightly larger max-width so thumbnails appear a bit bigger */
    .grid-wrapper{max-width:480px;margin:0 auto}
    .grid{column-gap:.6rem;column-fill:balance;box-sizing:border-box}
    /* responsive columns */
    @media (min-width: 1100px){ .grid{column-count:3} }
    @media (min-width: 900px) and (max-width:1099px){ .grid{column-count:2} }
    @media (max-width: 899px){ .grid{column-count:1} }

    /* Cards */
    .card{background:#111;margin:0 0 .75rem;border-radius:6px;overflow:hidden;display:block;box-sizing:border-box;break-inside:avoid;page-break-inside:avoid;vertical-align:top;padding:6px}
    .card img{width:100%;height:auto;object-fit:cover;display:block;border-radius:4px}
    .card .caption{padding:6px 2px;font-size:12px;color:#bfbfbf;text-align:center}
        .top{display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem}
        a.button{background:#f53003;color:#fff;padding:0.5rem 0.75rem;border-radius:6px;text-decoration:none}

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(22px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes cardEnter {
            from { opacity: 0; transform: translateY(26px) scale(.995); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        @keyframes wrapperFade {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .grid-wrapper{opacity:0;animation:wrapperFade 520ms cubic-bezier(.4,0,.2,1) both;animation-delay:200ms}

        .top h1, .top .button {
            opacity: 0;
            animation: fadeInUp 900ms cubic-bezier(.4,0,.2,1) both;
            animation-delay: 240ms;
        }

        .grid .card {
            opacity: 0;
            transform: translateY(26px);
            animation: cardEnter 900ms cubic-bezier(.4,0,.2,1) both;
            animation-delay: calc(var(--enter-delay, 0ms) + 240ms);
        }

        @media (prefers-reduced-motion: reduce) {
            .top h1, .top .button, .grid .card {
                animation: none !important;
                transition: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="top">
        <h1>Gallery</h1>
        <a href="{{ url('/') }}" class="button">Home</a>
    </div>

    <div class="grid-wrapper">
        <div class="grid">
        @foreach (($images ?? []) as $i => $img)
            {{-- stagger delay: 60ms per item index --}}
            <div class="card" style="--enter-delay: {{ ($i * 90) }}ms;">
                <img src="{{ $img }}" alt="{{ basename(parse_url($img, PHP_URL_PATH)) }}" loading="lazy">
                <div class="caption">{{ basename(parse_url($img, PHP_URL_PATH)) }}</div>
            </div>
        @endforeach
        </div>
    </div>
</body>
</html>
