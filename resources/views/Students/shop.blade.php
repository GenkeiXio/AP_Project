@extends('Students.studentslayout')

@section('content')
    <div class="shop-page">
        <div class="shop-header">
            <div>
                <h1>🛍️ Avatar Shop</h1>
                <p>Bumili ng bagong avatar para sa iyong karakter. Si Juan, Maria, at Lihim ay naka-unlock na habang kailangan bilhin si Rizal, Bonifacio, at Gabriela.</p>
            </div>
        </div>

        <div class="shop-grid">
            @foreach($shopItems as $avatar => $item)
                @php $owned = in_array($avatar, $unlockedAvatars, true); @endphp
                <div class="shop-card {{ $owned ? 'owned' : '' }}">
                    <div class="shop-image">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['label'] }}">
                    </div>
                    <div class="shop-body">
                        <h2>{{ $item['label'] }}</h2>
                        <p>{{ $item['description'] }}</p>
                    </div>
                    <div class="shop-actions">
                        @if($owned)
                            <span class="status owned">✅ Na-unlock</span>
                        @else
                            <button type="button" class="btn-buy" data-avatar="{{ $avatar }}" onclick="buyAvatar('{{ $avatar }}', this)">Bumili</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="shop-alert" id="shopAlert"></div>
    </div>
@endsection

@push('styles')
    <style>
        .shop-page {
            padding: 26px 24px;
            max-width: 1150px;
            margin: 0 auto;
            color: #3d2a1a;
        }

        .shop-header {
            display: flex;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 26px;
            align-items: center;
        }

        .shop-header h1 {
            margin-bottom: 10px;
            font-size: clamp(2rem, 2.8vw, 2.8rem);
            color: #2f4f4f;
        }

        .shop-header p {
            font-size: 1rem;
            line-height: 1.7;
            max-width: 720px;
        }

        .shop-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(240px, 1fr));
            gap: 20px;
        }

        .shop-card {
            background: rgba(255, 255, 255, 0.96);
            border: 2px solid rgba(93, 128, 80, 0.18);
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .shop-card:hover {
            transform: translateY(-4px);
            border-color: rgba(93, 128, 80, 0.35);
        }

        .shop-card.owned {
            border-color: rgba(77, 168, 98, 0.35);
        }

        .shop-image {
            min-height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f9f5ee;
        }

        .shop-image img {
            max-height: 180px;
            width: auto;
            object-fit: contain;
        }

        .shop-body {
            padding: 20px 22px;
            flex: 1;
        }

        .shop-body h2 {
            margin-bottom: 12px;
            font-size: 1.15rem;
            color: #2f4f4f;
        }

        .shop-body p {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #57524a;
        }

        .shop-actions {
            padding: 20px 22px 26px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
        }

        .btn-buy {
            background: linear-gradient(135deg, #2e86c1, #1f638f);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 12px 20px;
            font-size: 0.95rem;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .btn-buy:hover {
            transform: translateY(-1px);
        }

        .status.owned {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #e8f8ed;
            color: #2f6a3a;
            border-radius: 999px;
            padding: 10px 14px;
            font-weight: 700;
        }

        .shop-alert {
            margin-top: 18px;
            font-size: 0.95rem;
            padding: 14px 18px;
            border-radius: 16px;
            display: none;
        }

        .shop-alert.show {
            display: block;
        }

        .shop-alert.success {
            background: #e8f8ed;
            color: #1f6f3f;
        }

        .shop-alert.error {
            background: #fde8e8;
            color: #a43f3f;
        }

        @media(max-width: 960px) {
            .shop-grid {
                grid-template-columns: repeat(2, minmax(220px, 1fr));
            }
        }

        @media(max-width: 700px) {
            .shop-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;

        async function buyAvatar(avatar, button) {
            button.disabled = true;
            button.innerText = 'Nagbi-bili...';
            const alert = document.getElementById('shopAlert');

            try {
                const res = await fetch('{{ route('student.shop.buy') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF,
                    },
                    body: JSON.stringify({ avatar }),
                });
                const data = await res.json();

                if (data.success) {
                    button.outerHTML = '<span class="status owned">✅ Na-unlock</span>';
                    showShopAlert('success', 'Na-unlock na ang avatar. Maaari mo na itong piliin sa profile o sa select character.');
                } else {
                    showShopAlert('error', data.message || 'Hindi ma-unlock ang avatar. Subukan uli.');
                    button.disabled = false;
                    button.innerText = 'Bumili';
                }
            } catch (error) {
                showShopAlert('error', 'Nagkaroon ng error sa pagbilhin.');
                button.disabled = false;
                button.innerText = 'Bumili';
            }
        }

        function showShopAlert(type, message) {
            const alert = document.getElementById('shopAlert');
            alert.className = `shop-alert show ${type}`;
            alert.textContent = message;
        }
    </script>
@endpush
