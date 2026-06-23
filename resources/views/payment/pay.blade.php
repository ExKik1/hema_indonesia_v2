<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Pembayaran | Hema.Indonesia</title>
    <link rel="stylesheet" href="{{ asset('library/font/urbanist.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @vite('resources/css/app.css')
    <style>
        /* ── Payment method card ── */
        .pay-method-card {
            display       : flex;
            align-items   : center;
            gap           : 12px;
            padding       : 14px 16px;
            border        : 2px solid #ede3db;
            border-radius : 10px;
            cursor        : pointer;
            transition    : border-color .18s, background .18s, box-shadow .18s;
            background    : #fff;
            text-align    : left;
            width         : 100%;
            font-family   : "Urbanist", sans-serif;
        }
        .pay-method-card:hover {
            border-color: #b17457;
            background  : #fdf8f5;
        }
        .pay-method-card.selected {
            border-color: #b17457;
            background  : #fdf5ef;
            box-shadow  : 0 0 0 3px rgba(177,116,87,.14);
        }
        .pay-method-card.selected .pay-check {
            background  : #b17457;
            border-color: #b17457;
        }
        .pay-method-card.selected .pay-check::after {
            display: block;
        }
        .pay-check {
            width        : 20px;
            height       : 20px;
            border-radius: 50%;
            border       : 2px solid #d6cac2;
            flex-shrink  : 0;
            position     : relative;
            transition   : background .15s, border-color .15s;
        }
        .pay-check::after {
            content      : '';
            display      : none;
            position     : absolute;
            top          : 4px;
            left         : 4px;
            width        : 8px;
            height       : 8px;
            border-radius: 50%;
            background   : #fff;
        }
        .pay-method-label {
            flex          : 1;
            font-weight   : 700;
            font-size     : 14px;
            color         : #1e1410;
        }
        .pay-method-sub {
            font-size  : 11.5px;
            font-weight: 400;
            color      : #7a6255;
            margin-top : 1px;
        }
        .pay-method-logo {
            font-size  : 22px;
            width      : 36px;
            text-align : center;
            flex-shrink: 0;
        }

        /* ── Pay button ── */
        #pay-button {
            width          : 100%;
            padding        : 14px;
            border-radius  : 10px;
            border         : none;
            font-family    : "Urbanist", sans-serif;
            font-weight    : 700;
            font-size      : 14.5px;
            cursor         : pointer;
            transition     : opacity .2s, box-shadow .2s;
            display        : flex;
            align-items    : center;
            justify-content: center;
            gap            : 8px;
        }
        #pay-button:not(:disabled) {
            background : linear-gradient(135deg,#b17457,#c29470);
            color      : #fff;
            box-shadow : 0 4px 14px rgba(177,116,87,.28);
        }
        #pay-button:not(:disabled):hover {
            opacity   : .88;
            box-shadow: 0 6px 20px rgba(177,116,87,.40);
        }
        #pay-button:disabled {
            background: #f0ece8;
            color     : #b8a89e;
            cursor    : not-allowed;
            box-shadow: none;
        }
    </style>
</head>
<body class="font-urbanist"
      style="background:linear-gradient(135deg,#1e1410 0%,#3d2e26 100%);
             min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;">

    <div style="max-width:440px;width:100%;">
        <div class="rounded-2xl p-8" style="background:#fff;box-shadow:0 20px 60px rgba(0,0,0,.30);">

            {{-- Logo --}}
            <div class="text-center mb-6">
                <a href="{{ url('/') }}" class="inline-block text-xl font-extrabold" style="text-decoration:none;">
                    <span style="color:#b17457;">Hema</span><span style="color:#1e1410;">.Indonesia</span>
                </a>
            </div>

            {{-- Order info --}}
            <div class="rounded-xl py-4 px-5 mb-6"
                 style="background:#faf7f4;border:1.5px solid #ede3db;">
                <div class="flex justify-between items-center mb-1">
                    <span style="font-size:12px;color:#7a6255;">Pesanan</span>
                    <span style="font-size:12px;font-weight:700;color:#3d2e26;">#{{ $order->id }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span style="font-size:12px;color:#7a6255;">Total Pembayaran</span>
                    <span style="font-size:18px;font-weight:800;color:#b17457;">
                        Rp. {{ number_format($order->total_price,0,',','.') }}
                    </span>
                </div>
            </div>

            {{-- Pilih Metode Pembayaran --}}
            <p style="font-size:12px;font-weight:700;color:#7a6255;
                      text-transform:uppercase;letter-spacing:.8px;margin-bottom:10px;">
                Pilih Metode Pembayaran
            </p>

            <div class="flex flex-col gap-2 mb-6" id="payment-methods">

                {{-- QRIS --}}
                <button type="button"
                        class="pay-method-card"
                        data-method="qris"
                        onclick="selectMethod(this)">
                    <span class="pay-check"></span>
                    <span class="pay-method-logo" style="color:#1e1410;">
                        <i class="fas fa-qrcode"></i>
                    </span>
                    <span>
                        <span class="pay-method-label">QRIS</span>
                        <span class="pay-method-sub block">Scan QR Code — semua e-wallet & m-banking</span>
                    </span>
                </button>

                {{-- BRI Virtual Account --}}
                <button type="button"
                        class="pay-method-card"
                        data-method="bri_va"
                        onclick="selectMethod(this)">
                    <span class="pay-check"></span>
                    <span class="pay-method-logo" style="color:#004d9f;">
                        <i class="fas fa-building-columns"></i>
                    </span>
                    <span>
                        <span class="pay-method-label">Bank BRI</span>
                        <span class="pay-method-sub block">Virtual Account BRI</span>
                    </span>
                </button>

                {{-- BCA Virtual Account --}}
                <button type="button"
                        class="pay-method-card"
                        data-method="bca_va"
                        onclick="selectMethod(this)">
                    <span class="pay-check"></span>
                    <span class="pay-method-logo" style="color:#0066ae;">
                        <i class="fas fa-building-columns"></i>
                    </span>
                    <span>
                        <span class="pay-method-label">Bank BCA</span>
                        <span class="pay-method-sub block">Virtual Account BCA</span>
                    </span>
                </button>

            </div>

            {{-- Tombol Bayar Sekarang --}}
            <button id="pay-button" disabled>
                <i class="fas fa-lock"></i>
                <span id="pay-button-text">Pilih metode pembayaran dulu</span>
            </button>

            <a href="{{ url('/orders/'.$order->id) }}"
               class="block text-center mt-4 text-sm transition-colors"
               style="color:#a89080;text-decoration:none;"
               onmouseover="this.style.color='#7a6255'"
               onmouseout="this.style.color='#a89080'">
                <i class="fas fa-arrow-left text-xs me-1"></i> Kembali ke detail pesanan
            </a>

            <p style="font-size:11px;color:#d1c4bc;text-align:center;margin-top:16px;">
                Setelah klik Bayar Sekarang, halaman Midtrans akan terbuka
                dengan metode pembayaran yang kamu pilih.
            </p>
        </div>

        <p style="color:rgba(255,255,255,.35);font-size:12px;text-align:center;margin-top:16px;">
            <i class="fas fa-shield-halved me-1"></i>
            Transaksi aman &amp; terenkripsi oleh Midtrans
        </p>
    </div>

    <script type="text/javascript" src="{{ $snapJs }}" data-client-key="{{ $clientKey }}"></script>
    <script>
    var selectedMethod = null;

    /* Pilih metode */
    function selectMethod(card) {
        // Hapus selected dari semua card
        document.querySelectorAll('.pay-method-card').forEach(function (c) {
            c.classList.remove('selected');
        });
        // Set selected pada yang diklik
        card.classList.add('selected');
        selectedMethod = card.getAttribute('data-method');

        // Aktifkan tombol bayar
        var btn  = document.getElementById('pay-button');
        var text = document.getElementById('pay-button-text');
        btn.disabled = false;

        var labels = { 'qris': 'QRIS', 'bri_va': 'Bank BRI', 'bca_va': 'Bank BCA' };
        text.textContent = 'Bayar dengan ' + (labels[selectedMethod] || selectedMethod);
    }

    /* Setelah pilih method, redirect ke controller untuk generate
       Snap token baru dengan enabled_payments sesuai pilihan */
    function startPayment() {
        if (!selectedMethod) return;
        window.location.href = '{{ url('/orders/'.$order->id.'/pay') }}?method=' + selectedMethod;
    }

    document.getElementById('pay-button').addEventListener('click', startPayment);</script>
</body>
</html>
