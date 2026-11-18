<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $vendor->nama_vendor }} — EventKu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{
            --brand:#2b5f8e; --brand-dark:#1f4b78; --ink:#14233b; --muted:#6b7a90;
            --line:#e3e8ef; --soft:#e6edf6; --bg:#f6f8fb;
        }
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;color:var(--ink);background:#fff;min-height:100vh;display:flex;flex-direction:column}
        a{color:inherit;text-decoration:none}
        .wrap{max-width:1120px;margin:0 auto;padding:0 24px}

        /* Navbar */
        .nav{position:sticky;top:0;z-index:20;background:#fff;border-bottom:1px solid var(--line)}
        .nav .wrap{display:flex;align-items:center;justify-content:space-between;height:64px;gap:16px}
        .logo{font-weight:800;font-size:19px;color:var(--brand-dark)}
        .menu{display:flex;gap:28px;font-size:13px;font-weight:600;color:var(--brand)}
        .menu a:hover{color:var(--brand-dark)}
        .aksi{display:flex;align-items:center;gap:10px;font-size:13px;font-weight:700}
        .aksi form{display:inline}
        .sapa{color:var(--muted);font-weight:600}
        .btn{display:inline-flex;align-items:center;justify-content:center;height:38px;padding:0 20px;border-radius:9px;border:2px solid var(--brand-dark);font:inherit;font-size:13px;font-weight:700;cursor:pointer}
        .btn-outline{background:#fff;color:var(--brand-dark)}
        .btn-fill{background:var(--brand-dark);color:#fff}
        .btn-fill:hover{background:#183d62}

        /* Konten */
        main{flex:1;padding:32px 0 48px}
        .balik{display:inline-block;font-size:13px;font-weight:600;color:var(--brand);margin-bottom:18px}
        .balik:hover{color:var(--brand-dark)}
        .banner{height:200px;border-radius:16px;background:linear-gradient(135deg,#cfdff0,#e6edf6);margin-bottom:22px}
        .tag{display:inline-block;font-size:11px;font-weight:700;color:var(--brand);background:var(--soft);padding:3px 9px;border-radius:20px}
        .nama{font-size:28px;font-weight:800;letter-spacing:-.3px;margin:10px 0 4px}
        .lokasi{font-size:13px;color:var(--muted)}
        .desk{font-size:14px;line-height:1.7;color:#3b4a60;max-width:720px;margin-top:14px}
        .sub{font-size:18px;font-weight:800;margin:32px 0 14px}
        .paket-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
        .paket{background:#fff;border:1px solid var(--line);border-radius:12px;padding:18px}
        .paket h3{font-size:14px;font-weight:700}
        .paket .hrg{font-size:18px;font-weight:800;color:var(--brand-dark);margin:6px 0 8px}
        .paket p{font-size:12.5px;line-height:1.6;color:var(--muted)}
        .kosong{text-align:center;padding:40px 16px;background:var(--bg);border-radius:12px;color:var(--muted);font-size:13px}

        /* Footer */
        footer{border-top:1px solid var(--line);padding:32px 0;font-size:12.5px;color:var(--muted)}
        footer .wrap{display:flex;justify-content:space-between;gap:16px;flex-wrap:wrap}
        footer .links{display:flex;gap:20px;font-weight:600}

        @media(max-width:900px){
            .menu{display:none}
            .paket-grid{grid-template-columns:repeat(2,1fr)}
        }
        @media(max-width:520px){
            .paket-grid{grid-template-columns:1fr}
            .nama{font-size:22px}
        }
    </style>
</head>
<body>

<header class="nav">
    <div class="wrap">
        <a href="{{ route('beranda') }}" class="logo">EventKu</a>
        <nav class="menu">
            <a href="{{ route('vendor.index') }}">Cari Vendor</a>
            <a href="{{ route('beranda') }}#kategori">Kategori</a>
            <a href="{{ route('beranda') }}#cara-kerja">Cara Kerja</a>
            <a href="{{ route('vendor.register') }}">Jadi Vendor</a>
        </nav>
        <div class="aksi">
            @auth
                <span class="sapa">Halo, {{ \Illuminate\Support\Str::words(auth()->user()->name, 1, '') }}</span>
                <form method="POST" action="{{ route('keluar') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline">Keluar</button>
                </form>
            @else
                <a href="{{ route('masuk') }}" class="btn btn-outline">Masuk</a>
                <a href="{{ route('daftar') }}" class="btn btn-fill">Daftar</a>
            @endauth
        </div>
    </div>
</header>

<main>
    <div class="wrap">
        <a class="balik" href="{{ route('vendor.index') }}">&larr; Kembali ke daftar vendor</a>

        <div class="banner"></div>

        <span class="tag">{{ $vendor->kategori->nama_kategori }}</span>
        <h1 class="nama">{{ $vendor->nama_vendor }}</h1>
        <div class="lokasi">{{ $vendor->kota }}</div>
        <p class="desk">{{ $vendor->deskripsi ?: 'Vendor ini belum menambahkan deskripsi.' }}</p>

        <h2 class="sub">Paket layanan</h2>
        @if($vendor->paketLayanan->isEmpty())
            <div class="kosong">Vendor ini belum menambahkan paket.</div>
        @else
            <div class="paket-grid">
                @foreach($vendor->paketLayanan as $p)
                    <div class="paket">
                        <h3>{{ $p->nama_paket }}</h3>
                        <div class="hrg">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                        <p>{{ $p->deskripsi }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</main>

<footer>
    <div class="wrap">
        <div>
            <strong style="color:var(--brand-dark)">EventKu</strong><br>
            Platform pemesanan jasa acara multi-vendor.
        </div>
        <div class="links">
            <a href="{{ route('vendor.index') }}">Cari Vendor</a>
            <a href="{{ route('vendor.register') }}">Jadi Vendor</a>
        </div>
        <div>&copy; {{ date('Y') }} EventKu</div>
    </div>
</footer>

</body>
</html>