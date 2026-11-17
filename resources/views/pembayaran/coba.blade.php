<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tes Pembayaran</title>
</head>
<body>
    <h1>Tes Pembayaran Midtrans</h1>
    <button id="bayar">Bayar Rp30.000</button>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        document.getElementById('bayar').onclick = function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function (r) { console.log('sukses', r); alert('Pembayaran sukses'); },
                onPending: function (r) { console.log('pending', r); alert('Menunggu pembayaran'); },
                onError:   function (r) { console.log('error', r); alert('Pembayaran gagal'); }
            });
        };
    </script>
</body>
</html>