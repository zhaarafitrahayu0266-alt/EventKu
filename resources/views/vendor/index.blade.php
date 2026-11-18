<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cari Vendor — EventKu</title>
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
        .ok{background:#dcf1e3;color:#1d5c34;font-size:13px;font-weight:600;padding:10px 14px;border-radius:10px;margin-bottom:20px}
        h1{font-size:26px;font-weight:800;letter-spacing:-.3px}
        .ket{font-size:13px;color:var(--muted);margin:6px 0 22px}
        .filter{display:flex;gap:10px;background:var(--soft);padding:10px;border-radius:14px;margin-bottom:28px}
        .filter select,.filter input{flex:1;min-width:0;height:46px;border:0;border-radius:10px;background:#fff;padding:0 14px;font:inherit;font-size:13px;color:var(--ink);outline:none}
        .filter select:focus,.filter input:focus{box-shadow:0 0 0 2px var(--brand)}
        .filter .btn{height:46px;padding:0 28px}
        .grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
        .kartu{display:block;background:#fff;border:1px solid var(--line);border-radius:12px;overflow:hidden;transition:.15s}
        .kartu:hover{box-shadow:0 8px 20px rgba(20,35,59,.1);transform:translateY(-2px)}
        .foto{height:120px;background:linear-gradient(135deg,#cfdff0,#e6edf6)}
        .kartu .isi{padding:14px}
        .tag{display:inline-block;font-size:11px;font-weight:700;color:var(--brand);background:var(--soft);padding:3px 9px;border-radius:20px}
        .kartu h3{font-size:14px;font-weight:700;margin:10px 0 4px}
        .kartu .kota{font-size:12px;color:var(--muted)}
        .kartu .harga{margin-top:10px;font-size:12px;color:var(--muted)}
        .kartu .harga b{color:var(--ink);font-size:13px}
        .kosong{grid-column:1/-1;text-align:center;padding:48px 16px;background:var(--bg);border-radius:12px;color:var(--muted);font-size:13px}

        /* Footer */
        footer{border-top:1px solid var(--line);padding:32px 0;font-size:12.5px;color:var(--muted)}
        footer .wrap{display:flex;justify-content:space-between;gap:16px;flex-wrap:wrap}
        footer .links{display:flex;gap:20px;font-weight:600}

        @media(max-width:900px){
            .menu{display:none}
            .grid{grid-template-columns:repeat(2,1fr)}
            .filter{flex-direction:column}
        }
        @media(max-width:520px){ .grid{grid-template-columns:1fr} }
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
        @if(session('sukses')) <p class="ok">{{ session('sukses') }}</p> @endif

        <h1>Cari Vendor</h1>
        <p class="ket">Bandingkan vendor, lihat paket, dan pilih yang cocok untuk acaramu.</p>

        <form class="filter" method="GET" action="{{ route('vendor.index') }}">
            <select name="kategori" aria-label="Kategori jasa">
                <option value="">Semua kategori</option>
                @foreach($kategoriJasas as $k)
                    <option value="{{ $k->id_kategori }}" @selected(request('kategori') == $k->id_kategori)>{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
            <input name="kota" placeholder="Kota" value="{{ request('kota') }}" aria-label="Kota">
            <button class="btn btn-fill">Cari</button>
        </form>

        <div class="grid">
            @forelse($vendors as $v)
                <a class="kartu" href="{{ route('vendor.show', $v->id_vendor) }}">
                    <div class="foto"></div>
                    <div class="isi">
                        <span class="tag">{{ $v->kategori->nama_kategori }}</span>
                        <h3>{{ $v->nama_vendor }}</h3>
                        <div class="kota">{{ $v->kota }}</div>
                        <div class="harga">
                            @if($v->paket_layanan_min_harga)
                                Mulai dari <b>Rp {{ number_format($v->paket_layanan_min_harga, 0, ',', '.') }}</b>
                            @else
                                Belum ada paket
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <div class="kosong">Belum ada vendor yang cocok dengan pencarianmu.</div>
            @endforelse
        </div>
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